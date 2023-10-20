<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Comment;
use App\Models\Article;



class CommentController extends Controller
{

public function create()
{
    return view('comments.create');
}

public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'body' => 'required|string',
        'user_type' => 'required|in:client,freelancer',
    ]);

    // Create a new comment
    $comment = new Comment();
    $comment->article_id = 1; // Replace with the actual article ID
    $comment->body = $request->input('body');

    // Determine the user type and set the user_id accordingly
    if ($request->input('user_type') === 'client') {
        $comment->client_id = auth()->user()->id;
    } elseif ($request->input('user_type') === 'freelancer') {
        $comment->freelancer_id = auth()->user()->id;
    }

    $comment->save();

    return redirect()->route('frontoffice.articles.show', 1); // Redirect to the article's show page
}

public function edit(Article $article, Comment $comment)
{
    // You may want to add authorization logic here to ensure the user can edit the comment.
    return view('comments.edit', compact('article', 'comment'));
}

public function update(Request $request, Article $article, Comment $comment)
{
    // You can add validation rules here to validate the updated comment.
    $comment->update([
        'body' => $request->input('body'),
    ]);

    return redirect()->route('frontoffice.article.show', $article)
        ->with('success', 'Comment updated successfully.');
}

public function destroy(Article $article, Comment $comment)
{
    // Add authorization logic to ensure the user can delete the comment.
    $comment->delete();

    return redirect()->route('frontoffice.article.show', $article)
        ->with('success', 'Comment deleted successfully.');
}

public function index1()
{
    $comments = Comment::paginate(10); // Paginate the results

    return view('comment-management', compact('comments'));
}
   /**
     * Show the form for editing the specified article.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

public function edit1($id)
    { 
        $comments = Comment::find($id);
        return view('updateComment')->with('comment', $comments);
    }


    public function destroy1(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('comment-management')->with('success', 'Comment deleted successfully!');
    } 

    public function update1(Request $request, $id)
{
    $request->validate([
        'body' => 'required',
    ]);

    $comment = Comment::find($id);
    $comment->body = $request->input('body'); // Use input to access the 'body' field from the request.
    $comment->save();

    return redirect()->route('comment-management')->with('success', 'Comment updated successfully!');
}


public function store1(Request $request)
{
    // Validate the request
    $request->validate([
        'body' => 'required|string',
        'article_id' => 'required|exists:articles,id', // Ensure the selected article exists
    ]);

    // Create a new comment
    $comment = new Comment();
    $comment->article_id = $request->input('article_id'); // Store the selected article ID
    $comment->body = $request->input('body');

    // Set the user's role as the role for the comment

    $comment->save();

    return redirect()->route('comment-management')->with('success', 'Comment created successfully.');
}



public function create1()
{
    // Fetch all articles
    $articles = Article::all(); // Assuming you have an Article model

    return view('addComment', compact('articles'));
}

}
