<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController; 
use Illuminate\Support\Facades\Route;

 
Route::get('/', [HomeController::class, 'index'])->name('home'); 
 
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
 
Route::middleware(['auth'])->group(function () {
 
    Route::get('/restaurateur/dashboard', function () {
        return view('restaurateur.dashboard');
    })->middleware('role:restaurateur')->name('restaurateur.dashboard');
 
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->middleware('role:admin')->name('admin.dashboard');

});
 
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';