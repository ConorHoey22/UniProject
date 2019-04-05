<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{

    protected $table = 'follower';


    protected $fillable = [
         'follower_id','userid',
    ];



    public function user()
    {

        //Relationship
        return $this->belongsTo("App\User");
    }
}

?>