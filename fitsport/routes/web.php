<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\NoticiasController;
use App\Http\Controllers\GimnasiosController;
use App\Http\Controllers\EjerciciosController;
use App\Http\Controllers\EntrenadorAdController;
/*
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

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'store']);
Route::post('/logout',[LogoutController::class,'store'])->name('logout');

//ruta para vista de registro de usuarios
Route::get('/signup', [RegisterController::class,'index'])->name('register');

//ruta para enviar datos al servidor
Route::post('/signup', [RegisterController::class,'store']);

Route::get('/noticias', [NoticiasController::class,'index'])->name('noticias.index');

//ruta para agregar nueva noticia
Route::get('/noticias/Nueva', [NoticiasController::class,'create'])->name('noticias.create');

// guardar categorias
Route::post('/noticias', [NoticiasController::class, 'store'])->name('noticias.store');

//Rutas Gyms
Route::get('/GymAndBoxes',[GimnasiosController::class,'index'])->name('gymBoxes.index');
Route::get('/GymAndBoxes/agregar',[GimnasiosController::class,'create'])->name('addgymBoxes');
Route::post('/GymAndBoxes/agregar',[GimnasiosController::class,'store'])->name('addgymBoxes.store');

//Ruta para la vista de listado entrenador
Route::get('/entrenador', [EntrenadorAdController::class,'index'])->name('entrenador.index');
//Ruta para la vista de agregar entrenador
Route::get('/entrenador/create', [EntrenadorAdController::class,'create'])->name('entrenador.create');
//Ruta para guardar los datos del entrenado
Route::get('/entrenador/create', [EntrenadorAdController::class,'create'])->name('entrenador.create');

//Ruta para la vista de listado entrenador
Route::get('/ejercicio', [EjerciciosController::class,'index'])->name('ejercicio.index');
//Ruta para la vista de agregar entrenador
Route::get('/ejercicio/create', [EjerciciosController::class,'create'])->name('ejercicio.create');
//Ruta para guardar los datos del entrenado
Route::post('/ejercicio/create', [EjerciciosController::class,'store'])->name("ejercicio.create.store");
