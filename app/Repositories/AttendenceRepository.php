<?php

namespace App\Repositories;

use App\Models\Attendence;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AttendenceRepository
 * @package App\Repositories
 * @version March 27, 2019, 3:15 am UTC
 *
 * @method Attendence findWithoutFail($id, $columns = ['*'])
 * @method Attendence find($id, $columns = ['*'])
 * @method Attendence first($columns = ['*'])
*/
class AttendenceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'department_id',
        'session_id',
        'course_id',
        'date',
        'attendence',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Attendence::class;
    }
}
