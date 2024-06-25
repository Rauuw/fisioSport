<?php

namespace App\Http\Controllers;

use App\Models\Fisioterapeuta;
use App\Models\Notificaciones;
use App\Models\Paciente;
use App\Http\Controllers\RutinaEjercicioController;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\ConsoleOutput;

class NotificacionesController extends Controller
{
    public function getMensajesByFisio()
    {
        $rutinaEjercicioController = new RutinaEjercicioController();
        $pacientes = $rutinaEjercicioController->getAllPacientesByFisio(auth()->user()->id);

        return view('notificaciones.index_notificaciones', compact('pacientes'));
    }

    public function getMensajesByFisio2()
    {
        $rutinaEjercicioController = new RutinaEjercicioController();
        $pacientes = $rutinaEjercicioController->getAllPacientesByFisio(auth()->user()->id);

        return view('fisioterapeuta.index_dashboard', compact('pacientes'));
    }

    public function saveMensajeFisio(Request $request)
    {
        $id_fisio = $this->getFisioByUser($request->input('fisioterapeuta_id'));
        Notificaciones::create([
            'mensaje' => $request->input('mensaje'),
            'fecha_envio' => $request->input('fecha_envio'),
            'fisioterapeuta_id' => $id_fisio,
            'paciente_id' => $request->input('paciente_id'),
            'tipo' => 'F', // La "F" es una cadena, no una expresión PHP
        ]);

        return view('notificaciones.crear_notificacion')->with('success', 'Notificación guardada correctamente');
    }

    public function saveMensajePaciente(Request $request)
    {
        $id_paciente = $this->getPacienteByUser(auth()->user()->id);
        Notificaciones::create([
            'mensaje' => $request->input('mensaje'),
            'fecha_envio' => $request->input('fecha_envio'),
            'fisioterapeuta_id' => $request->input('fisioterapeuta_id'),
            'paciente_id' => $id_paciente,
            'tipo' => 'P', // La "P" es una cadena, no una expresión PHP
        ]);

        return view('notificaciones.crear_notificacion_paciente')->with('success', 'Notificación guardada correctamente');
    }

    public function getFisioByUser($id)
    {
        $id_fisio = Fisioterapeuta::where('user_id', $id)
            ->value('id');

        return $id_fisio;
    }

    public function getPacienteByUser($id)
    {
        $id_paciente = Paciente::where('user_id', $id)
            ->value('id');

        return $id_paciente;
    }

    public function verMensajesFisio($id)
    {
        $notificaciones = Notificaciones::where('paciente_id', $id)
            ->select('tipo', 'mensaje')
            ->get();

        return view('notificaciones.index_mensajes', compact('notificaciones'));
    }

    public function verMensajesPaciente($id)
    {   
        $id_paciente = $this->getPacienteByUser($id);
        $notificaciones = Notificaciones::where('paciente_id', $id_paciente)
            ->select('tipo', 'mensaje')
            ->get();

        return view('notificaciones.index_mensajes', compact('notificaciones'));
    }
}
