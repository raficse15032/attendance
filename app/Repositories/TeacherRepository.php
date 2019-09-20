<?php

namespace App\Repositories;

use App\Models\Teacher;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TeacherRepository
 * @package App\Repositories
 * @version May 24, 2019, 5:49 am UTC
 *
 * @method Teacher findWithoutFail($id, $columns = ['*'])
 * @method Teacher find($id, $columns = ['*'])
 * @method Teacher first($columns = ['*'])
*/
class TeacherRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'department',
        'type',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Teacher::class;
    }
}
