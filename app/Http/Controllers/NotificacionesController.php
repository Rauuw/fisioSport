<?php

namespace App\Http\Controllers;
use App\Models\Notificacion;
use App\Models\Notificaciones;
use Illuminate\Http\Request;

class NotificacionesController extends Controller
{
    public function index()
    {
        return view('notificaciones.index');
    }

    public function store(Request $request)
    {
        $notificacion = Notificaciones::create([
            'mensaje' => $request->input('mensaje'),
            'fecha_envio' => $request->input('fecha_envio'),
            'fisioterapeuta_id' => $request->input('fisioterapeuta_id'),
            'paciente_id' => $request->input('paciente_id'),
        ]);
        
        // return redirect()->route('notificaciones.index')->with('success', 'Notificación guardada correctamente');
    }
}
