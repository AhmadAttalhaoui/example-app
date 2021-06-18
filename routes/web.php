<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MakeAdminController;
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

Route::get('/', [PostController::class, 'index'])->name('index');

Route::resource('posts', PostController ::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('user/{name}',[UserController::class,'profile'])->name('profile');

Route::get('make',[UserController::class,'make'])->name('make');

Route::get('like/{postid}',[LikeController::class, 'like'])->name('like');

Route::get('make',[MakeAdminController::class,'make'])->name('make');

Route::patch('/make_admin/{id}',[MakeAdminController::class,'update']);
