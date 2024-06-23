<?php

namespace App\Http\Controllers;

use App\Models\Fisioterapeuta;
use App\Http\Controllers\NotificacionesController;
use App\Models\Paciente;
use App\Models\RutinaEjercicio;
use App\Models\User;
use Illuminate\Http\Request;

class RutinaEjercicioController extends Controller
{
    public function getAllPacientesByFisio($id)
    {
        $id_fisio = Fisioterapeuta::where('user_id', $id)
            ->value('id');

        $pacientes = Paciente::where('fisioterapeuta_id', $id_fisio)
            ->join('users', 'users.id', '=', 'pacientes.user_id')
            ->select('pacientes.id', 'pacientes.user_id', 'users.name', 'users.lastname')
            ->get();
        return $pacientes;
    }

    public function getFisioByPaciente($id)
    {
        $fisio = Paciente::where('id', $id)
            ->value('fisioterapeuta_id');
        return $fisio;
    }
    
    public function getFisioByPacienteUser($id)
    {
        $fisio = Paciente::where('user_id', $id)
            ->value('fisioterapeuta_id');

        return $fisio;
    }

    public function saveCorrecto(Request $request) {
        $noti = new NotificacionesController();
        $id_paciente = $noti->getPacienteByUser(auth()->user()->id);
        $segundos = intval($request->input('segundos'));
        RutinaEjercicio::create([
            'accion' => True,
            'fecha' => now()->format('Y-m-d'),
            'tiempo_ejercicio' => $segundos,
            'cantidad_repeticiones' => 10,
            'motivo' => 'Ejercicio correcto',
            'paciente_id' => $id_paciente
        ]);
    }
    
}
