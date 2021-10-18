<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['name'];

    public function posts()
    {
        return $this->belongsToMany('App\Post','post_category','category_id','post_id'); // viet the nay cho lo doi 1146;
        // sap xep category_id truoc post_id de lay ra post_id trong category .
    }

    public function scopeGetPost($query, $categoryId ){
            return $query->where('id', $categoryId);
    }
    public function categories()
    {
        return $this->belongsToMany('App\Post','post_category','post_id','category_id');
    }
}
