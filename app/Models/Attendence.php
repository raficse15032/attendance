<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attendence
 * @package App\Models
 * @version March 27, 2019, 3:15 am UTC
 *
 * @property integer department_id
 * @property integer session_id
 * @property integer course_id
 * @property string date
 * @property string attendence
 * @property string status
 */
class Attendence extends Model
{
    use SoftDeletes;

    public $table = 'attendences';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'department_id',
        'session_id',
        'course_id',
        'date',
        'attendence',
        'status',
        'user_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'department_id' => 'integer',
        'session_id' => 'integer',
        'course_id' => 'integer',
        'user_id' => 'integer',
        'date' => 'string',
        'attendence' => 'string',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'department_id' => 'required',
        'session_id' => 'required',
        'course_id' => 'required',
        'date' => 'required',
        'attendence' => 'required',
        'status' => 'required'
    ];

    public function course()
    {
        return $this->belongsTo('App\Models\Course','course_id');
    }

    public function user()
    {
        return $this->belongsTo('App\user','user_id');
    }

    
}
