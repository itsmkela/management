<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function show()
    {
        return view('register'); // your register Blade
    }

    /**
     * Handle registration (mirrors LoginController style)
     */
    public function register(Request $request)
    {
        // Validate exactly like login
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ], [
   'name.required' => 'Student name is required.',
'email.required' => 'Email address is required.',
'email.email' => 'Please enter a valid email address.',
'email.unique' => 'This email address is already registered.',
'password.required' => 'Password is required.',
'password.min' => 'Password must be at least 6 characters long.',
'password.confirmed' => 'The password confirmation does not match.',

        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Optional: auto-login after register (like Auth::attempt)
        // auth()->login($user);
        // $request->session()->regenerate();

        return redirect()->route('login')
    ->with('status', 'You have successfully registered! Welcome, ' . $user->name . '.');
    }
}
