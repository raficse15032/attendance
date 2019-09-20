<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Course;
use App\User;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function departmentCourse($dep_id)
    {
        return Course::where('department_id',$dep_id)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function departmentSemesterCourse($dep_id,$sem_id)
    {
        
        return Course::where('department_id',$dep_id)->where('semester_id',$sem_id)->get();
    }

    public function departmentTeacher($dep_id)
    {
        return User::where('dep_id',$dep_id)->get();
    }

}
