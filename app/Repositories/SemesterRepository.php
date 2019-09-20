<?php

namespace App\Repositories;

use App\Models\Semester;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SemesterRepository
 * @package App\Repositories
 * @version March 9, 2019, 6:39 am UTC
 *
 * @method Semester findWithoutFail($id, $columns = ['*'])
 * @method Semester find($id, $columns = ['*'])
 * @method Semester first($columns = ['*'])
*/
class SemesterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'semester'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Semester::class;
    }
}
