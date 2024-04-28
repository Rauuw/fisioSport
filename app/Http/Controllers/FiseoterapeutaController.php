<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class FiseoterapeutaController extends Controller
{
    public function index()
    {
        $pacientes = \App\Models\Paciente::join('users', 'users.id', '=', 'pacientes.user_id')
            ->select('pacientes.*', 'users.name')
            ->get();

        return view('fisioterapeuta.listar_pacientes', compact('pacientes'));
    }

    public function store(Request $request)
    {
     }
    public function crearPaciente(Request $request){
        $user = User::create([
            'name' => $request['name'],
            'lastname' => $request['lastname'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'tipo' => 'P',
        ]);
    
        $userId = $user->id;
        $fisio = Auth::user();
        
        if ($fisio) {
         $pacientes = Paciente::create([
                'fecha_nacimiento' => $request['fecha_nacimiento'],
                'genero' => $request['genero'],
                'telefono' => $request['telefono'],
                'user_id' => $userId,
                'fisioterapeuta_id' =>  Auth::id(),
            ]);
        }

        $pacientes = \App\Models\Paciente::join('users', 'users.id', '=', 'pacientes.user_id')
        ->select('pacientes.*', 'users.name')
        ->get();

    
      return view('fisioterapeuta.listar_pacientes', compact('user','pacientes'));
    }


}
