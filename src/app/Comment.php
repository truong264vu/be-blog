<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = ['content','parent_id','user_id' , 'post_id'];

    public function comments()
    {
        return $this->belongsTo('App\Comment','parent_id');
    }

    public function childComment() 
    {
        return $this->hasMany('App\Comment','parent_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function scopeGetCommentChild($query, $parent_id ){
        return $query->where('parent_id', $parent_id);
    }


}
