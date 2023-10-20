<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Comment;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{

public function create()
{
    return view('comments.create');
}

public function store(Request $request,$id)
{
    // Validate the request
    $request->validate([
        'body' => 'required|string',
    ]);
    $article = Article::find($id);

    // Create a new comment
    $comment = new Comment();
    $comment->article_id = $id;
    $comment->client_id = $article->client_id;  
    $comment->freelancer_id = Auth::user()->id; 
    $comment->body = $request->body;
    $comment->save();

    return redirect()->route('frontoffice.article.index'); 
}

public function edit($id)
{        $comment = Comment::find($id);
    return view('frontoffice.comment.edit', compact('comment'));
}

public function update(Request $request, $id)
{
    $comment = Comment::find($id);
    $comment->update([
        'body' => $request->body,
    ]);

    return redirect()->route('frontoffice.article.index')
        ->with('success', 'Comment updated successfully.');
}

public function destroy($id)
{   $comment = Comment::find($id);
    $comment->delete();

    return redirect()->route('frontoffice.article.index')
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
