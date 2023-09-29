<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $attributes['email'])->first();

        if (Hash::check($attributes['password'], $user->password)) {
            Auth::login($user);
            session()->regenerate();
            if($user->role == '0')
            {
                return redirect('dashboard')->with(['success' => 'You are logged in.']);
            }
            else if($user->role == '1')
            {
                return redirect('client')->with(['success' => 'You are logged in.']);
            }
            else
            {
                return redirect('freelancer')->with(['success' => 'You are logged in.']);
            }

        } else {
            return back()->withErrors(['email' => 'Email or password invalid. ']);
        }
    }

    public function destroy()
{
    if (Auth::check()) {
        $userRole = Auth::user()->role;

        Auth::logout();

        if ($userRole == 1 || $userRole == 2) {
            return redirect('/account/login');
        }

        return redirect('/login')->with(['success' => 'You\'ve been logged out.']);
    }
}
}
