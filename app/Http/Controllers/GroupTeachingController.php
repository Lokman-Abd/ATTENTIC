<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Group;
use App\Models\Module;
use App\Models\Typing;
use App\Models\Teacher;
use App\Models\Teaching;
use Illuminate\Http\Request;
use App\Models\Justification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GroupTeachingController extends Controller
{
    protected $username;

    protected $count;


    public function getUsernameAndCount(){
        $this->count = Justification::where('justification_status','=','0')->count();
        $this->username= Auth::guard('admin')->user()->admin_first_name . ' '.Auth::guard('admin')->user()->admin_last_name;
    }



    public function manage()
    {
        $this->getUsernameAndCount();


        $teachings = Teaching::all();
        $teachers = Teacher::all();
        $groups = Group::all();

        $data = [
            'username' => $this->username,
            'count' => $this->count,
            'teachers' => $teachers,
            'groups' => $groups,
            'teachings' => $teachings,
        ];
        return view('group_teaching.manageGroupTeaching')->with($data);
    }


    public function getModuleAndTypes_GrTeaching(Request $request)
    {
        try {
            $teacher = Teacher::find($request->id);
            $modules_ids = $teacher->teachTyping->pluck('module_id')->toArray();
            $modules = [];
            foreach (array_unique($modules_ids) as $modules_id) {
                array_push($modules, Module::find($modules_id));
            }
            return ['status' => true, 'modules' => $modules, 'types' => $modules[0]->types];
        } catch (\Throwable $th) {
            return ['status' => false,'message'=>'Something went wrong', 'errors' => $th->getMessage()];
        }
    }
    public function getTypes_GrTeaching(Request $request)
    {
        try {
            $module = module::find($request->id);
            $types = $module->types;

            return ['status' => true,  'types' => $types];
        } catch (\Throwable $th) {
            return ['status' => false,'message'=>'Something went wrong', 'errors' => $th->getMessage()];
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->data, [
            'types' => ['required', 'array', 'min:1'],
            'groups' => ['required', 'array', 'min:1'],
            'types.*' => ['required', 'exists:types,type_id'],
            'groups.*' => ['required', 'exists:groups,group_id'],
            'module_id' => ['required', 'exists:modules'],
            'teacher_id' => ['required', 'exists:teachers'],
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false,'message'=>'Something went wrong', 'errors' => $validator->errors()]);
        }

        try {

            $typings = Typing::where(['module_id' => $request->data['module_id']])->whereIn('type_id', $request->data['types'])->get()->pluck('typing_id')->toArray();
            $teaching = Teaching::where(['teacher_id' => $request->data['teacher_id']])->whereIn('typing_id', $typings)->get()->pluck('teaching_id')->toArray();
            $groups = Group::whereIn('group_id', $request->data['groups'])->get();


            if ($teaching == false) {
                return response()->json(['status' => false,'message'=>'Something went wrong', "errors" => 'teaching not found']);
            }
            if ($groups == false) {
                return response()->json(['status' => false,'message'=>'Something went wrong', "errors" => 'teaching not found']);
            }

            $data_attached = [];

            foreach ($groups as $group) {
                $data_geted = $group->teachedBy()->syncWithoutDetaching($teaching)['attached'];
                $data_attached[$group->group_id] = $data_geted;
                $arrayOfTeaching[$group->group_id] = Teaching::whereIn('teaching_id', $data_geted)->get();
            }


            // data attech return only ids so
            // this forech return name insted of id [group=>[id_type=>TP]] ex [1=>[2=>course,3=>TP]

            $finalData = [];
            foreach ($arrayOfTeaching as $group => $array_teaching) {
                $finalData[$group] = [];
                foreach ($array_teaching as $single_teaching) {
                    $finalData[$group][$single_teaching->teaching_id] = [];
                    $finalData[$group][$single_teaching->teaching_id][$single_teaching->typing->type->type_id] = [];
                    array_push($finalData[$group][$single_teaching->teaching_id][$single_teaching->typing->type->type_id], $single_teaching->typing->type->type);
                }
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false,'message'=>'Something went wrong', "errors" => $th->getMessage()]);
        }

        return response()->json(['status' => true, 'data' => $finalData]);
    }



    public function edit(Request $request)
    {
        try {

            $module = Module::find($request->id);
        } catch (\Throwable $th) {
            return response()->json(['status' => false,'message'=>'Something went wrong', 'errors' => $th->getMessage()]);
        }

        if ($module == false) {
            return response()->json(['status' => false,'message'=>'Something went wrong']);
        }
        $view = view('module.Includes.edit_module_form')->with('module', $module)->render();
        return response()->json(['status' => true, 'view' => $view]);
    }


    public function update(Request $request)
    {
        try {
            $module = Module::find($request->data['module_id']);

            if ($module == false) {
                return response()->json(['status' => false,'message'=>'Something went wrong']);
            }

            $validator = Validator::make($request->data, [
                'short_cut' => ["required", "unique:modules,short_cut,$module->module_id,module_id"],
                'module_name' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false,'message'=>'Something went wrong', 'errors' => $validator->errors()]);
            }

            //code...
            $module->update([
                'short_cut' => $request->data['short_cut'],
                'module_name' => $request->data['module_name']

            ]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false,'message'=>'Something went wrong', 'errors' => $th->getMessage()]);
        }

        $view = view('module.Includes.create_module_form')->render();
        return response()->json(['status' => true, 'view' => $view]);
    }


    public function destroy(Request $request)
    {
        try {
            $teaching = Teaching::find($request->teaching_id);
            $teaching->teachGroup()->detach([$request->group_id]);
            return response()->json(['status' => true]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false,'message'=>'Something went wrong', 'errors' => $th->getMessage()]);
        }
    }
}
