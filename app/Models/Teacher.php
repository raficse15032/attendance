<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Teacher
 * @package App\Models
 * @version May 24, 2019, 5:49 am UTC
 *
 * @property string name
 * @property string email
 * @property string department
 * @property string type
 * @property string status
 */
class Teacher extends Model
{
    use SoftDeletes;

    public $table = 'teachers';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'email',
        'department',
        'type',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'department' => 'string',
        'type' => 'string',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'email text text'
    ];

    
}
