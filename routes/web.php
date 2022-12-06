<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('dashboard', [UserController::class, 'dashboard']);
Route::get('', [UserController::class, 'welcome']);
Route::get('login', [UserController::class, 'index'])->name('login');
Route::post('custom-login', [UserController::class, 'customLogin'])->name('login.custom');
Route::get('register', [UserController::class, 'registration'])->name('register');
Route::post('custom-registration', [UserController::class, 'customRegistration'])->name('register.custom');
Route::get('logout', [UserController::class, 'signOut'])->name('logout');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('login', [AdminUserController::class, 'getLogin'])->name('admin.login');
    Route::get('logout', [AdminUserController::class, 'adminLogout'])->name('admin.logout');
    Route::post('login', [AdminUserController::class, 'postLogin'])->name('adminLoginPost');

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('dashboard', [AdminUserController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('users-list', [AdminUserController::class,'getAllUsers'] )->name('users-list');
        Route::get('admin-users-list', [AdminUserController::class,'getAllAdminUsers'] )->name('admin-users-list');
        Route::post('update-user-status', [AdminUserController::class, 'updateUserStatus']);
        Route::post('update-admin-user-status', [AdminUserController::class, 'updateAdminUserStatus']);
        Route::get('create-admin-users', [AdminUserController::class,'createAdminUser'])->name('create.admin');
        Route::post('store-admin-users', [AdminUserController::class,'storeAdminUser'])->name('store.admin');
    });
});
