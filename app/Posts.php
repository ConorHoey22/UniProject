<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{

    protected $table = 'posts';


    protected $fillable = [
        'postTitle', 'postContent',
    ];



    public function user()
    {

        //Relationship
        return $this->belongsTo("App\User");
    }
}

?>