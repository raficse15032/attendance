<?php

namespace App\Repositories;

use App\Models\Session;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SessionRepository
 * @package App\Repositories
 * @version March 9, 2019, 6:38 am UTC
 *
 * @method Session findWithoutFail($id, $columns = ['*'])
 * @method Session find($id, $columns = ['*'])
 * @method Session first($columns = ['*'])
*/
class SessionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'session'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Session::class;
    }
}
