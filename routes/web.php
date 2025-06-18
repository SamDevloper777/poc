<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
   Route::get('dashboard', function () {
    $today = Carbon::now(); 
   
    $birthdayUsers = Cache::remember('birthday_users_today', 3600, function () use ($today) {
        return User::whereMonth('date_of_birth', $today->month)
                   ->whereDay('date_of_birth', $today->day)
                   ->get();
    });

    return view('dashboard', compact('birthdayUsers'));
})->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/role-permission', [RolePermissionController::class, 'index'])->name('role-permission.index');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::get('/users/{user}/assign-role', [UserRoleController::class, 'edit'])->name('users.assign-role');
Route::put('/users/{user}/assign-role', [UserRoleController::class, 'update'])->name('users.assign-role.update');

});

require __DIR__.'/auth.php';
