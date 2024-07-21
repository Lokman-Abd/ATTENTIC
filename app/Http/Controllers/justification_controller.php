<?php

namespace App\Http\Controllers;

use App\Models\Absence;

use Illuminate\Http\Request;
use App\Models\Justification;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\Rules\File as FileRule;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File as FileDelete; 



class justification_controller extends Controller
{

    public $student_list;
    public $username;
    public function getUsername()
    {
        $this->username = Auth::guard('student')->user()->student_first_name . ' ' . Auth::guard('student')->user()->student_last_name;
    }
    public function getUsernameAndCountAdmin()
    {
        $this->username = Auth::guard('admin')->user()->admin_first_name . ' ' . Auth::guard('admin')->user()->admin_last_name;
    }
    public function student_dashboard()
    {
        $this->getUsername();
        $student_id = Auth::id();
        $data = [
            'username' => $this->username,
            'student_id' => $student_id
        ];

        return view('student.Student')->with($data);
    }
    public function index()
    {
        $this->getUsernameAndCountAdmin();
        $count = Justification::where('justification_status', '=', '0')->count();
        $justifications = Justification::all();
        $data = [
            'username' => $this->username,
            'count' => $count,
            'justifications' => $justifications,

        ];
        return view("admin.justification")->with($data);
    }


    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "student_id" => ['required', 'exists:students,student_id'],
                "justification" => ['required', 'not_in:undefined', FileRule::types(['jpg', 'jpeg', 'png', 'pdf'])->max(20 * 1024),],
                "start_date" => ['required', 'date'],
                "end_date" => ['required', 'date '],
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => $validator->errors()->first(), 'errors' => $validator->errors()]);
            }
            $imageName = time() . '.' . $request->justification->getClientOriginalExtension();


            $des = 'justification';

            $path = $request->justification->move($des, $imageName);
            $justification = Justification::create([
                'img_path' => $path,
                "student_id" => $request->student_id,
                "justification_status" => false,
                "start_at" => $request->start_date,
                "end_at" => $request->end_date,
            ]);
            if ($justification == false) {
                return response()->json(['status' => false, 'message' => 'Something went wrong justification Not Added']);
            } else {
                return response()->json(['status' => true, 'message' => 'Justification sent successfully']);
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }


    public function update(Request $request)
    {
        try {

            $Justifications = Justification::where('student_id', '=', $request->student_id)->where('justification_id', '=', $request->justification_id)->get();
            
            $Justifications[0]->update([
                "justification_status" => true,
                "start_at" => $request->start_at,
                "end_at" => $request->end_at,
            ]);
            


            $jutification_date['start_at'] = $Justifications[0]->start_at;
            $jutification_date['end_at'] = $Justifications[0]->end_at;
            $newStatus = false;
            if (($request->decide) == 'accepte') {
                $newStatus = true;
            } elseif(($request->decide) == 'refuse') {
                $newStatus = false;
            }else{
                return redirect()->back()->withError('Something went wrong');
            }
            $absance_idsOfStudent = Absence::getAbsencesOfThisStudentBetween($jutification_date['start_at'], $jutification_date['end_at'], $request->student_id);
    
            foreach (Absence::whereIn('absence_id', $absance_idsOfStudent)->get() as  $absance) {
                $absance->update([
                    "status" => $newStatus
                ]);
            }
          

            return redirect()->route('displayJustifications');
        } catch (\Throwable $th) {
            return redirect()->back()->withError('Something went wrong');
            
        }
    }

    public function destroy()
    {
        try {
            $files = Justification::pluck('img_path')->toArray();
            foreach ($files as $img_path) {
                if (file_exists($img_path)) {
                    FileDelete::delete($img_path);
                }
            }
            Justification::truncate();
            return redirect()->back()->withSuccess('Successfully deleted');
        } catch (\Throwable $th) {
            return $th->getMessage();
            return redirect()->back()->withError('Something went wrong');
        }
    }
}
