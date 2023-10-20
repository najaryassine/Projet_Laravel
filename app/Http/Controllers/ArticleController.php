<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Article ; 
use App\Models\Comment;


class ArticleController extends Controller
{
     /**
     * Display a listing of the articles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        return view('frontoffice.article.index', compact('articles'));
    }
    public function index1()
    {
        $articles = Article::paginate(10); // Paginate the results
    
        return view('article-management', compact('articles'));
    }
    

    /**
     * Show the form for creating a new article.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontoffice.article.create');
    }

    /**
     * Store a newly created article in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'category' => 'required', // Adjust this to match your form field name
            'content' => 'required',
        ]);
    
        $validatedData['freelancer_id'] = auth()->id(); // Assuming the currently authenticated user is the freelancer.
        $validatedData['client_id'] = null; // Assuming there is no client assigned initially.
    
        $article = Article::create($validatedData);
    
        return redirect()->route('frontoffice.article.index')
            ->with('success', 'Article created successfully.');
    }
    

    /**
     * Display the specified article.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('frontoffice.article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified article.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit1($id)
    { 
        $articles = Article::find($id);
        return view('updateArticle')->with('article', $articles);
    }

    /**
     * Update the specified article in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        // Validate the request data
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'category' => 'required|string',
          
        ]);
    
        // Update the article attributes
        $article->update([
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
        ]);

    
        return redirect()->route('frontoffice.article.index')
            ->with('success', 'Article updated successfully.');
    }
    

    /**
     * Remove the specified article from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        // Delete the article
        $article->delete();
        return redirect()->route('frontoffice.article.index')
            ->with('success', 'Article deleted successfully.');
    }
    
    public function storeComment(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,id',
            'body' => 'required',
        ]);
    
        $comment = new Comment();
        $comment->article_id = $request->input('article_id');
        $comment->body = $request->input('body');
    
        // Set the appropriate ID based on the user's role
        if (auth()->user()->role == 2) {
            $comment->freelancer_id = auth()->user()->id;
        } elseif (auth()->user()->role == 3) {
            $comment->client_id = auth()->user()->id;
        }
    
        $comment->save();
        
        $articles = Article::with('comments')->get();
    
        return redirect()->route('frontoffice.article.show', $comment->article_id)
            ->with('success', 'Comment added successfully');
    }
    
    


    public function destroy1(Article $article)
    {
        $article->delete();
        return redirect()->route('article-management')->with('success', 'Article deleted successfully!');
    } 

    public function update1(Request $request,  $id)
    {


        $request->validate([
            'title' => 'required',
            'category' => 'required' ,
            'content' => 'required',
        ]);

        $article = Article::find($id);
        $article->title = $request->title;
        $article->category = $request->category;
        $article->content = $request->content;
        $article->save();

        return redirect()->route('article-management')->with('success', 'article updated successfully!');
    }


    public function create1()
    {
        return view('articles.create');
    }

    public function store1(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => ['required', 'max:50'],
            'category' => ['required', 'max:50'],
            'content' => ['required', 'max:50'],
        ]);
     


        $article = new Article();
        $article->title = $request->title;
        $article->category = $request->category;
        $article->content = $request->content;
      


        $article->save();

        return redirect()->route('article-management')->with('success', 'Article added successfully!');

    }

    public function edit($id)
    {
        $article = Article::find($id);
        return view('frontoffice.article.edit', compact('article'));
    }
    
    
 
    
    

}
