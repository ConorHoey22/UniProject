<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{

    protected $table = 'follower';


    protected $fillable = [
        'user_id', 'follower_id',
    ];



    public function user()
    {

        //Relationship
        return $this->belongsTo("App\User");
    }
}

?>