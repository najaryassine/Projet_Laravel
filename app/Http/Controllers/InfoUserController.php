<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class InfoUserController extends Controller
{
    public function create()
    {
        return view('user-profile');
    }

    public function create1()
    {
        return view('frontoffice.profile');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            'phone' => ['required', 'numeric', 'digits:8'],
            'date_of_birth' => ['required', 'date', 'before_or_equal:' . Carbon::now()->subYears(18)->format('Y-m-d')],
            'avatar' => ['image', 'max:2048'], 
            'about' => ['required', 'max:300'],
        ]);

        if ($request->hasFile('avatar')) {
             $uploadedAvatar = $request->file('avatar');
            $avatarFileName = $uploadedAvatar->getClientOriginalName();
            $avatarPath = $uploadedAvatar->storeAs('public/assets/img', $avatarFileName);
            $avatar = $avatarFileName;
            User::where('id', Auth::user()->id)->update(['avatar' => $avatar]);
        }

         User::where('id', Auth::user()->id)->update([
                'name' => $attributes['name'],
                'email' => $attributes['email'],
                'phone' => $attributes['phone'],
                'date_of_birth' => $attributes['date_of_birth'],
                'about' => $attributes['about'],
         ]);

        return redirect('/user-profile')->with('success', 'Profile updated successfully');
    }
    public function store1(Request $request)
    {
         $attributes = $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            'phone' => ['required', 'numeric', 'digits:8'],
            'date_of_birth' => ['required', 'date', 'before_or_equal:' . Carbon::now()->subYears(18)->format('Y-m-d')],
            'avatar' => ['image', 'max:2048'], 
            'about' => ['required', 'max:300'],
        ]);

        if ($request->hasFile('avatar')) {
            $uploadedAvatar = $request->file('avatar');
            $avatarFileName = $uploadedAvatar->getClientOriginalName();
            $avatarPath = $uploadedAvatar->storeAs('public/assets/img', $avatarFileName);
            $avatar = $avatarFileName;
            User::where('id', Auth::user()->id)
                ->update(['avatar' => $avatar]);
        }

            User::where('id', Auth::user()->id)->update([
                'name' => $attributes['name'],
                'email' => $attributes['email'],
                'phone' => $attributes['phone'],
                'date_of_birth' => $attributes['date_of_birth'],
                'about' => $attributes['about'],

        ]);
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
    $user = Auth::user();

    $request->validate([
        'old_password' => ['required', function ($attribute, $value, $fail) use ($user) {
            if (!Hash::check($value, $user->password)) {
                $fail('The old password is incorrect.');
            }
        }],
        'new_password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised(),'confirmed', function ($attribute, $value, $fail) use ($user) {
            if (Hash::check($value, $user->password)) {
                $fail('The new password cannot be the same as the old password.');
            }
        }],
    ]);

    $user->password = Hash::make($request->input('new_password'));
    $user->save();

    return redirect()->back()->with('success', 'Password updated successfully.');
    }
}