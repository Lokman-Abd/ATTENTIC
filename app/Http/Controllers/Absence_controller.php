<?php

namespace App\Http\Controllers;
use App\Models\Absence;
use App\Models\Typing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Absence_controller extends Controller 
{
    protected $username;
    public function getUsernameAndCount(){
        $this->username= Auth::guard('student')->user()->student_first_name . ' '.Auth::guard('student')->user()->student_last_name;        
    }
    public function index() 
    {
        $module_list=[];
        $non_justified_list=[];
        $justified_list=[];
        $student_id= Auth::id();
        $absences_non_justificated=Absence::where('student_id','=',$student_id)->where('status','=',0)->get();
        $absences_justificated=Absence::where('student_id','=',$student_id)->where('status','=',1)->get();
        foreach ($absences_non_justificated as $absence){
            $module=$absence->study->group_Teaching->teaching->typing->module->short_cut;
            $type=$absence->study->group_Teaching->teaching->typing->type->type;
            if(array_key_exists($module.'.'.$type,$non_justified_list)==true)
            {
                $non_justified_list[$module.'.'.$type]=$non_justified_list[$module.'.'.$type]+1;
            }
            else
            {
                $non_justified_list[$module.'.'.$type]=1;
            }
        }
        foreach ($absences_justificated as $absence){
            $module=$absence->study->group_Teaching->teaching->typing->module->short_cut;
            $type=$absence->study->group_Teaching->teaching->typing->type->type;
            if(array_key_exists($module.'.'.$type,$justified_list)==true)
            {
                $justified_list[$module.'.'.$type]=$justified_list[$module.'.'.$type]+1;
            }
            else
            {
                $justified_list[$module.'.'.$type]=1;
            }
        }
        $typings=Typing::all();
        // return $typings;
        foreach ($typings as $typing) {
            $short_cut=$typing->module->short_cut;
            $module_type=$typing->type->type;
            array_push($module_list,$module_type.' '.$short_cut);
        }
        $this->getUsernameAndCount();

    $data=[
        'justified_list'=>$justified_list,
        'non_justified_list'=>$non_justified_list,
        'module_list'=>$module_list,
        'username'=>$this->username,
    ];

        
        return  view("student.SeeMyAbsence")->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
