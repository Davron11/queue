<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

Route::middleware([SetLocale::class])->group(function () {
    Route::get('/', fn() => view('welcome'));
    Route::get('/', function () {
        return redirect('login');
    });

    Route::get('/status', function () {
        return view('users.status');
    })->name('status');

    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::group([], function () {
        Route::get('/pilgrims/confirmedList', [\App\Http\Controllers\PilgrimController::class, 'confirmedList'])->name('pilgrims.confirmedList');
        Route::post('/pilgrims/addConfirm', [\App\Http\Controllers\PilgrimController::class, 'addConfirm'])->name('pilgrims.addConfirm');
        Route::post('/pilgrims/return/{id}', [\App\Http\Controllers\PilgrimController::class, 'returnWaiting'])->name('pilgrims.return');
        Route::post('/pilgrims/complete', [\App\Http\Controllers\PilgrimController::class, 'completeConfirms'])->name('pilgrims.complete');
        Route::resource('pilgrims', \App\Http\Controllers\PilgrimController::class);
    });
    Route::resource('users', UserController::class);

    Route::resource('states', \App\Http\Controllers\StateController::class);
    Route::resource('cities', \App\Http\Controllers\CityController::class);
    Route::resource('districts', \App\Http\Controllers\DistrictController::class);
    Route::resource('mahallas', \App\Http\Controllers\MahallaController::class);

    Route::post('/locale-switch', [\App\Http\Controllers\LocalizationController::class, 'switch'])->name('locale.switch');
    Route::get('/tour_operators', function (){
        return view('tour_operators');
    })->name('tour_operators');
});

require __DIR__.'/auth.php';
