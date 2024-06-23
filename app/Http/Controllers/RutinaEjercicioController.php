<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\User;
use Illuminate\Http\Request;

class RutinaEjercicioController extends Controller
{
    public function getAllPacientesByFisio($id)
    {
        $pacientes = Paciente::where('fisioterapeuta_id', $id)
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
}
