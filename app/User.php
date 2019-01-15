<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
//use Ilumminate\Contracts\Auth\Authenticatable;

use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable
{



    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','country','location','userType','genre','profileDescription','soundCloudWidget','soundCloudProfile',
    ];


     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];




    public function posts()
    {
        //Relationship
        return $this->hasMany('App\Posts');
    }

    
    public function recommendation()
    {
        //Relationship
        return $this->hasOne('App\Recommendation');
    }

}

?>