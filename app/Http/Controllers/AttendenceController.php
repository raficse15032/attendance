<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAttendenceRequest;
use App\Http\Requests\UpdateAttendenceRequest;
use App\Repositories\AttendenceRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Department;
use App\Models\Course;
use App\Models\Session;
use App\Models\Student;
use App\Models\Semester;
use App\Models\Attendence;
use App\Models\CourseAssign;
use App\User;
use App\Ct;
use Sentinel;
use Illuminate\Support\Facades\Redirect;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class AttendenceController extends AppBaseController
{
    /** @var  AttendenceRepository */
    private $attendenceRepository;

    public function __construct(AttendenceRepository $attendenceRepo)
    {
        $this->attendenceRepository = $attendenceRepo;
    }

    /**
     * Display a listing of the Attendence.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        // $this->attendenceRepository->pushCriteria(new RequestCriteria($request));
        // $attendences = $this->attendenceRepository->all();
        $department_id = $request->department_id;
        $session_id    = $request->session_id;
        $course_id     = $request->course_id;

        $course_assign = CourseAssign::where('course_id',$course_id)->where('session_id',$session_id)->first();
        if($course_assign)
        {
            $user_id = $course_assign->user_id;
        }
        else{
            $user_id = 0;
        }



        $chairman = User::where('dep_id',$department_id)->where('type',2)->first();
        if($chairman)
        {
            $chairman_id = $chairman->id;
        }
        else{
            $chairman_id = 0;
        }


        if(Sentinel::getUser()->id == $user_id || Sentinel::getUser()->type == 1 || Sentinel::getUser()->id == $chairman_id){
            
            $attendences = Attendence::where('department_id',$department_id)->where('session_id',$session_id)->where('course_id',$course_id)->get(); 
        }
        else{
            Flash::error('Sorry!! this is not your course.');
            return redirect(route('attendence_first_step'));
        }
        return view('attendences.index',compact('attendences','department_id','session_id','course_id','user_id'));
    }

    /**
     * Show the form for creating a new Attendence.
     *
     * @return Response
     */
    public function create($d_id,$s_id,$c_id)
    {
        return $d_id.' '.$s_id.' '.$c_id;
        $department = Department::pluck('name','id');
        $course = Course::pluck('course','id');
        $session = Session::pluck('session','id');
        return view('attendences.create',compact('department','course','session'));
    }
    public function firstStep()
    {
        $department = Department::all();
        $course = Course::pluck('course','id');
        $session = Session::pluck('session','id');
        $semester = Semester::all();
        return view('attendences.first_step',compact('department','course','session','semester'));
    }

    /**
     * Store a newly created Attendence in storage.
     *
     * @param CreateAttendenceRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {

        $attendence = new Attendence;
        $department_id = $request->department_id;
        $session_id  = $request->session_id;
        $course_id  = $request->course_id;

        $students  =  Student::where('department_id',$department_id)->where('session_id',$session_id)->get();
        $attend    =  $request->attend;
        $user_id  = Sentinel::getUser()->id;
        if(!$attend){
           $attendences = Attendence::where('department_id',$department_id)->where('session_id',$session_id)->where('course_id',$course_id)->get();
           Flash::error('Sorry!! Please select student.');
           return view('attendences.index',compact('attendences','department_id','session_id','course_id','user_id')); 
        }

        $attend_data = [];
        foreach ($students as  $student) {
            $at_val = 0;
            foreach ($attend as $attend_key => $attend_value) {
                if($student->identity == $attend_key) {
                   $at_val = 1;
                }
            }
            $data = array('identity'=>$student->identity,'name'=>$student->name,'attendence'=>$at_val,'remarks'=>$student->remarks);
            array_push($attend_data,$data);
        }

        $attendence->department_id = $department_id;
        $attendence->session_id    = $session_id;
        $attendence->course_id     = $course_id;
        $attendence->status        = 0;
        $attendence->date          = date("Y-m-d");
        $attendence->attendence    = json_encode($attend_data);
        $attendence->user_id = Sentinel::getUser()->id;
        $attendence->save();
        Flash::success('Attendence saved successfully.');

        $attendences = Attendence::where('department_id',$department_id)->where('session_id',$session_id)->where('course_id',$course_id)->get();

        return view('attendences.index',compact('attendences','department_id','session_id','course_id','user_id'));
    }

    /**
     * Display the specified Attendence.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $attendence = $this->attendenceRepository->findWithoutFail($id);

        if (empty($attendence)) {
            Flash::error('Attendence not found');

            return redirect(route('attendences.index'));
        }

        return view('attendences.show')->with('attendence', $attendence);
    }

    /**
     * Show the form for editing the specified Attendence.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $attendence = Attendence::find($id);
        $attendend_students = json_decode($attendence->attendence);

        // if (empty($attendence)) {
        //     Flash::error('Attendence not found');

        //     return redirect(route('attendences.index'));
        // }

        return view('attendences.edit',compact('attendend_students'))->with('attendence', $attendence);
    }

    /**
     * Update the specified Attendence in storage.
     *
     * @param  int              $id
     * @param UpdateAttendenceRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $attendence = Attendence::find($id);

        $department_id = $attendence->department_id;
        $session_id    = $attendence->session_id;
        $course_id     = $attendence->course_id;

        $students  =  $request->student;
        $attend    =  $request->attend;
        

        $attend_data = [];
        foreach ($students as $key => $student) {
            $at_val = 0;
            foreach ($attend as $attend_key => $attend_value) {
                if($key == $attend_key) {
                   $at_val = 1;
                }
            }
            $remarks = Student::where('identity',$key)->first();
            if($remarks){
                $remarks = $remarks->remarks;
            }
            $data = array('identity'=>$key,'name'=>$student,'attendence'=>$at_val,'remarks'=>$remarks);
            array_push($attend_data,$data);
        }

        $attendence->attendence    = json_encode($attend_data);

        $course_id = $attendence->course_id;
        $user_id = CourseAssign::where('course_id',$course_id)->where('session_id',$session_id)->first()->user_id;

        if(Sentinel::getUser()->id == $user_id ){
           $attendence->save();
           Flash::success('Attendence updated successfully.');
        }

        

        $attendences = Attendence::where('department_id',$department_id)->where('session_id',$session_id)->where('course_id',$course_id)->get();

        return view('attendences.index',compact('attendences','department_id','session_id','course_id','user_id'));
    }

    /**
     * Remove the specified Attendence from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $attendence = $this->attendenceRepository->findWithoutFail($id);

        if (empty($attendence)) {
            Flash::error('Attendence not found');

            return redirect(route('attendences.index'));
        }

        $department_id = $attendence->department_id;
        $session_id    = $attendence->session_id;
        $course_id     = $attendence->course_id;
        $user_id = CourseAssign::where('course_id',$course_id)->where('session_id',$session_id)->first()->user_id;

        if(Sentinel::getUser()->id == $user_id ){
            $this->attendenceRepository->delete($id);
            Flash::success('Attendence deleted successfully.');
        }
        else{
           Flash::error('Attendence not found'); 
        }

        
        $attendences = Attendence::where('department_id',$department_id)->where('session_id',$session_id)->where('course_id',$course_id)->get();

        

        return view('attendences.index',compact('attendences','department_id','session_id','course_id','user_id'));
    }

    public function getStudent($d_id,$s_id,$c_id){
        $department_id = $d_id;
        $session_id    = $s_id;
        $course    = Course::where('id',$c_id)->first();
        $students = Student::where('department_id',$department_id)->where('session_id',$session_id)->get();
        return view('attendences.create3',compact('students','department_id','course','session_id'));
    }

    public function getCtStudent($d_id,$s_id,$c_id,$ct){
        $department_id = $d_id;
        $session_id    = $s_id;
        $course    = Course::where('id',$c_id)->first();
        $students = Student::where('department_id',$department_id)->where('session_id',$session_id)->get();
        $ct_mark = Ct::where('department_id',$department_id)
                    ->where('session_id',$session_id)
                    ->where('course_id',$c_id)
                    ->where('ct',$ct)
                    ->first();
        return view('attendences.ct_ad',compact('students','department_id','course','session_id','ct','ct_mark'));
    }

    public function storeCt(Request $request){
        
        // $ct_m = $request->ct_m;
        // $students  =  $request->student;
        // foreach ($students as $key => $student) {
        //     if($ct_m[$key] == null){
        //         Flash::error('Please fill up all fields.');
        //         return redirect::back();
        //     }
        //     if($ct_m[$key]>20 || $ct_m[$key]<0){
        //         Flash::error('Field value range 0 to 20.');
        //         return redirect::back();
        //     }
        // }

         $this->validate($request,[
            // "ct_m"    => "required|array|min:3",
            "ct_m.*"  => "required|numeric|min:0|max:20",
        ]);
        

        $ct_mark = new Ct;
        $department_id = $request->department_id;
        $session_id  = $request->session_id;
        $course_id   = $request->course_id;

        $students  =  $request->student;
        $ct        =  $request->ct;
        $user_id   = Sentinel::getUser()->id;

        $old_mark = Ct::where('department_id',$department_id)
                        ->where('session_id',$session_id)
                        ->where('course_id',$course_id)
                        ->where('ct',$ct)->first();
        if($old_mark){
            $old_mark->delete();
        }

        $ct_data = [];
        
        foreach ($students as $key => $student) {
            $data = array('identity'=>$key,'name'=>$student,'mark'=>$request->ct_m[$key]);
            array_push($ct_data,$data);
        }

       

        $ct_mark->department_id = $department_id;
        $ct_mark->session_id    = $session_id;
        $ct_mark->course_id     = $course_id;
        $ct_mark->status        = 0;
        $ct_mark->ct            = $ct;
        $ct_mark->marks         = json_encode($ct_data);
        $ct_mark->user_id       = Sentinel::getUser()->id;
        $ct_mark->save();
        Flash::success('CT mark saved  successfully.');

        $attendences = Attendence::where('department_id',$department_id)->where('session_id',$session_id)->where('course_id',$course_id)->get();

        return view('attendences.index',compact('attendences','department_id','session_id','course_id','user_id'));

    }

    public function showAll($d_id,$s_id,$c_id)
    {
        $students = Student::where('department_id',$d_id)->where('session_id',$s_id)->get();
        $attendences = Attendence::where('department_id',$d_id)->where('session_id',$s_id)->where('course_id',$c_id)->get();
        $department = Department::pluck('name','id');
        $course = Course::find($c_id);
        $session = Session::pluck('session','id');
        $total_class = Attendence::where('department_id',$d_id)->where('session_id',$s_id)->where('course_id',$c_id)->count();

        $ct_marks = Ct::where('department_id',$d_id)
                    ->where('session_id',$s_id)
                    ->where('course_id',$c_id)
                    ->get();

        if( sizeof($attendences) == 0){
            $department_id = $d_id;
            $session_id    = $s_id;
            $course_id     = $c_id;
            $user_id = CourseAssign::where('course_id',$course_id)->where('session_id',$session_id)->first()->user_id;
            Flash::error('No data found.');
            return view('attendences.index',compact('attendences','department_id','session_id','course_id','user_id'));
        }
        else{
            return view('attendences.test',compact('department','course','session','students','attendences','total_class','ct_marks'));
        }
        
    }

    public function downloadAll($d_id,$s_id,$c_id)
    {
        $client = new Client();
     $url = "http://api.pdflayer.com/api/convert
    ? access_key = '1a42357b0349c94c3777f4757b7e1e25'
    & document_url = https://mbstu.ac.bd";
     $name = 'test';
     $extensions = '.pdf';
      $path = __DIR__.'/download/' . $name . $extensions;
       // $file_path = fopen($path,'w');
       $response = $client->get($url, ['save_to' => $path]);
       return ['response_code'=>$response->getStatusCode(), 'name' => $name];
    $response->getStream();
    // $pdf = $res->getBody()->getContents();

    return Response::download($res);
        // dd($res);
        return response()->json(['ok'=>'ok'],200);

        $students = Student::where('department_id',$d_id)->where('session_id',$s_id)->get();
        $attendences = Attendence::where('department_id',$d_id)->where('session_id',$s_id)->where('course_id',$c_id)->get();
        $department = Department::pluck('name','id');
        $course = Course::find($c_id);
        $session = Session::pluck('session','id');
        $total_class = Attendence::where('department_id',$d_id)->where('session_id',$s_id)->where('course_id',$c_id)->count();
        return view('attendences.test',compact('department','course','session','students','attendences','total_class'));
    }
    
}
