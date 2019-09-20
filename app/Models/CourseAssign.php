<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CourseAssign
 * @package App\Models
 * @version May 23, 2019, 6:09 pm UTC
 *
 * @property integer user_id
 * @property integer session_id
 * @property integer course_id
 */
class CourseAssign extends Model
{
    use SoftDeletes;

    public $table = 'course_assigns';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'session_id',
        'course_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'session_id' => 'integer',
        'course_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'session_id' => 'required',
        'course_id' => 'required'
    ];

    public function course()
    {
        return $this->belongsTo('App\Models\Course','course_id');
    }

    public function user()
    {
        return $this->belongsTo('App\user','user_id');
    }

    public function session()
    {
        return $this->belongsTo('App\Models\Session','session_id');
    }
}
