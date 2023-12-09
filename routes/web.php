<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Models\Follower;
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

//Pagina principalpal
Route::get('/', HomeController::class)->name('home');

//Crear usuario
Route::get('/register', [RegisterController::class, 'index'])->name('register'); //Utilizar alias para si por temas visuales se decide cambiar el nombre d ela url no afecte el código del proyecto
Route::post('/register', [RegisterController::class, 'store']);

//Inicio de sesión
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
//Cerrar sesión
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

//Perfil del usuario
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index'); //La URL recibe del controlador el username de la DB
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('post.show');
//Guardar comentarios de los post
Route::post('/{user:username}/posts/{post}', [CommentController::class, 'store'])->name('comment.store');
//Eliminar publicaciones
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

//Alamacenar imágenes
Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

//Like a las publicaciones
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.like.store');
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.like.destroy');

//Rutas edición del perfil
Route::get('/{user:username}/edit-perfil', [PerfilController::class, 'index'])->name('profile.index');
Route::post('/{user:username}/edit-perfil', [PerfilController::class, 'store'])->name('profile.store');

//Rutas para seguir a otros usuarios
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');