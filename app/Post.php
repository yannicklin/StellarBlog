<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'active'];

    protected $dates = ['published_at'];

    public function author()
    {
        return $this->belongsTo('App\User','author_id');
    }
}
