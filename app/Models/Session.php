<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Session
 * @package App\Models
 * @version March 9, 2019, 6:38 am UTC
 *
 * @property string session
 */
class Session extends Model
{
    use SoftDeletes;

    public $table = 'sessions';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'session'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'session' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'session' => 'required'
    ];

    
}
