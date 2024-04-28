<?php

use Illuminate\Support\Facades\Route;

require(base_path('routes/route-list/route-auth.php'));

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::view('/crear_notificacion', 'notificaciones.crear_notificacion')->name('crear_notificacion');
    Route::post('/guardar_notificacion', [App\Http\Controllers\NotificacionesController::class, 'store'])->name('guardar_notificacion');
    Route::get('/ver_notificaciones',[App\Http\Controllers\NotificacionesController::class, 'index'])->name('ver_notificaciones');
    Route::view('/ver_mensajes/{id}', 'notificaciones.index_mensajes')->name('ver_mensajes');
    Route::get('/paciente',[App\Http\Controllers\FiseoterapeutaController::class, 'index'])->name('listar_pacientes');
    Route::post('/crear_paciente',[App\Http\Controllers\FiseoterapeutaController::class, 'crearPaciente'])->name('crear_paciente');
});