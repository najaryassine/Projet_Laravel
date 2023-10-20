<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Like;

class LikeController extends Controller
{
    public function like(Article $article)
    {
        $user = auth()->user();

        // Check if the user has already liked this article
        $existingLike = Like::where('article_id', $article->id)
            ->where(function ($query) use ($user) {
                $query->where('freelancer_id', $user->id)
                      ->orWhere('client_id', $user->id);
            })
            ->first();

        if (!$existingLike) {
            // The user hasn't liked the article, so create a new like
            $like = new Like([
                'article_id' => $article->id,
                'freelancer_id' => $user->role == 2 ? $user->id : null,
                'client_id' => $user->role == 1 ? $user->id : null,
            ]);

            $like->save();
            return back()->with('success', 'Article liked successfully.');
        } else {
            return back()->with('error', 'You have already liked this article.');
        }
    }

    public function unlike(Article $article)
    {
        $user = auth()->user();

        // Check if the user has already liked this article
        $existingLike = Like::where('article_id', $article->id)
            ->where(function ($query) use ($user) {
                $query->where('freelancer_id', $user->id)
                      ->orWhere('client_id', $user->id);
            })
            ->first();

        if ($existingLike) {
            // The user has already liked the article, so delete the like
            $existingLike->delete();
            return back()->with('success', 'Article unliked successfully.');
        } else {
            return back()->with('error', 'You have not liked this article.');
        }
    }
}