<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Semester
 * @package App\Models
 * @version March 9, 2019, 6:39 am UTC
 *
 * @property string semester
 */
class Semester extends Model
{
    use SoftDeletes;

    public $table = 'semesters';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'semester'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'semester' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'semester' => 'required'
    ];

    
}
