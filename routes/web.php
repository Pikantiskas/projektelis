<?php

use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\LogoutController;
use App\Http\Controllers\Authentication\RegistrationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostsStarsController;
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


//auth routes
Route::get('/register', [RegistrationController::class, 'index'])->name('authentication.register');
Route::post('/register', [RegistrationController::class, 'save']);

Route::get('/login', [LoginController::class, 'index'])->name('authentication.login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LogoutController::class, 'index'])->name('logout');

//post routes
Route::get('/post', [PostController::class, 'index'])->name('post');
Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
Route::post('/post/create', [PostController::class, 'save']);
Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.delete');


Route::post('/posts/{post}/stars', [PostsStarsController::class, 'store'])->name('posts.stars');
Route::delete('/posts/{post}/stars', [PostsStarsController::class, 'destroy'])->name('posts.stars');

//dashboard routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/dashboard', [DashboardController::class, 'filter'])->name('dashboard');

//notification routes
Route::get('/notification', [NotificationController::class, 'index'])->name('notification');
Route::post('/notification', [NotificationController::class, 'store'])->name('notification.create');



Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/home', function () {
    return view('home');
})->name('home');
