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
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PaymentController;




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
	Route::get('/projects/show{id}', [ProjectController::class, 'show'])->name('projects.show1');
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
	//payment
	Route::post('/stripe/session/{contract_id}', [PaymentController::class, 'session'])->name('stripe.session');

	Route::get('/success', [PaymentController::class, 'success'])->name('success');
Route::get('/cancel', [PaymentController::class, 'cancel'])->name('cancel');
Route::prefix('admin')->group(function () {
    Route::get('/payments', [PaymentController::class, 'index'])->name('payment.index');
});




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

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
		Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
		Route::post('/projects/create', [ProjectController::class, 'store'])->name('projects.store');
		Route::get('/projects/list', [ProjectController::class, 'index'])->name('projects.index1');
		Route::get('/projects/e{id}', [ProjectController::class, 'edit'])->name('projects.edit1');

		
		Route::get('/tasks/create{projectId}', [TaskController::class, 'create'])->name('tasks.create');
		Route::post('/tasks/create', [TaskController::class, 'store'])->name('frontoffice.tasks.store');
		Route::get('/tasks', [TaskController::class, 'index'])->name('frontoffice.tasks.index');
		Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
		Route::get('/tasks{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
		Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
		Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
		
		Route::put('/projects/e{id}', [ProjectController::class, 'update'])->name('projects.update1');
		Route::get('/projects/created', [ProjectController::class, 'list'])->name('projects.list1');
		Route::get('/projects{id}', [ProjectController::class, 'show1'])->name('project.showC');
	




    });

    // Routes for freelancers
    Route::middleware('role:2')->group(function () {
        ///////////////////////////////////////
		///////---->FreeLancer ROUTES<----/////
		///////////////////////////////////////

		
        Route::get('/freelancer',[HomeController::class, 'home2'])->name('home2');;
		Route::get('/logout2', [SessionsController::class, 'destroy']);
		Route::get('/tasks/assigned', [TaskController::class ,'tasksAssignedToUser'])->name('tasks.assignedToYou');
		Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
		Route::get('apply/contract/{userId}/{projectId}/{cost}/{clientId}', [ContractController::class, 'apply'])->name('apply.contract');
		Route::get('/projects/{id}', [ProjectController::class, 'show1'])->name('project.show1');
        



		

		


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