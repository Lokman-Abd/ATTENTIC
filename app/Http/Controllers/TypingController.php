<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Models\Justification;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

class TypingController extends Controller
{

    protected $username;
    protected $count;


    public function getUsernameAndCount()
    {
        $this->count = Justification::where('justification_status', '=', '0')->count();
        $this->username = Auth::guard('admin')->user()->admin_first_name . ' ' . Auth::guard('admin')->user()->admin_last_name;
    }


    public function manage()
    {
        $this->getUsernameAndCount();
        $modules = Module::all();
        $types = Type::all();

        $data = [
            'username' => $this->username,
            'count' => $this->count,
            'modules' => $modules,
            'types' => $types,
        ];
        // foreach ($modules as $module) {
        //     foreach ($types as $type) {

        //         print_r($module->short_cut);
        //         print_r('<br>');
        //         print_r($type->type);
        //         print_r('<br>');
        //         var_dump($type->hasThisModule($module->module_id));
        //         print_r('<br>');
        //     }
        // }
        // return '';
        return view('typing.manageTyping')->with($data);
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->data, [
            'types' => ['required', 'array', 'min:1'],
            'types.*' => ['required', 'exists:types,type_id'],
            'short_cut' => ['required', 'unique:modules', 'max:10'],
            'module_name' => 'required',
        ]);



        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors() ,'message' => 'Something went wrong']);
        }



        try {
            $module = Module::create([
                'short_cut' => $request->data['short_cut'],
                'module_name' => $request->data['module_name']
            ]);


            if ($module == false) {
                return response()->json(['status' => false, "errors" => 'module not Created','message' => 'Something went wrong']);
            }

            $data = $module->types()->syncWithoutDetaching($request->data['types']);
            $data_attached = [];


            // data attech return only ids so
            // this forech return name insted of id ex:[1,3] =>[1 =>TD,3 =>TP]

            foreach ($data['attached'] as  $value) {

                $data_attached[$value] = Type::find($value)->type;
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong', "errors" => $th->getMessage()]);
        }

        return response()->json(['status' => true, 'data' => $data_attached, 'short_cut' => $module->short_cut, 'module_id' => $module->module_id]);
        // return response()->json(['status' => true, 'message' => 'Types Inserted Successfully']);
    }


    public function edit(Request $request)
    {
        try {
            $module = Module::find($request->id);
            $types= Type::all();
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong', 'errors' => $th->getMessage()]);
        }

        if ($module == false) {
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
        $data=[
        'module'=> $module,
        'types'=> $types,
        ];
       
        $view = view('typing.Includes.edit_module_form')->with($data)->render();
        return response()->json(['status' => true, 'view' => $view]);
    }



    public function update(Request $request)
    {

        try {
            $module = Module::find($request->data['module_id']);
            $types = Type::all();
            if ($module == false) {
                return response()->json(['status' => false, 'message' => 'Something went wrong']);
            }
            $validator = Validator::make($request->data, [
                'short_cut' => ["required", "unique:modules,short_cut,$module->module_id,module_id"],
                'module_name' => 'required',
                'types' => ['required', 'array'],
                'types.*' => ['required', 'exists:types,type_id'],
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'errors' => $validator->errors(), 'message' => 'Something went wrong']);
            }
            //code...
            $module->update([
                'short_cut' => $request->data['short_cut'],
                'module_name' => $request->data['module_name']
            ]);

            $module->types()->syncWithoutDetaching($request->data['types']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong', "errors" => $th->getMessage()]);
        }

        $view = view('typing.Includes.create_module_form')->with(['types' => $types])->render();
        return response()->json(['status' => true, 'view' => $view, 'types' => $module->types->pluck('type_id')->toArray(), 'short_cut' => $module->short_cut, 'module_id' => $module->module_id]);
    }



    public function destroy(Request $request)
    {
        $validator = Validator::make($request->data, [
            'types' => ['required', 'array', 'min:1'],
            'types.*' => ['required', 'exists:types,type_id'],
            'module_id' => ['required', 'exists:modules,module_id'],
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors(), 'message' => 'Something went wrong']);
        }

        try {
            $allTypes = false;
            $module = Module::find($request->data['module_id']);
            $module->types()->detach($request->data['types']);
            $types = $module->types->pluck('type_id');
            if (count($types) == 0) {
                if (($module->delete())) {
                    $allTypes = true;
                } else {
                    return response()->json(['status' => false, 'message' => 'Something went wrong']);
                }
            }


            return response()->json(['status' => true, 'types' => $types, 'allTypes' => $allTypes]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong', 'errors' => $th->getMessage()]);
        }
    }
}
