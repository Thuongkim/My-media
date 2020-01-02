<?php

namespace App\Repositories;

use App\Models\Text;
use App\Repositories\BaseRepository;

/**
 * Class TextRepository
 * @package App\Repositories
 * @version January 1, 2020, 4:20 pm UTC
*/

class TextRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'text'
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
        return Text::class;
    }
}
