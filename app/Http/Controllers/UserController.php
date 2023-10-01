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
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;



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
            'password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
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
        $pass = Hash::make($request->password);
        $user->password = $pass;


        $user->save();

        return redirect()->route('user-management')->with('success', 'User added successfully!');

    }

    public function edit($id)
    { 
        $user = User::find($id);
        return view('updateUser')->with('user', $user);
    }

    public function update(Request $request,  $id)
    {


        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' ,
            'phone' => 'required',
            'date_of_birth' => 'required|date',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->date_of_birth = $request->date_of_birth;
        $user->save();

        return redirect()->route('user-management')->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user-management')->with('success', 'User deleted successfully!');
    }    
}