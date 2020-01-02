<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Avatar
 * @package App\Models
 * @version December 27, 2019, 7:35 am UTC
 *
 * @property \App\Models\User user
 * @property integer user_id
 * @property string image
 */
class Avatar extends Model
{
    // use SoftDeletes;

    public $table = 'avatars';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'image' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'image' => 'required|max:4096|mimes:jpg,jpeg,png,gif'
    ];

    public static function rules($id = 0) {

        return [
            'image'   => ($id == 0 ? 'required|' : '') . 'max:4096|mimes:jpg,jpeg,png,gif'
        ];

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
