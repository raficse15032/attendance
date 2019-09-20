<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCourseAssignRequest;
use App\Http\Requests\UpdateCourseAssignRequest;
use App\Repositories\CourseAssignRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\User;
use App\Models\Course;
use App\Models\Session;
use App\Models\Department;
use App\Models\Semester;
use App\Models\CourseAssign;
use Sentinel;

class CourseAssignController extends AppBaseController
{
    /** @var  CourseAssignRepository */
    private $courseAssignRepository;

    public function __construct(CourseAssignRepository $courseAssignRepo)
    {
        $this->courseAssignRepository = $courseAssignRepo;
    }

    /**
     * Display a listing of the CourseAssign.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->courseAssignRepository->pushCriteria(new RequestCriteria($request));
        if(Sentinel::getUser()->type == 2){
            $dep_id = Sentinel::getUser()->dep_id;
            $course_id = Course::where('department_id',$dep_id)->pluck('id');
            $courseAssigns = CourseAssign::whereIn('course_id',$course_id)->get();
        }
        else if(Sentinel::getUser()->type == 1){
            $courseAssigns = $this->courseAssignRepository->all();
        }
        

        return view('course_assigns.index')
            ->with('courseAssigns', $courseAssigns);
    }

    /**
     * Show the form for creating a new CourseAssign.
     *
     * @return Response
     */
    public function create()
    {
        $user = User::pluck('name','id');
        $session = Session::pluck('session','id');
        $department = Department::all();
        $semester = Semester::all();

        if(Sentinel::getUser()->type == 2){
            $dep_id = Sentinel::getUser()->dep_id;
            $department2 = Department::where('id',$dep_id)->get();
        }
        return view('course_assigns.create',compact('user','semester','session','department','department2'));
    }

    /**
     * Store a newly created CourseAssign in storage.
     *
     * @param CreateCourseAssignRequest $request
     *
     * @return Response
     */
    public function store(CreateCourseAssignRequest $request)
    {
        $input = $request->all();

        $courseAssign = $this->courseAssignRepository->create($input);

        Flash::success('Course Assign saved successfully.');

        return redirect(route('courseAssigns.index'));
    }

    /**
     * Display the specified CourseAssign.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $courseAssign = $this->courseAssignRepository->findWithoutFail($id);

        if (empty($courseAssign)) {
            Flash::error('Course Assign not found');

            return redirect(route('courseAssigns.index'));
        }

        return view('course_assigns.show')->with('courseAssign', $courseAssign);
    }

    /**
     * Show the form for editing the specified CourseAssign.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = User::pluck('name','id');
        $session = Session::pluck('session','id');
        $course = Course::pluck('course','id');

        $courseAssign = $this->courseAssignRepository->findWithoutFail($id);

        if (empty($courseAssign)) {
            Flash::error('Course Assign not found');

            return redirect(route('courseAssigns.index'));
        }

        return view('course_assigns.edit',compact('user','session','course'))->with('courseAssign', $courseAssign);
    }

    /**
     * Update the specified CourseAssign in storage.
     *
     * @param  int              $id
     * @param UpdateCourseAssignRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCourseAssignRequest $request)
    {
        $courseAssign = $this->courseAssignRepository->findWithoutFail($id);

        if (empty($courseAssign)) {
            Flash::error('Course Assign not found');

            return redirect(route('courseAssigns.index'));
        }

        $courseAssign = $this->courseAssignRepository->update($request->all(), $id);

        Flash::success('Course Assign updated successfully.');

        return redirect(route('courseAssigns.index'));
    }

    /**
     * Remove the specified CourseAssign from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $courseAssign = $this->courseAssignRepository->findWithoutFail($id);

        if (empty($courseAssign)) {
            Flash::error('Course Assign not found');

            return redirect(route('courseAssigns.index'));
        }

        if(Sentinel::getUser()->type == 2){
            if($courseAssign->user_id == Sentinel::getUser()->id ){
                $this->courseAssignRepository->delete($id);
            }
        }

        Flash::success('Course Assign deleted successfully.');

        return redirect(route('courseAssigns.index'));
    }
}
