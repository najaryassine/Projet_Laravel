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
use App\Http\Controllers\Contract\ContractController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\AdminComplaintController;
use App\Http\Controllers\Review\ReviewController;
use App\Http\Controllers\Chat\PusherController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;


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

//////////User admin routes//////////////////////////////////////////////////////////////////////:///////////////
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

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////Projects admin routes////////////////////////////////////////////////////////////////////////////////////

	Route::get('/project-management', [ProjectController::class, 'index1'])->name('project-management');
	Route::get('/projects/add', [ProjectController::class, 'create1']);
	Route::post('/projects/add', [ProjectController::class, 'store1']);
	Route::delete('/projects/{project}', [ProjectController::class, 'destroy1'])->name('projects.destroy1');
	Route::get('/projects/show{id}', [ProjectController::class, 'show'])->name('projects.show');
	Route::get('/projects/edit{id}', [ProjectController::class, 'edit1'])->name('projects.edit1');
	Route::put('/projects/edit{id}', [ProjectController::class, 'update1'])->name('projects.update1');

////////////////////////////////////////////////////////////////////////////////////////////://///////////////////
//////////Contracts admin routes////////////////////////////////////////////////////////////////////////////////////
Route::get('/contracts-management', [ContractController::class, 'index1'])->name('contracts-management');
	Route::get('/contracts/add', [ContractController::class, 'create1']);
	Route::post('/contracts/add', [ContractController::class, 'store1']);
	Route::delete('/contracts/{project}', [ContractController::class, 'destroy1'])->name('contracts.destroy1');
	// Route::get('/contracts/show{id}', [ContractController::class, 'show'])->name('contracts.show1');
	Route::get('/contracts/edit{id}', [ContractController::class, 'edit1'])->name('contracts.edit1');
	Route::put('/contracts/edit{id}', [ContractController::class, 'update1'])->name('contracts.update1');


////////////////////////////////////////////////////////////////////////////////////////////://///////////////////
//////////complaints admin routes////////////////////////////////////////////////////////////////////////////////////
Route::get('/backoffice/complaints', [AdminComplaintController::class, 'index'])->name('backoffice.complaints.index');
Route::get('/backoffice/complaints/create', [AdminComplaintController::class, 'create'])->name('backoffice.complaints.create');
Route::post('/backoffice/complaints', [AdminComplaintController::class, 'store'])->name('backoffice.complaints.store');
Route::get('/complaints{complaint}', [AdminComplaintController::class, 'show'])->name('backoffice.complaints.show');
Route::get('/complaint/e{complaint}', [AdminComplaintController::class, 'edit'])->name('backoffice.complaints.edit');
Route::put('/complaints{complaint}', [AdminComplaintController::class, 'update'])->name('backoffice.complaints.update');
Route::delete('/complaints{complaint}', [AdminComplaintController::class, 'destroy'])->name('backoffice.complaints.destroy');

////////////////////////////////////////////////////////////////////////////////////////////://///////////////////
////////////article admin routes///////////////////////////////////////////////////////////://///////////////////
Route::get('/article-management', [ArticleController::class, 'index1'])->name('article-management');
	Route::delete('/articles{article}', [ArticleController::class, 'destroy1'])->name('articles.destroy');
	Route::get('/articles/add', function () {
		return view('addArticle');
	});
	Route::post('/articles/add', [ArticleController::class, 'store1'])->name('articles.store');
	Route::get('/articles/edit{id}', [ArticleController::class, 'edit1'])->name('articles.edit');
	Route::put('/articles/{id}', [ArticleController::class, 'update1'])->name('articles.update');

