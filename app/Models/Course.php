<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Course
 * @package App\Models
 * @version March 26, 2019, 3:26 am UTC
 *
 * @property string course
 * @property string course_code
 * @property integer department_id
 * @property integer semester_id
 */
class Course extends Model
{
    use SoftDeletes;

    public $table = 'courses';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'course',
        'course_code',
        'department_id',
        'semester_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'course' => 'string',
        'course_code' => 'string',
        'department_id' => 'integer',
        'semester_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'course' => 'required',
        'course_code' => 'required',
        'department_id' => 'required',
        'semester_id' => 'required'
    ];

    public function department()
    {
        return $this->belongsTo('App\Models\Department','department_id');
    }

    public function semester()
    {
        return $this->belongsTo('App\Models\Semester','semester_id');
    }
}
