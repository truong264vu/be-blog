<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = ['title','short_content', 'content'];



    public function posts()
    {
        return $this->belongsToMany('App\Category','post_category','post_id','category_id'); 
    }

    public function likes() // user_post_like
    {
        return $this->belongsToMany('App\User','user_post_like','post_id','user_id'); 
    }

    public function scopeGetTag($query, $postId ){
        return $query->where('id', $postId);
    }
    public function scopeGetCategory($query, $categoryId ){
        return $query->where('id', $categoryId);
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category','post_category','post_id','category_id');
    }
}
