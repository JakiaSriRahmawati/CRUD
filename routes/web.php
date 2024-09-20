<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('postlogin', [AuthController::class, 'postlogin'])->name('postlogin');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('postregister', [AuthController::class, 'postregister'])->name('postregister');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/', [UserController::class, 'homePengguna'])->name('homePengguna');
Route::get('/dataUser', [UserController::class, 'dataUser'])->name('dataUser');

Route::get('/dataUser', [UserController::class, 'index'])->name('dataUser');


Route::get('/index', [UserController::class, 'index'])->name('index');

Route::get('/tambahdata', [UserController::class, 'tambahdata'])->name('tambahdata');
Route::post('/postTambahUser', [UserController::class, 'postTambahUser'])->name('postTambahUser');


Route::get('/deleted-users', [UserController::class, 'showDeletedUsers'])->name('deletedUsers');
Route::put('/restore-user/{id}', [UserController::class, 'restoreUser'])->name('restoreUser');
Route::delete('/force-delete-user/{id}', [UserController::class, 'forceDeleteUser'])->name('forceDeleteUser');

Route::delete('/softdeleteuser/{id}', [UserController::class, 'softDeleteUser'])->name('softDeleteUser');

Route::get('/users', [UserController::class, 'index'])->name('users.index');


Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('editUser');
Route::put('/update-user/{id}', [UserController::class, 'update'])->name('updateUser');




Route::resource('products', ProductController::class);