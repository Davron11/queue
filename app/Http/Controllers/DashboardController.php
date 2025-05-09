<?php

namespace App\Http\Controllers;

use App\Models\Pilgrim;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController
{
    public function index()
    {
        $user = Auth::user();

        $pilgrims_count = Pilgrim::count();
        $confirmed_pilgrims_count = Pilgrim::where('hajj_status', 'confirmed')
            ->orWhere('umra_status', 'confirmed')
            ->count();
        $admins_count = User::count();

        return view('dashboard', [
            'user' => $user,
            'pilgrims_count' => $pilgrims_count,
            'confirmed_pilgrims_count' => $confirmed_pilgrims_count,
            'admins_count' => $admins_count
        ]);
    }
}
