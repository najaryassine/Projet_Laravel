<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Like.php

class Like extends Model
{
    protected $fillable = ['freelancer_id', 'client_id', 'article_id'];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}