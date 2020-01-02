<?php

namespace App\Repositories;

use App\Models\Avatar;
use App\Repositories\BaseRepository;

/**
 * Class AvatarRepository
 * @package App\Repositories
 * @version December 27, 2019, 7:35 am UTC
*/

class AvatarRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'image'
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
        return Avatar::class;
    }
}
