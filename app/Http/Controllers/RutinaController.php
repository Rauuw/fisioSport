<?php

namespace App\Http\Controllers;
use App\Models\Paciente;

use Illuminate\Http\Request;

class RutinaController extends Controller
{
    public function index($id)
    {
        $pacientes = Paciente::join('users', 'users.id', '=', 'pacientes.user_id')
        ->where('pacientes.user_id', $id)
        ->select('pacientes.*', 'users.*')
        ->get();
        return view('rutina.index', ['pacientes' => $pacientes]);
    }

}
