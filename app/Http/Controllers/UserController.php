<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function createUser(Request $request)
    {

        $incomingData = $request->validate([
            'name' => ['required', 'min:3', 'max:30'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'program' => ['required'],
            'password' => ['required', 'min:8', 'max:200'],
        ]);

        $incomingData['password'] = bcrypt($incomingData['password']);
        $user = User::create($incomingData);
        Auth::login($user);

        return redirect('/login');
    }
    public function auth(Request $request)
    {
        $incomingData = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt(['email' => $incomingData['email'], 'password' => $incomingData['password']])) {
            $request->session()->regenerate();
        }
        return redirect('/profile');
    }
    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }
    public function profile()
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect('/login'); // Redirect to login if not authenticated
        }
        // Fetch the currently authenticated user
        $user = Auth::user();
        // Return a view with user data using an associative array
        return view('profile', ['user' => $user]);
    }
    public function showEditScreen(User $user)
    {
        return view('edit', [

            'user' => $user
        ]);
    }
    public function update(Request $request, User $user)
    {
        $incomingData = $request->validate([
            'name' => ['required', 'min:3', 'max:30'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'program' => ['required'],
            'password' => ['nullable', 'min:8'],
        ]);
        if (!empty($request['password'])) {
            $incomingData['password'] = bcrypt($request['password']);
        } else {
            $incomingData['password'] = $user['password'];
        }
        $user->update($incomingData);
        return redirect('/profile');
    }
    public function delete(User $user)
    {
        if ($user) {
            $user->delete();
            Auth::logout();
            return redirect('/login'); // Redirect to home or login page after deletion
        } else {
            return redirect('/profile');
        }
    }
}
