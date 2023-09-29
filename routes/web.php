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


    });

    // Routes for freelancers
    Route::middleware('role:2')->group(function () {
        ///////////////////////////////////////
		///////---->FreeLancer ROUTES<----/////
		///////////////////////////////////////


        Route::get('/freelancer',[HomeController::class, 'home1']);
		Route::get('/logout2', [SessionsController::class, 'destroy']);


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