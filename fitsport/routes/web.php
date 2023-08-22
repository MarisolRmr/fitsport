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
use App\Http\Controllers\NutriologoController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\MetasController;
use App\Http\Controllers\RutinaController;

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
Route::get('/fitsport', [HomeController::class, 'index'])->name('paginaprincipal');

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
// guardar noticica
Route::post('/noticias', [NoticiasController::class, 'store'])->name('noticias.store');
//Ruta para mandar a la vista de editar ejercicio
Route::get('/noticias/edit/{id}', [NoticiasController::class, 'edit'])->name('noticia.editar');
//Ruta para modificar la noticia en la base de datos
Route::post('/updateNoticia/{id}', [NoticiasController::class, 'update'])->name('noticia.update');
//Ruta para eliminar la noticia de la base de datos
Route::get('/noticia/delete/{id}', [NoticiasController::class, 'delete'])->name('noticia.eliminar');


////////////////////////////////////////////////////////////////////////////////////////////
//                                  RUTAS PARA GYM ADN BOXES ADMIN
////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/GymAndBoxes',[GimnasiosController::class,'index'])->name('gymBoxes.index');
Route::get('/GymAndBoxes/agregar',[GimnasiosController::class,'create'])->name('addgymBoxes.create');
Route::post('/GymAndBoxes/agregar',[GimnasiosController::class,'store'])->name('addgymBoxes.store');
Route::get('/GymAndBoxes/delete/{id}', [GimnasiosController::class, 'delete'])->name('addgymBoxes.eliminar');
Route::get('/GymAndBoxes/edit/{id}', [GimnasiosController::class, 'edit'])->name('addgymBoxes.editar');
Route::post('/updateGymAndBoxes', [GimnasiosController::class, 'update'])->name('addgymBoxes.update');

////////////////////////////////////////////////////////////////////////////////////////////
//                                  RUTAS PARA EMTRENADOR ADMIN
////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/entrenador', [EntrenadorAdController::class,'index'])->name('entrenador.index');
//Ruta para la vista de agregar entrenador
Route::get('/entrenador/create', [EntrenadorAdController::class,'create'])->name('entrenador.create');
//Ruta para guardar los datos del entrenado
Route::get('/entrenador/create', [EntrenadorAdController::class,'create'])->name('entrenador.create');
//Ruta para visualizar el entrenador
Route::get('/entrenador/view/{id}', [EntrenadorAdController::class, 'view'])->name('entrenador.verEntrenador');
Route::post('/entrenador/create', [EntrenadorAdController::class,'store'])->name('entrenador.store');
Route::get('/entreador/edit/{id}', [EntrenadorAdController::class, 'edit'])->name('entrenador.editar');
Route::post('/updateEntrenador', [EntrenadorAdController::class, 'update'])->name('entrenador.update');
Route::get('/entrenador/delete/{id}', [EntrenadorAdController::class, 'delete'])->name('entrenador.eliminar');

////////////////////////////////////////////////////////////////////////////////////////////
//                                  RUTAS PARA EJERCICITATE ADMIN
////////////////////////////////////////////////////////////////////////////////////////////
//Ruta para la vista de listado entrenador
Route::get('/ejercicio', [EjerciciosController::class,'index'])->name('ejercicio.index');
//Ruta para la vista de agregar entrenador
Route::get('/ejercicio/create', [EjerciciosController::class,'create'])->name('ejercicio.create');
//Ruta para guardar los datos del entrenado
Route::post('/ejercicio/create', [EjerciciosController::class,'store'])->name("ejercicio.create.store");
//Ruta para mandar a la vista de editar ejercicio
Route::get('/ejercicio/edit/{id}', [EjerciciosController::class, 'edit'])->name('ejercicio.editar');
//Ruta para modificar la ejercicio en la base de datos
Route::post('/updateEjercicio', [EjerciciosController::class, 'update'])->name('ejercicio.update');
//Ruta para eliminar la ejercicio de la base de datos
Route::get('/ejercicio/delete/{id}', [EjerciciosController::class, 'delete'])->name('ejercicio.eliminar');
//Ruta para visualizar el ejercicio 
Route::get('/ejercicio/view/{id}', [EjerciciosController::class, 'view'])->name('ejercicio.verEjercicio');
//////////////////////////////Lado usuario
Route::get('/ejercitate', [EjerciciosController::class,'ejercitate'])->name('ejercitate.mostrar');
//Ruta para buscar el ejercicio
Route::get('/ejercicio/buscando', [EjerciciosController::class, 'buscar'])->name('ejercitate.buscar'); 
//Ruta para visualizar el ejercicio 
Route::get('/ejercitate/view/{id}', [EjerciciosController::class, 'viewE'])->name('ejercicio.verDetallesEjercicio');

