<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Repositories\StudentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Session;
use App\Models\Department;
use App\CsvData;
use App\Models\Student;
use App\Http\Requests\CsvImportRequest;
use Maatwebsite\Excel\Facades\Excel;
use Sentinel;

class StudentController extends AppBaseController
{
    /** @var  StudentRepository */
    private $studentRepository;

    public function __construct(StudentRepository $studentRepo)
    {
        $this->studentRepository = $studentRepo;
    }

    /**
     * Display a listing of the Student.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->studentRepository->pushCriteria(new RequestCriteria($request));
        $students = $this->studentRepository->all();
        $dep_id = Sentinel::getUser()->dep_id;
        if(Sentinel::getUser()->type == 1){
            $department = Department::pluck('name','id');
        }
        else{
            $department = Department::where('id',$dep_id)->pluck('name','id');
        }
        
        $session = Session::pluck('session','id');
        return view('students.index',compact('department','session'))
            ->with('students', $students);
    }

    public function findStudent(Request $request)
    {
        $department_id = $request->department_id;
        $session_id = $request->session_id;

        // return $department_id.' '.$session_id;
        $students = Student::where('department_id',$department_id)->where('session_id',$session_id)->get();
        
        return view('students.index_student')
            ->with('students', $students);
    }

    public function create()
    {
        // $department = Department::pluck('name','id');
        $dep_id = Sentinel::getUser()->dep_id;
        if(Sentinel::getUser()->type == 1){
            $department = Department::pluck('name','id');
        }
        else{
            $department = Department::where('id',$dep_id)->pluck('name','id');
        }
        $session = Session::pluck('session','id');
        return view('students.create',compact('department','session'));
    }

    /**
     * Store a newly created Student in storage.
     *
     * @param CreateStudentRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'identity'  => 'required',
            'name'      => 'required',
        ]);
        $input = $request->all();

        Student::create($input);

        Flash::success('Student saved successfully.');

        $department_id = $request->department_id;
        $session_id = $request->session_id;
        $students = Student::where('department_id',$department_id)->where('session_id',$session_id)->get();
        
        return view('students.index_student')
            ->with('students', $students);
    }

    /**
     * Display the specified Student.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $student = $this->studentRepository->findWithoutFail($id);

        if (empty($student)) {
            Flash::error('Student not found');

            return redirect(route('students.index'));
        }

        return view('students.show')->with('student', $student);
    }

    /**
     * Show the form for editing the specified Student.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $student = $this->studentRepository->findWithoutFail($id);
        $department = Department::pluck('name','id');
        $session = Session::pluck('session','id');

        if (empty($student)) {
            Flash::error('Student not found');

            return redirect(route('students.index'));
        }

        return view('students.edit',compact('department','session'))->with('student', $student);
    }

    /**
     * Update the specified Student in storage.
     *
     * @param  int              $id
     * @param UpdateStudentRequest $request
     *
     * @return Response
     */
    public function update($id,Request $request)
    {
        $this->validate($request, [
            'identity'  => 'required',
            'name'      => 'required',
        ]);
        $student = Student::find($id);

        if (empty($student)) {
            Flash::error('Student not found');

            return redirect(route('students.index'));
        }

        $student->name          = $request->name;
        $student->identity      = $request->identity;
        $student->department_id = $request->department_id;
        $student->session_id    = $request->session_id;

        $student->update();

        Flash::success('Student updated successfully.');

        $students = Student::where('department_id',$student->department_id)->where('session_id',$student->session_id)->get();
        return view('students.index_student')
            ->with('students', $students);
    }

    /**
     * Remove the specified Student from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {

        $student = $this->studentRepository->findWithoutFail($id);

        if (empty($student)) {
            Flash::error('Student not found');

            return redirect(route('students.index'));
        }

        if(Sentinel::getUser()->type == 2){
            $this->studentRepository->delete($id);
        }

        Flash::success('Student deleted successfully.');

        $students = Student::where('department_id',$student->department_id)->where('session_id',$student->session_id)->get();
        return view('students.index_student')
            ->with('students', $students);
    }

    public function getImport()
    {
        
        return view('students.import');
    }

    public function parseImport(CsvImportRequest $request)
    {
        $csv_header_fields = null;
        $path = $request->file('csv_file')->getRealPath();
        if ($request->has('header')) {
            $data = Excel::load($path, function($reader) {})->get()->toArray();
        } else {
            $data = array_map('str_getcsv', file($path));
        }
        if (count($data) > 0) {
            if ($request->has('header')) {
                $csv_header_fields = [];
                foreach ($data[0] as $key => $value) {
                    $csv_header_fields[] = $key;
                }
            }
            // $csv_data = array_slice($data, 0, 2);
            $csv_data = $data;
            $csv_data_file = CsvData::create([
                'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
                'csv_header' => $request->has('header'),
                'csv_data' => json_encode($data)
            ]);
        } else {
            return redirect()->back();
        }

        $dep_id = Sentinel::getUser()->dep_id;
        if(Sentinel::getUser()->type == 1){
            $department = Department::pluck('name','id');
        }
        else{
            $department = Department::where('id',$dep_id)->pluck('name','id');
        }
        $session = Session::pluck('session','id');
        if($csv_header_fields){
            return view('students.parse', compact( 'csv_header_fields', 'csv_data', 'csv_data_file','department','session'));
        }
        else{
            return view('students.parse', compact('csv_data', 'csv_data_file','department','session'));
        }
        
    }

    public function processImport(Request $request)
    {
        $data = CsvData::find($request->csv_data_file_id);
        $csv_data = json_decode($data->csv_data, true);
        foreach ($csv_data as $row) {
            $contact = new Student;
            foreach (config('app.db_fields') as $index => $field) {
                if ($data->csv_header) {
                    $contact->$field = $row[$request->fields[$field]];
                } else {
                    $contact->$field = $row[$request->fields[$index]];
                }
            }
            $contact->department_id = $request->department_id;
            $contact->session_id = $request->session_id;
            $contact->save();
        }
        Flash::success('Student saved successfully.');

        $students = Student::where('department_id',$request->department_id)->where('session_id',$request->session_id)->get();
        
        return view('students.index_student')
            ->with('students', $students);
    }
}
