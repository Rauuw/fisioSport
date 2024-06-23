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

    //PUT
    public function saveCorrecto(Request $request) {
        $noti = new NotificacionesController();
        $id_paciente = $noti->getPacienteByUser(auth()->user()->id);
        $segundos = intval($request->input('segundos'));
    
        $rutinaEjercicio = new RutinaEjercicio();
        
        $rutinaEjercicio->accion = true;
        $rutinaEjercicio->fecha = now()->format('Y-m-d');
        $rutinaEjercicio->tiempo_ejercicio = $segundos;
        $rutinaEjercicio->cantidad_repeticiones = 10;
        $rutinaEjercicio->motivo = 'Ejercicio correcto';
        $rutinaEjercicio->paciente_id = $id_paciente;
    
        $rutinaEjercicio->save();
    }

    //PUT
    public function saveIncorrecto(Request $request) {  
        
    }
    
}
