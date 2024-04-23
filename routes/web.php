<?php

use Illuminate\Support\Facades\Route;

require(base_path('routes/route-list/route-auth.php'));

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('/crear_notificacion', 'notificaciones.crear_notificacion')->name('crear_notificacion');