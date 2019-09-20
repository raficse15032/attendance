<?php

namespace App\Repositories;

use App\Models\CourseAssign;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CourseAssignRepository
 * @package App\Repositories
 * @version May 23, 2019, 6:09 pm UTC
 *
 * @method CourseAssign findWithoutFail($id, $columns = ['*'])
 * @method CourseAssign find($id, $columns = ['*'])
 * @method CourseAssign first($columns = ['*'])
*/
class CourseAssignRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'session_id',
        'course_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CourseAssign::class;
    }
}
