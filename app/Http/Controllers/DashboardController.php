<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController
{
    public function index()
    {
        $user = Auth::user();
        logger($user->role);
        return view('dashboard', compact('user'));
    }
}
