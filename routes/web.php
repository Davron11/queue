<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

Route::get('/new-villager', function () {
    return view('new_villager');
})->name('new_villager');

Route::get('/queue', function () {
    return view('queue');
})->name('queue');

Route::get('/add', function () {
    return view('admin.add_user');
})->name('add');

Route::get('/status', function () {
    return view('users.status');
})->name('status');

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('users', UserController::class);
Route::resource('pilgrims', \App\Http\Controllers\PilgrimController::class);
Route::resource('states', \App\Http\Controllers\StateController::class);
Route::resource('cities', \App\Http\Controllers\CityController::class);
Route::resource('districts', \App\Http\Controllers\DistrictController::class);
Route::resource('mahallas', \App\Http\Controllers\MahallaController::class);

require __DIR__.'/auth.php';
