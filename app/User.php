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
        'username', 'email', 'password','ageRange', 'userAge','country','location','userType','genre','profileDescription','soundCloudWidget','soundCloudProfile','word1'.'word2','word3','word4','word5','similarity','instruments','recommendationGenre','recommendationWord1','recommendationWord2','recommendationWord3','recommendationWord4','recommendationWord5','recommendationAge','recommendationLocation','recommendationInstruments','recommendationSimilarity','recommendationUserType',
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

    
    public function recommendation() // dont think we need this
    {
        //Relationship
        return $this->hasOne('App\Recommendation');
    }

}

?>