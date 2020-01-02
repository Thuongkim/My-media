<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
/**
 * Class User
 * @package App\Models
 * @version December 27, 2019, 7:33 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection avatars
 * @property \Illuminate\Database\Eloquent\Collection gitUsers
 * @property \Illuminate\Database\Eloquent\Collection images
 * @property \Illuminate\Database\Eloquent\Collection links
 * @property string name
 * @property string email
 * @property string|\Carbon\Carbon email_verified_at
 * @property string password
 * @property boolean status
 * @property string remember_token
 */
class User extends Model implements Authenticatable
{
    // use SoftDeletes;
    use AuthenticableTrait;

    public $table = 'users';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'status',
        'remember_token'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'string',
        'status' => 'boolean',
        'remember_token' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'email' => 'required',
        'password' => 'required',
        'status' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function avatars()
    {
        return $this->hasMany(\App\Models\Avatar::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function gitUsers()
    {
        return $this->hasMany(\App\Models\GitUser::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function images()
    {
        return $this->hasMany(\App\Models\Image::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function links()
    {
        return $this->hasMany(\App\Models\Link::class, 'user_id');
    }
}
