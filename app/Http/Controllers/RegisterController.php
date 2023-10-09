<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view('session.register');
    }

    public function create1()
    {
        return view('frontoffice.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
            'phone' => ['required', 'numeric', 'digits:8'],
            // 'avatar' => ['required', 'url'],
            'role' => ['required'],
            'date_of_birth' => ['required', 'date', 'before_or_equal:' . Carbon::now()->subYears(18)->format('Y-m-d')],
            'agreement' => ['accepted']
        ]);
    
        $attributes['password'] = Hash::make($attributes['password']);
        

        session()->flash('success', 'Your account has been created.');
        $user = User::create($attributes);
        Auth::login($user); 
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
    }
}
