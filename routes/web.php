<?php

use Illuminate\Support\Facades\Route;

require(base_path('routes/route-list/route-auth.php'));

Route::middleware(['auth'])->group(function () {
  Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
  Route::view('/crear_notificacion', 'notificaciones.crear_notificacion')->name('crear_notificacion');
  Route::view('/crear_notificacion_paciente', 'notificaciones.crear_notificacion_paciente')->name('crear_notificacion_paciente');
  Route::post('/guardar_notificacion_fisio', [App\Http\Controllers\NotificacionesController::class, 'saveMensajeFisio'])->name('guardar_notificacion_fisio');
  Route::get('/ver_notificaciones', [App\Http\Controllers\NotificacionesController::class, 'index'])->name('ver_notificaciones');
  Route::view('/ver_mensajes/{id}', 'notificaciones.index_mensajes')->name('ver_mensajes');
  Route::get('/paciente', [App\Http\Controllers\FiseoterapeutaController::class, 'index'])->name('listar_pacientes');
  Route::post('/crear_paciente', [App\Http\Controllers\FiseoterapeutaController::class, 'crearPaciente'])->name('crear_paciente');

  Route::view('/martillo', 'ejerciciosIA.martillo')->name('martillo');
  Route::view('/entrelazada', 'ejerciciosIA.entrelazada')->name('entrelazada');
  Route::view('/lateral_espalda', 'ejerciciosIA.lateralespalda')->name('lateral');
  Route::get('/tracking', [App\Http\Controllers\TrackingController::class, 'trackArms'])->name('tracking');

  Route::get('/rutina/{id}', [App\Http\Controllers\RutinaController::class, 'index'])->name('listar_rutina');
  Route::get('/ejercicios/', [App\Http\Controllers\EjercicioController::class, 'index'])->name('listar_ejercicios');
  Route::get('/paciente',[App\Http\Controllers\FiseoterapeutaController::class, 'index'])->name('listar_pacientes');
  Route::post('/crear_paciente',[App\Http\Controllers\FiseoterapeutaController::class, 'crearPaciente'])->name('crear_paciente');

  Route::get('/rutina/{id}',[App\Http\Controllers\RutinaController::class, 'index'])->name('listar_rutina');
  Route::get('/ejercicios/',[App\Http\Controllers\EjercicioController::class, 'index'])->name('listar_ejercicios');
  Route::post('/ejercicio', [App\Http\Controllers\EjercicioController::class, 'store'])->name('ejercicio.store');
  Route::delete('/ejercicio/{id}', [App\Http\Controllers\EjercicioController::class, 'destroy'])->name('ejercicio.destroy');
  Route::get('/ejercicio/{id}/edit', [App\Http\Controllers\EjercicioController::class, 'edit'])->name('ejercicio.edit');
  Route::put('/ejercicio/{id}', [App\Http\Controllers\EjercicioController::class, 'update'])->name('ejercicio.update');

  //  Route::post('/rutina/creare', [App\Http\Controllers\RutinaController::class, 'creare'])->name('rutina.creare');
  Route::post('/crear-rutina', [App\Http\Controllers\RutinaController::class, 'create'])->name('crear_rutina');
  Route::get('/seleccionar_rutina/{rutina_id}/{paciente_id}', [App\Http\Controllers\RutinaController::class, 'select'])->name('seleccionar_rutina');
  Route::post('/rutina/add-exercise', [App\Http\Controllers\RutinaController::class, 'addExerciseToRoutine'])->name('rutina.addExercise');

  Route::get('/rutinaejercicio', [App\Http\Controllers\RutinaEjercicioController::class, 'index'])->name('rutina_ejercicio');
  Route::post('/rutina-create', [App\Http\Controllers\RutinaEjercicioController::class, 'createRutina'])->name('rutina_create');
  Route::post('/asign-ejer-rutina', [App\Http\Controllers\RutinaEjercicioController::class, 'asignarEjercicioRutina'])->name('asign_ejercicio');
  Route::get('/api/rutinas/{id}', [App\Http\Controllers\RutinaEjercicioController::class, 'obtenerRutina'])->name('obtener_rutina');

  // Route::get('/tracking', [App\Http\Controllers\TrackingController::class, 'trackArms'])->name('tracking');
});
Route::get('/prueba/{id}', [App\Http\Controllers\RutinaEjercicioController::class, 'getFisioByPaciente'])->name('prueba');