<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ct extends Model
{
     use SoftDeletes;

    public $table = 'cts';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'department_id',
        'session_id',
        'course_id',
        'ct',
        'marks',
        'status',
        'user_id',
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
