<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});
Route::get('/profile', function () {
    return view('profile');
});
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return "Admin panel";
    });
    Route::get('/admin/portfolio/{id}/edit', [PortfolioController::class, 'adminEdit'])->name('admin.portfolio.edit');
    Route::post('/admin/portfolio/{id}/update', [PortfolioController::class, 'adminUpdate'])->name('admin.portfolio.update');
    Route::get('/api/admin/users', [UserController::class, 'adminList']);
    Route::put('/api/admin/users/{id}', [UserController::class, 'adminUpdate']);
    Route::delete('/api/admin/users/{id}', [UserController::class, 'adminDelete']);
});
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/login', [UserController::class, 'login']);
Route::get('/profile', [PortfolioController::class, 'show'])->name('profile');
Route::get('/portfolio/edit', [PortfolioController::class, 'edit'])->name('portfolio.edit');
Route::post('/portfolio/update', [PortfolioController::class, 'update'])->name('portfolio.update');
Route::delete('/image/{id}', [PortfolioController::class, 'deleteImage']);
Route::get('/portfolio/{id}', [PortfolioController::class, 'view'])->name('portfolio.view');
Route::get('/api/portfolios/search', [PortfolioController::class, 'search']);

