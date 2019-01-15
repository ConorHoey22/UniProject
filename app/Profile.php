<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //

    
    use Notifiable;

   



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'genreID_FK','userid_FK',
    ];

   
}
