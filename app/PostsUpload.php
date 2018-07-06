<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostsUpload extends Model
{
    //comments table in database
    protected $guarded = [];

    public function post()
    {
        return $this->belongsTo('App\Posts','on_post');
    }

}
