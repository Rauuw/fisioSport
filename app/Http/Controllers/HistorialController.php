<?php

namespace App\Http\Controllers;

use App\Models\Historial;
use Illuminate\Http\Request;
use App\Http\Controllers\NotificacionesController;

class HistorialController extends Controller
{
    public function saveHistorial(Request $request){
        $id = $request->input('paciente_id');
        $noti = new NotificacionesController;
        $paciente = $noti->getPacienteByUser($id);
        $historial = new Historial();
        $historial->fecha_creacion = $request->input('fecha');
        $historial->historial = $request->input('historial');
        $historial->paciente_id = $paciente;
        $historial->save();

        $historial = Historial::where('paciente_id', $paciente)->get();
        return view('fisioterapeuta.ver_historial', compact('historial'));
    }

    public function getHistorial($id){
        $noti = new NotificacionesController;
        $paciente = $noti->getPacienteByUser($id);
        $historial = Historial::where('paciente_id', $paciente)->get();
        return view('fisioterapeuta.ver_historial', compact('historial'));
    }
}
