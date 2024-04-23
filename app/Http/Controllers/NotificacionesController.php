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
            'user_id' => auth()->id(),
            'titulo' => $request->input('titulo'),
            'mensaje' => $request->input('mensaje'),
        ]);
        
        return redirect()->route('notificaciones.index')->with('success', 'Notificación guardada correctamente');
    }
}
