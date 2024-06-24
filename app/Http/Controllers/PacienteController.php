<?php

namespace App\Http\Controllers;

use App\Models\Ejercicio;
use App\Models\Paciente;
use App\Models\Rutina;
use App\Models\RutinaEjercicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{
    public function index()
    {  $id = Paciente::where('user_id', Auth::id())->first();
       
        $pacientesEjercicios = RutinaEjercicio::where('paciente_id',$id->id)->get();
        $rutinaId = Rutina::where('id',$pacientesEjercicios[0]->rutina_id)->first();

        $rutinasPaciente = collect();
        foreach ($pacientesEjercicios as $ejercicio) {
            $eje = Ejercicio::find($ejercicio->ejercicio_id);
            if ( $eje) {
                $rutina = $eje; // Agregar el ejercicio como una propiedad de la rutina
                $rutinasPaciente->push($rutina);
            }
        }
        return view('paciente.mis-rutinas', 
        [
            'rutinaId' => $rutinaId,
            'rutinasPaciente' => $rutinasPaciente
    ]);
    }
}