////////////////////////////////////////////////////////////////////////////////////////////://///////////////////
////////////Comment admin routes///////////////////////////////////////////////////////////://///////////////////
Route::get('/comment-management', [CommentController::class, 'index1'])->name('comment-management');
	Route::get('/comments/edit{id}', [CommentController::class, 'edit1'])->name('comments.edit');
	Route::put('/comments/{id}', [CommentController::class, 'update1'])->name('comments.update');
	Route::delete('/comments/{comment}', [CommentController::class, 'destroy1'])->name('comments.destroy');
	Route::get('/comments/add', [CommentController::class, 'create1'])->name('comments.add');
	Route::post('/comments/add', [CommentController::class, 'store1'])->name('comments.store');
////////////////////////////////////////////////////////////////////////////////////////////://///////////////////
////////////////////////////////////////////////////////////////////////////////////////////://///////////////////



    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
    });



	
    // Routes for clients
    Route::middleware('role:1')->group(function () {
		///////////////////////////////////////
		///////---->Client ROUTES<----/////
		///////////////////////////////////////
        Route::get('/client', [HomeController::class, 'home1'])->name('home1');;
		Route::get('/logout1', [SessionsController::class, 'destroy']);
		Route::get('/profile', [InfoUserController::class, 'create1']);
		Route::post('/profile', [InfoUserController::class, 'store1']);
		Route::post('/profile/password', [InfoUserController::class, 'updatePassword']);
		Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
		Route::post('/projects/create', [ProjectController::class, 'store'])->name('projects.store');
		Route::get('/projects/list', [ProjectController::class, 'index'])->name('projects.index1');
		Route::get('/projects/e{id}', [ProjectController::class, 'edit'])->name('projects.edit');
		Route::put('/projects/e{id}', [ProjectController::class, 'update'])->name('projects.update1');
		Route::get('/projects/created', [ProjectController::class, 'list'])->name('projects.list1');
		Route::get('/projects{id}', [ProjectController::class, 'show1'])->name('projects.showC');
		Route::delete('/projects{id}', [ProjectController::class, 'destroy0'])->name('projects.destroy0');
		Route::get('/contracts/lists', [ContractController::class, 'index'])->name('contracts.indexC');
		///////////////////////////////////////
		////////////Dorra Routes///////////////
		///////////////////////////////////////
		Route::match(['get', 'post','delete'],'/rate_review', [ReviewController::class, 'showForm'])->name('showForm');
		Route::match(['get', 'post','delete'],'/reviews', [ReviewController::class, 'store'])->name('reviews.store');
		Route::match(['get', 'post','delete'],'/review/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
		Route::put('/reviews/edit/{id}', [ReviewController::class, 'update'])->name('reviews.update');
		Route::get('/show/{id}', [ReviewController::class, 'show'])->name('reviews.show');
		// Route::get('/rate_review/{projectId}', [ReviewController::class, 'showForm'])->name('showForm');
		Route::get('/chat/{id}', [PusherController::class, 'index1'])->name('index1');
		Route::match(['get', 'post'], '/broadcast', [PusherController::class, 'broadcast'])->name('broadcast');
		Route::post('/receive', [PusherController::class, 'receive'])->name('receive');
		///////////////////////////////////////
		///////////////////////////////////////




    });

    // Routes for freelancers
    Route::middleware('role:2')->group(function () {
        ///////////////////////////////////////
		///////---->FreeLancer ROUTES<----/////
		///////////////////////////////////////
		Route::get('/profile2', [InfoUserController::class, 'create1']);
		Route::post('/profile2', [InfoUserController::class, 'store1']);
		Route::post('/profile2/password', [InfoUserController::class, 'updatePassword']);
		///////////////////////////////////////

        Route::get('/freelancer',[HomeController::class, 'home2'])->name('home2');;
		Route::get('/logout2', [SessionsController::class, 'destroy']);
		Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
		Route::get('apply/contract/{userId}/{projectId}/{cost}/{clientId}', [ContractController::class, 'apply'])->name('apply.contract');
		Route::get('/project{id}', [ProjectController::class, 'show1'])->name('projects.show1');
		Route::get('/contracts/list', [ContractController::class, 'index'])->name('contracts.index0');
		Route::delete('/contracts/list/delete{id}', [ContractController::class, 'destroy'])->name('contracts.destroy0');
		///////////////////////////////////////
		///portfolios du freelancer
		///////////////////////////////////////
		 Route::get('/portfolios', [PortfolioController::class, 'index'])->name('frontoffice.freelancers.portfolios.index');
		 Route::get('/portfolios/create', [PortfolioController::class, 'create'])->name('frontoffice.freelancers.portfolios.create');
		 Route::post('/portfolios', [PortfolioController::class, 'store'])->name('frontoffice.freelancers.portfolios.store');
		 Route::get('/portfolios/{portfolio}', [PortfolioController::class, 'show'])->name('frontoffice.freelancers.portfolios.show');
		 Route::get('/portfolio/edit{portfolio}', [PortfolioController::class, 'edit'])->name('frontoffice.freelancers.portfolios.edit');
		 Route::put('/portfolios/{portfolio}', [PortfolioController::class, 'update'])->name('frontoffice.freelancers.portfolios.update');
		 Route::delete('/portfolios/{portfolio}', [PortfolioController::class, 'destroy'])->name('frontoffice.freelancers.portfolios.destroy');
 		///////////////////////////////////////
		 ////Complaints routes
 		///////////////////////////////////////
		 Route::get('/complaints', [ComplaintController::class, 'index'])->name('frontoffice.freelancers.complaints.index');
		 Route::get('/complaints/create', [ComplaintController::class, 'create'])->name('frontoffice.freelancers.complaints.create');
		 Route::post('/complaints', [ComplaintController::class, 'store'])->name('frontoffice.freelancers.complaints.store');
		 Route::get('/complaints/{complaint}', [ComplaintController::class, 'show'])->name('frontoffice.freelancers.complaints.show');
		 Route::get('/complaint/edit{complaint}', [ComplaintController::class, 'edit'])->name('frontoffice.freelancers.complaints.edit');
		 Route::put('/complaints/{complaint}', [ComplaintController::class, 'update'])->name('frontoffice.freelancers.complaints.update');
		 Route::delete('/complaints/{complaint}', [ComplaintController::class, 'destroy'])->name('frontoffice.freelancers.complaints.destroy');
		 Route::get('/complaints/{complaint}/pdf', [ComplaintController::class, 'generatePDF'])->name('frontoffice.freelancers.complaints.pdf');
 
 		///////////////////////////////////////
		///////// ////Article routes///////
		///////////////////////////////////////

		Route::get('/articles', [ArticleController::class, 'index'])->name('frontoffice.article.index');
        Route::get('/article/create', [ArticleController::class, 'create'])->name('frontoffice.article.create');
	    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('frontoffice.article.delete');
        Route::post('/article', [ArticleController::class, 'store'])->name('frontoffice.article.store');

        Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('frontoffice.article.show');
   		Route::put('/article/comment/edit{id}', [CommentController::class, 'update'])->name('frontoffice.comment.update');
        Route::get('/articles/{article}/comments', [CommentController::class, 'index'])->name('frontoffice.article.comments');
		Route::post('/articles/comments{id}', [CommentController::class, 'store'])->name('frontoffice.article.comments.store');
		
		Route::get('/article/comment{id}', [CommentController::class, 'edit'])->name('frontoffice.article.comments.edit');
		Route::delete('/article/comments{id}', [CommentController::class, 'destroy'])->name('frontoffice.article.comments.destroy');
		Route::post('/articles/comment', [ArticleController::class, 'storeComment'])->name('frontoffice.article.storeComment');
		Route::get('/article/edit{id}', [ArticleController::class, 'edit'])->name('frontoffice.articles.edit');
		Route::put('/article/edit{id}', [ArticleController::class, 'update'])->name('frontoffice.article.update');


		///////////////////////////////////////
		///////////////////////////////////////

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

Route::get('/aboutus', function () {
    return view('frontoffice.aboutus');
});