<?php

use Illuminate\Support\Facades\Route;

require (base_path('routes/route-list/route-auth.php'));

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::view('/crear_notificacion', 'notificaciones.crear_notificacion')->name('crear_notificacion');
    Route::post('/guardar_notificacion', [App\Http\Controllers\NotificacionesController::class, 'store'])->name('guardar_notificacion');
    Route::get('/ver_notificaciones', [App\Http\Controllers\NotificacionesController::class, 'index'])->name('ver_notificaciones');
    Route::view('/ver_mensajes/{id}', 'notificaciones.index_mensajes')->name('ver_mensajes');
    Route::get('/paciente', [App\Http\Controllers\FiseoterapeutaController::class, 'index'])->name('listar_pacientes');
    Route::post('/crear_paciente', [App\Http\Controllers\FiseoterapeutaController::class, 'crearPaciente'])->name('crear_paciente');
    Route::get('/tracking', [App\Http\Controllers\TrackingController::class, 'trackArms'])->name('tracking');
    Route::get('/rutina/{id}', [App\Http\Controllers\RutinaController::class, 'index'])->name('listar_rutina');
    Route::get('/ejercicios/', [App\Http\Controllers\EjercicioController::class, 'index'])->name('listar_ejercicios');
    Route::post('/ejercicio', [App\Http\Controllers\EjercicioController::class, 'store'])->name('ejercicio.store');
    Route::delete('/ejercicio/{id}', [App\Http\Controllers\EjercicioController::class, 'destroy'])->name('ejercicio.destroy');
    Route::get('/ejercicio/{id}/edit', [App\Http\Controllers\EjercicioController::class, 'edit'])->name('ejercicio.edit');
    Route::put('/ejercicio/{id}', [App\Http\Controllers\EjercicioController::class, 'update'])->name('ejercicio.update');
    //  Route::post('/rutina/creare', [App\Http\Controllers\RutinaController::class, 'creare'])->name('rutina.creare');
    Route::post('/crear-rutina', [App\Http\Controllers\RutinaController::class, 'create'])->name('crear_rutina');
    Route::get('/seleccionar-rutina/{id}', [App\Http\Controllers\RutinaController::class, 'select'])->name('seleccionar_rutina');
});