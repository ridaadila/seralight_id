<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * 
     * 
     */
    protected $primaryKey = 'id_user';
    protected $fillable = [
        'name_user',
        'photo',
        'username',
        'email',
        'address',
        'phone',
        'gender',
        'birthday',
        'role',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function parent_category(){
        return $this->hasMany('App\Parent_Category', 'id_user', 'id_user');
    }

    public function product(){
        return $this->hasMany('App\Product', 'id_user');
    }

    public function transaction(){
        return $this->hasMany('App\Transaction', 'id_user');
    }

    public function category(){
        return $this->hasMany('App\Category', 'id_user', 'id_user');
    }
}
