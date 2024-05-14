<?php

namespace App\Http\Controllers;
use App\Models\Paciente;

use Illuminate\Http\Request;

class RutinaController extends Controller
{
    public function index($id)
    {
        $pacientes = Paciente::join('users', 'users.id', '=', 'pacientes.user_id')
        ->where('pacientes.user_id', $id) // Filtrar por el id proporcionado
        ->select('pacientes.*', 'users.name')
        ->get();
        return view('rutina.index', ['pacientes' => $pacientes]);
    }

}
