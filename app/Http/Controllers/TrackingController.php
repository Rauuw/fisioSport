<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function trackArms(Request $request)
    {
        // Ejecutar el script Python y capturar la salida
        $output = shell_exec('python ../IA/main.py');

        // Devolver la vista tracking.blade.php con la salida como datos
        return view('ejerciciosIA.martillo', ['output' => $output])->render();
        // return view('tracking.tracking');
    }
}
