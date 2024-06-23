<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use App\Models\Notificaciones;
use Illuminate\Http\Request;

class NotificacionesController extends Controller
{
    public function index()
    {
        $pacientes = \App\Models\Paciente::join('users', 'users.id', '=', 'pacientes.user_id')
            ->select('pacientes.*', 'users.name')
            ->get();

        return view('notificaciones.index_notificaciones', compact('pacientes'));
    }

    public function saveMensajeFisio(Request $request)
    {
        $notificacion = Notificaciones::create([
            'mensaje' => $request->input('mensaje'),
            'fecha_envio' => $request->input('fecha_envio'),
            'fisioterapeuta_id' => $request->input('fisioterapeuta_id'),
            'paciente_id' => $request->input('paciente_id'),
            'tipo' => 'F', // La "F" es una cadena, no una expresión PHP
        ]);

        return view('notificaciones.crear_notificacion')->with('success', 'Notificación guardada correctamente');
    }

    
}
