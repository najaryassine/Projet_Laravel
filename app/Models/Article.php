<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'category', 'content','client_id','freelancer_id']; 

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id'); 
    }
    public function comments()
    {
    return $this->hasMany(Comment::class);
    }
    public function isLikedByUser($user)
    {
        return $this->likes->contains(function ($like) use ($user) {
        return $like->freelancer_id == $user->id || $like->client_id == $user->id;
    });
    }


    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}