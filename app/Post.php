<?php
 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
 
    protected $fillable = ['title','description','photo','user_id','post_time'];
 
	public function user()
    {
        return $this->belongsTo(User::class);
    }

	public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('id','desc');
    }

    public function comments_post()
    {
        return $this->hasMany(Comment::class)->orderBy('id');
    }
}