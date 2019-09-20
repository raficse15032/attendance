<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Student
 * @package App\Models
 * @version March 9, 2019, 6:42 am UTC
 *
 * @property integer department_id
 * @property integer session_id
 * @property string identity
 * @property string name
 * @property string remarks
 */
class Student extends Model
{
    use SoftDeletes;

    public $table = 'students';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'department_id',
        'session_id',
        'identity',
        'name',
        'remarks'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'department_id' => 'integer',
        'session_id' => 'integer',
        'identity' => 'string',
        'name' => 'string',
        'remarks' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'department_id' => 'required',
        'session_id' => 'session_id integer:unsigned:foreign,sessions,id select',
        'identity' => 'required',
        'name' => 'required'
    ];

    public function session()
    {
        return $this->belongsTo('App\Models\Session','session_id');
    }
    public function department()
    {
        return $this->belongsTo('App\Models\Department','department_id');
    }
}
