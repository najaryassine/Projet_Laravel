<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
{
    $perPage = 6; // Number of users per page
    $currentPage = Paginator::resolveCurrentPage();

    $users = User::all();

    // $users = User::table('users')->get();
    $data = $users->slice(($currentPage - 1) * $perPage, $perPage);
    $paginatedData = new LengthAwarePaginator(
        $data, count($users), $perPage, $currentPage,
        ['path' => Paginator::resolveCurrentPath()]
    );

    return view('user-management', ['users' => $paginatedData]);
}

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            'phone' => ['required', 'numeric', 'digits:8'],
            'date_of_birth' => ['required', 'date', 'before_or_equal:' . Carbon::now()->subYears(18)->format('Y-m-d')],
            'avatar' => ['image', 'max:2048'], 
        ]);

        $uploadedAvatar = $request->file('avatar');
        $avatarFileName = $uploadedAvatar->getClientOriginalName();
        $avatarPath = $uploadedAvatar->storeAs('public/assets/img', $avatarFileName);
        $avatar = $avatarFileName;


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->date_of_birth = $request->date_of_birth;
        $user->avatar = $avatar;

        $user->save();

        return redirect()->route('user-management')->with('success', 'User added successfully!');

    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required',
            'date_of_birth' => 'required|date',
        ]);

        // Update the user
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->date_of_birth = $request->date_of_birth;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user-management')->with('success', 'User deleted successfully!');
    }    
}