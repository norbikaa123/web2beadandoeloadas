<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UtController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChartController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/adatbazis', [DatabaseController::class, 'index'])->name('db.index');

Route::get('/kapcsolat', [ContactController::class, 'create'])->name('contact.create');
Route::post('/kapcsolat', [ContactController::class, 'store'])->name('contact.store');

Route::get('/diagram', [ChartController::class, 'index'])->name('chart.index');


/*
|--------------------------------------------------------------------------
| Auth Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Üzenetek
    Route::get('/uzenetek', [MessageController::class, 'index'])->name('messages.index');

    // Útvonalak CRUD
    Route::resource('utak', UtController::class);

    // Admin dashboard
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Admin szerepkör módosítás
    Route::patch('/admin/users/{user}/role', [AdminController::class, 'setRole'])
        ->name('admin.users.role');


    Route::get('/dashboard', function () {
        $user = auth()->user();

        if (! $user) {
            return redirect()->route('login');
        }

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // sima regisztrált felhasználó
        return redirect()->route('home');
        // ha inkább az utakra vagy üzenetekre menjen, akkor pl.:
        // return redirect()->route('utak.index');
        // vagy: return redirect()->route('messages.index');
    })->name('dashboard');
});


/*
|--------------------------------------------------------------------------
| Authentication Routes (login, register, logout, stb.)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';




