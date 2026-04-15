<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Logout;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::get('/', [ChirpController::class, 'index']) ->name('home');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::post('/chirps', [ChirpController::class, 'store']) ->name('store');
    Route::get('/chirps/{chirp}/edit', [ChirpController::class, 'edit'])->name('edit');
    Route::put('/chirps/{chirp}', [ChirpController::class, 'update'])->name('update');
    Route::delete('/chirps/{chirp}', [ChirpController::class, 'destroy'])->name('destroy');
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function (Request $request) {

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
    ]);

    User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    return redirect('/')->with('success', 'Conta criada!');
});

// Login routes
Route::view('/login', 'auth.login')
    ->middleware('guest')
    ->name('login');

Route::post('/login', Login::class)
    ->middleware('guest');

// Logout route
Route::post('/logout', Logout::class)
    ->middleware('auth')
    ->name('logout');
