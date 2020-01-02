<?php

namespace App\Repositories;

use App\Models\Link;
use App\Repositories\BaseRepository;

/**
 * Class LinkRepository
 * @package App\Repositories
 * @version December 27, 2019, 7:34 am UTC
*/

class LinkRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'link',
        'status'
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
        return Link::class;
    }
}
