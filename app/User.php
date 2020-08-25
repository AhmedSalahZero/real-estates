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
     */
    protected $fillable = [
        'name', 'email', 'password' , 'image' ,'role',
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
    public function estates(){
         return $this->hasMany('App\Estate');

    }
    public function is_Admin()
    {
        return $this->role  ;
    }
//    public function getNameAttribute($password){
//        return 'My password is ' . $password ;
//    }
//    public function setPasswordAttribute($password){
//        $this->attributes['password'] = bcrypt($password);
//
//    }
//    public function getNameAttribute($name){
//        return 'my name is ' . ucfirst($name);
//    }
//    public function getIdAttribute($id){
//        return 'my Id = ' . $id ;
//    }
//    public function setPasswordAttribute($password){
//        $this->attributes['password'] = bcrypt($password) ;
//
//    }

}
