<?php

namespace App\Http\Controllers;

use App\Models\Ejercicio;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index($id){
        
     // Obtener el ejercicio por ID
    $ejercicio = Ejercicio::find($id);
    // Verificar si el ejercicio existe
    if (!$ejercicio) {
        return abort(404, 'Ejercicio no encontrado');
    }

    // Verificar el nombre del ejercicio y renderizar la vista correspondiente
        switch ($ejercicio->nombre) {
            case 'martillo':
                return view('ejerciciosIA.martillo', ['ejercicio' => $ejercicio]);
            case 'lateralespalda':
                return view('ejerciciosIA.lateralespalda', ['ejercicio' => $ejercicio]);
            case 'entrelazada':
                return view('ejerciciosIA.entrelazada', ['ejercicio' => $ejercicio]);
            default:
                return view('ejerciciosIA.martillo', ['ejercicio' => $ejercicio]);
        }
    }
    public function trackArms(Request $request)
    {
        // Ejecutar el script Python y capturar la salida
        $output = shell_exec('python ../IA/main.py');

        // Devolver la vista tracking.blade.php con la salida como datos
        return view('ejerciciosIA.martillo', ['output' => $output])->render();
        // return view('tracking.tracking');
    }
}
