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
}