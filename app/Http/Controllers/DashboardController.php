<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
{
   $user = $request->session()->get('user');

    // Total students
    $totalStudents = User::whereNotNull('name')->count();

    // Recently added students (latest users)
    $recentStudents = User::whereNotNull('name')
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();

    // Count all users (students)
    $totalStudents = User::whereNotNull('name')->count();

    return view('dashboard', compact('totalStudents' , 'recentStudents'));
}

    // Logout
    public function logout(Request $request)
    {
        $request->session()->forget('user');
        return redirect()->route('login');
    }
}
