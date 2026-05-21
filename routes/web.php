<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\AdoptionRequestController;
use App\Http\Controllers\UserController;

Route::get('/', fn () => redirect()->route('login'));

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('pets', PetController::class);

    Route::get('/adoption-requests', [AdoptionRequestController::class, 'index'])->name('adoptions.index');
    Route::get('/pets/{pet}/adopt', [AdoptionRequestController::class, 'create'])->name('adoptions.create');
    Route::post('/pets/{pet}/adopt', [AdoptionRequestController::class, 'store'])->name('adoptions.store');
    Route::patch('/adoption-requests/{adoptionRequest}/approve', [AdoptionRequestController::class, 'approve'])->name('adoptions.approve');
    Route::patch('/adoption-requests/{adoptionRequest}/reject', [AdoptionRequestController::class, 'reject'])->name('adoptions.reject');
    Route::delete('/adoption-requests/{adoptionRequest}', [AdoptionRequestController::class, 'destroy'])->name('adoptions.destroy');

    Route::resource('users', UserController::class)->except(['show']);
});
