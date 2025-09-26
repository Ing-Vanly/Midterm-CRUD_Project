<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SystemSettingController;

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
//Role Management
Route::resource('/role', RoleController::class);
//System Settings
Route::post('/system-setting-update', [SystemSettingController::class, 'SystemSettingUpdate'])
    ->name('SystemSettingUpdate');
Route::resource('/settings', SystemSettingController::class);
Route::resource('/user', UserController::class)->name('index', 'user.index');
Route::post('/user/update-status', [UserController::class, 'updateStatus'])->name('user.update_status');
//Prfile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
//Category
Route::resource('/category', CategoryController::class);
//Product
Route::resource('/product', ProductController::class);
