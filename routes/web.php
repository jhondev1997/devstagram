<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register');


Route::controller(LoginController::class)->group( function(){
  Route::get('/login', 'index')->name('login');
  Route::post('/login', 'store');
});

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::controller(PostController::class)->group(function () {
  Route::get('/{user:username}', 'index')->name('posts.index');
  Route::get('/posts/create', 'create')->name('posts.create');
  Route::post('/posts', 'store')->name('posts.store');
  Route::get('/{user:username}/posts/{post}', 'show')->name('posts.show');
  Route::delete('/posts/{post}', 'destroy')->name('posts.destroy');
});

Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');

Route::post('/imagenes', [ImageController::class, 'store'])->name('imagenes.store');

// *Like a las fotos
Route::post('/post/{post}/likes', [LikeController::class, 'store'])->name('posts.like.store');
Route::delete('/post/{post}/likes', [LikeController::class, 'destroy'])->name('posts.like.destroy');

// *Rutas del perfil
Route::get('/administracion/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/administracion/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');

// *Siguiendo usuarios
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/follow', [FollowerController::class, 'destroy'])->name('users.unfollow');
