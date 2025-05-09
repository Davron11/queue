<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Pilgrim;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'pinfl' => 'required|digits:14',
            'password' => 'required',
        ]);

        // 1. Поиск среди администраторов
        $user = User::where('pinfl', $credentials['pinfl'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();

            if ($user->role->slug !== 'users') {
                return redirect('dashboard');
            } else {
                return redirect(route('pilgrims.show', ['id' => $user->id]));
            }
        }

        // 2. Поиск среди паломников
        $pilgrim = Pilgrim::where('pinfl', $credentials['pinfl'])->first();

        if ($pilgrim && Hash::check($credentials['password'], $pilgrim->password)) {
            Auth::guard('pilgrim')->login($pilgrim); // обязательно создай guard 'pilgrim'
            $request->session()->regenerate();

            return redirect()->route('pilgrims.show', $pilgrim->id); // или куда тебе нужно
        }

        // 3. Неверные данные
        return back()->withErrors(['pinfl' => 'Неверный ПИНФЛ или пароль.']);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
