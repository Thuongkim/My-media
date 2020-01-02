<?php

namespace App\Repositories;

use App\Models\Git_user;
use App\Repositories\BaseRepository;

/**
 * Class Git_userRepository
 * @package App\Repositories
 * @version December 27, 2019, 7:36 am UTC
*/

class Git_userRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'git_user'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Git_user::class;
    }
}
