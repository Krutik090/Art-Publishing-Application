<?php

use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\ProfileController as AdminProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\frontend\FrontendController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', [FrontendController::class,'index'])->name('home');

Route::group(['prefix' => 'account'], function () {
    //Guest middleware
    Route::group(['middleware' => 'guest'], function () {

        Route::get('login', [LoginController::class, 'index'])->name('account.login');
        Route::get('register', [LoginController::class, 'register'])->name('account.register');
        Route::post('process-register', [LoginController::class, 'processRegister'])->name('account.processRegister');
        Route::post('authenticate', [LoginController::class, 'authenticate'])->name('account.authenticate');
        Route::post('password-request',[LoginController::class,'passwordRequest'])->name('account.password.request');


    });
    // Authenticated middleware
    Route::group(['middleware' => 'auth'], function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('account.dashboard');
        Route::get('logout', [LoginController::class, 'logout'])->name('account.logout');
    });


});


Route::group(['prefix' => 'admin'],function(){

    Route::group(['middleware' => 'admin.guest'],function(){
        Route::get('login',[AdminLoginController::class,'index'])->name('admin.login');
        Route::post('authenticate',[AdminLoginController::class,'authenticate'])->name('admin.authenticate');
        Route::get('password-request',[AdminLoginController::class,'passwordRequest'])->name('admin.password.request');
        Route::view('error-403','errors-403')->name('admin.error-403');
    });

    Route::group(['middleware' => 'admin.auth'], function(){
        Route::get('dashboard',[AdminDashboardController::class,'index'])->name('admin.dashboard');
        Route::get('logout',[AdminLoginController::class,'logout'])->name('admin.logout');
        Route::get('profile',[AdminProfileController::class,'index'])->name('admin.profile');
        Route::put('profile-update',[AdminProfileController::class,'update'])->name('admin.profile.update');

    });

});








