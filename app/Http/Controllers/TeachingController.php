<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Module;
use App\Models\Typing;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\Justification;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TeachingController extends Controller
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


        $typings = Typing::all();
        $teachers = Teacher::all();
        $modules = Module::all();
        $types = Type::all();

        $data = [
            'username' => $this->username,
            'count' => $this->count,
            'typings' => $typings,
            'teachers' => $teachers,
            'types' => $types,
            'modules' => $modules
        ];
        return view('teaching.manageTeaching')->with($data);
    }


    public function getTypes(Request $request)
    { 
        try {
            $module = Module::find($request->id);
            $types = $module->types->makeHidden('pivot');;
            return response()->json([ 'status'=> true,'types' => $types]);
        } catch (\Throwable $th) {
            return response()->json(['status'=> false,'message' => 'Something went wrong','errors'=>$th->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->data, [
            'types' => ['required', 'array', 'min:1'],
            'types.*' => ['required', 'exists:types,type_id'],
            'module_id' => ['required', 'exists:modules'],
            'teacher_id' => ['required', 'exists:teachers'],
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false,'message'=>'Something went wrong', 'errors' => $validator->errors()]);
        }


        try {
            

            $teacher = Teacher::find($request->data['teacher_id']);
            $typing = Typing::where(['module_id' => $request->data['module_id']])->whereIn('type_id', $request->data['types'])->get()->pluck('typing_id')->toArray();
           
            if ($typing == false) {
                return response()->json(['status' => false,'message'=>'Something went wrong', "errors" => 'typing not found']);
            }

            $data = $teacher->teachTyping()->syncWithoutDetaching($typing);
            
            $data_attached = [];



            // data attech return only ids so
            // this forech return name insted of id ex:[1,3] =>[1 =>TD,3 =>TP]


            foreach ($data['attached'] as  $value) {

                $data_attached[$value] = Typing::find($value)->type;
            }
            
        } catch (\Throwable $th) {
            return response()->json(['status' => false,'message'=>'Something went wrong', "errors" => $th->getMessage()]);
        }

        return response()->json(['status' => true, 'data' => $data_attached, 'short_cut' => Module::find($request->data['module_id'])->short_cut, 'teacher_full_name' => $teacher->teacher_first_name . '  ' . $teacher->teacher_last_name]);
    }



    public function destroy(Request $request)
    {
        try {
            $typing = Typing::find($request->typing_id);
            $typing->teachedBy()->detach([$request->teacher_id]);
            return response()->json(['status' => true]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false,'message'=>'Something went wrong' ,'errors' => $th->getMessage()]);
        }
    }
}