////////////////////////////////////////////////////////////////////////////////////////////
//                                  RUTAS PARA NUTRIOLOGO
////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/Nutriologo',[NutriologoController::class,'index'])->name('admNutriologo.index');
Route::get('/Nutriologo/agregar',[NutriologoController::class,'create'])->name('admNutriologo.create');
Route::post('/Nutriologo/agregar',[NutriologoController::class,'store'])->name('admNutriologo.store');
Route::get('/Nutriologo/delete/{id}', [NutriologoController::class, 'delete'])->name('admNutriologo.eliminar');
Route::get('/Nutriologo/edit/{id}', [NutriologoController::class, 'edit'])->name('admNutriologo.editar');
Route::post('/updateNutriologo', [NutriologoController::class, 'update'])->name('admNutriologo.update');
//Ruta para visualizar el nutriologo en administrador
Route::get('/Nutriologo/view/{id}', [NutriologoController::class, 'view'])->name('admNutriologo.view');
//ver lo s nutriologos de parte del atleta
Route::get('/Nutriologos', [NutriologoController::class,'nutriologos'])->name('nutriologos.mostrar');
//Ruta para buscar el nutriologo
Route::get('/Nutriologos/buscando', [NutriologoController::class, 'buscar'])->name('nutriologos.buscar'); 
//Ruta para visualizar el nutriologo 
Route::get('/Nutriologos/view/{id}', [NutriologoController::class, 'viewN'])->name('nutriologos.verDatosNutriologo');

//perfil
Route::get('/perfil', [PerfilController::class,'index'])->name('perfil.index');
Route::get('/perfil/edit/{id}', [PerfilController::class, 'edit'])->name('perfil.editar');
Route::post('/updatePerfil/{id}', [PerfilController::class, 'update'])->name('perfil.update');

Route::get('/Noticias-atleta', [NoticiasController::class,'index_atleta'])->name('noticias.index_atleta');
Route::get('/noticias/buscando', [NoticiasController::class, 'buscar'])->name('ejercitate.buscar'); 
Route::get('/Noticias/{id}/detalle', [NoticiasController::class, 'detalles_index'])->name('noticias.detalles');


////////////////////////////////////////////////////////////////////////////////////////////
//                                  RUTAS PARA Metas
////////////////////////////////////////////////////////////////////////////////////////////

Route::get('/Metas',[MetasController::class,'index'])->name('metas.index');
Route::get('/Metas/agregar',[MetasController::class,'create'])->name('metas.create');
Route::post('/Metas/agregar',[MetasController::class,'store'])->name('metas.store');
Route::post('/Metas/cambiarEstado', [MetasController::class, 'cambiarEstado'])->name('metas.cambiarEstado');
Route::get('/Metas/cargaColumnaProceso', [MetasController::class, 'cargaColumnaProcesoPartial'])->name('metas.cargaColumnaProcesoPartial');
Route::get('/Metas/edit/{id}', [MetasController::class, 'edit'])->name('metas.editar');
Route::post('/updateMeta', [MetasController::class, 'update'])->name('meta.update');
Route::get('/Metas/delete/{id}', [MetasController::class, 'delete'])->name('metas.eliminar');



Route::get('/GymAndBoxes-atleta',[GimnasiosController::class,'index_atleta'])->name('gymBoxes.index_atleta');
Route::get('/gimnasios/buscando', [GimnasiosController::class, 'buscar'])->name('gymBoxes.buscar'); 
Route::get('/GymAndBoxes/{id}/detalle', [GimnasiosController::class, 'detalles_index'])->name('gymBoxes.detalles');


////////////////////////////////////////////////////////////////////////////////////////////
//                                  RUTAS PARA RUTINAS
////////////////////////////////////////////////////////////////////////////////////////////

Route::get('/Rutina',[RutinaController::class,'index'])->name('rutina.index');
Route::get('/Rutina/agregar',[RutinaController::class,'create'])->name('rutina.create');
Route::post('/Rutina/agregar',[RutinaController::class,'store'])->name('rutina.store');
Route::get('/Rutina/edit/{id}', [RutinaController::class, 'edit'])->name('rutina.editar');
Route::post('/updateMeta', [RutinaController::class, 'update'])->name('rutina.update');
Route::get('/Rutina/buscando', [RutinaController::class, 'buscar'])->name('rutina.buscar'); 
Route::get('/Rutina/delete/{id}', [RutinaController::class, 'delete'])->name('rutina.eliminar');