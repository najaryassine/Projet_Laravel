<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::middleware('role:0')->group(function () {
    ///////////////////////////////////////
	///////------>Admin ROUTES<------//////
	///////////////////////////////////////

	Route::get('dashboard', function () {
		return view('dashboard');
	})->name('dashboard');

	Route::get('billing', function () {
		return view('billing');
	})->name('billing');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');

	Route::get('tables', function () {
		return view('tables');
	})->name('tables');

    Route::get('virtual-reality', function () {
		return view('virtual-reality');
	})->name('virtual-reality');

    Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

    Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');



	
	Route::get('/user-management', [UserController::class, 'index'])->name('user-management');
	Route::get('/users/add', function () {
		return view('addUser');
	});
	Route::post('/users/add', [UserController::class, 'store']);
	Route::get('/users/edit{id}', [UserController::class, 'edit'])->name('users.edit');
	Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
	Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
	Route::get('/article-management', [ArticleController::class, 'index1'])->name('article-management');
	Route::delete('/articles{article}', [ArticleController::class, 'destroy1'])->name('articles.destroy');
	Route::get('/articles/add', function () {
		return view('addArticle');
	});
	Route::post('/articles/add', [ArticleController::class, 'store1'])->name('articles.store');
	Route::get('/articles/edit{id}', [ArticleController::class, 'edit1'])->name('articles.edit');
	Route::put('/articles/{id}', [ArticleController::class, 'update1'])->name('articles.update');

	Route::get('/comment-management', [CommentController::class, 'index1'])->name('comment-management');
	Route::get('/comments/edit{id}', [CommentController::class, 'edit1'])->name('comments.edit');
	Route::put('/comments/{id}', [CommentController::class, 'update1'])->name('comments.update');
	Route::delete('/comments/{comment}', [CommentController::class, 'destroy1'])->name('comments.destroy');
	Route::get('/comments/add', [CommentController::class, 'create1'])->name('comments.add');
	Route::post('/comments/add', [CommentController::class, 'store1'])->name('comments.store');




	Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
    });



	
    // Routes for clients
    Route::middleware('role:1')->group(function () {
		///////////////////////////////////////
		///////---->Client ROUTES<----/////
		///////////////////////////////////////
        Route::get('/client', [HomeController::class, 'home1']);
		Route::get('/logout1', [SessionsController::class, 'destroy']);
		Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
		Route::post('/projects/create', [ProjectController::class, 'store'])->name('projects.store');


    });

    // Routes for freelancers
    Route::middleware('role:2')->group(function () {
        ///////////////////////////////////////
		///////---->FreeLancer ROUTES<----/////
		///////////////////////////////////////


        Route::get('/freelancer',[HomeController::class, 'home1']);
		Route::get('/logout2', [SessionsController::class, 'destroy']);
		Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');

//Route::get('/portfolios', [PortfolioController::class, 'index'])->name('portfolios.index');
Route::get('/articles', [ArticleController::class, 'index'])->name('frontoffice.article.index');

// Route::get('/portfolios/create', [PortfolioController::class, 'create'])->name('portfolios.create');
        Route::get('/article/create', [ArticleController::class, 'create'])->name('frontoffice.article.create');
	    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('frontoffice.article.delete');


//Route::post('/portfolios', [PortfolioController::class, 'store'])->name('portfolios.store');
        Route::post('/article', [ArticleController::class, 'store'])->name('frontoffice.article.store');

//Route::get('/portfolios/{portfolio}', [PortfolioController::class, 'show'])->name('portfolios.show');
        Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('frontoffice.article.show');

//Route::get('/portfolios/{portfolio}/edit', [PortfolioController::class, 'edit'])->name('portfolios.edit');

//Route::put('/portfolios/{portfolio}', [PortfolioController::class, 'update'])->name('portfolios.update');
Route::put('/article{article}', [ArticleController::class, 'update'])->name('frontoffice.article.update');

//Route::delete('/portfolios/{portfolio}', [PortfolioController::class, 'destroy'])->name('portfolios.destroy');
Route::get('/articles/{article}/comments', [CommentController::class, 'index'])
        ->name('frontoffice.article.comments');

Route::post('/articles/{article}/comments', [CommentController::class, 'store'])
->name('frontoffice.article.comments.store');

// Update Comment (GET and POST)
Route::get('/articles/{article}/comments/{comment}/edit', [CommentController::class, 'edit'])
    ->name('frontoffice.article.comments.edit');


// Delete Comment (GET and POST)
Route::delete('/articles/{article}/comments/{comment}', [CommentController::class, 'destroy'])
    ->name('frontoffice.article.comments.destroy');


Route::post('/articles/comment', [ArticleController::class, 'storeComment'])
    ->name('frontoffice.article.storeComment');

Route::get('/articlee/edit{id}', [ArticleController::class, 'edit'])->name('articles.edit');
Route::put('/articlee/edit{id}', [ArticleController::class, 'update'])->name('article.update');


// Like an article
Route::post('/articles/{article}/like', [LikeController::class, 'like'])->name('articles.like');

// Unlike an article
Route::delete('/articles/{article}/unlike',[LikeController::class, 'unlike'])->name('articles.unlike');

    });
});








///////////////////////////////////////
///////------>GUEST ROUTES<------//////
///////////////////////////////////////

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
	Route::get('/account/register', [RegisterController::class, 'create1']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	// Route::get('/login/forgot-password', [ResetController::class, 'create']);
	// Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	// Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	// Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');

//// LOGIN GUEST  CLIENT / FREELANCER
Route::get('/account/login', function () {
    return view('frontoffice/login-session');
})->name('login1');