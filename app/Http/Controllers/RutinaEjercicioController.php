<?php

namespace App\Http\Controllers;

use App\Models\Ejercicio;
use App\Models\Fisioterapeuta;
use App\Models\Paciente;
use App\Models\Rutina;
use App\Models\RutinaEjercicio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RutinaEjercicioController extends Controller
{
    public function index()
    { 
        $ejercicios = Ejercicio::all();
        $rutinas = Rutina::all();
        return view('rutina_ejercicio.lista-rutina-ejercicio', 
        [
        'ejercicios'=>$ejercicios,
        'rutinas' => $rutinas, 
    ]);
    }


    public function createRutina(Request $request)
    {
      // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_creacion' => now(),
            'fecha_modificacion' => now()
    ]);
    $fisioterapeuta = Fisioterapeuta::where('user_id', Auth::id())->first();

        // Crear una nueva rutina
        $rutina = new Rutina();
        $rutina->nombre = $request->input('nombre');
        $rutina->descripcion = $request->input('descripcion');
        $rutina->fisioterapeuta_id = $fisioterapeuta->id; // Asignar el ID del fisioterapeuta autenticado, puedes ajustar esto según tu lógica de autenticación
        $rutina->fecha_creacion =  now();
        $rutina->save();

        return redirect()->back()->with('success', 'Rutina creada exitosamente.');

    }
    public function obtenerRutina($id)
        {
            $rutina = Rutina::with('ejercicios')->findOrFail($id);
            return response()->json($rutina);
        }
    public function asignarEjercicioRutina(Request $request)
    {
        $request->validate([
            'rutina_id' => 'required|integer',
            'ejercicio_id' => 'required|integer',
        ]);

         $rutinaEjercicio = new RutinaEjercicio();
            $rutinaEjercicio->rutina_id =$request->input('rutina_id');
            $rutinaEjercicio->ejercicio_id =$request->input('ejercicio_id');
            $rutinaEjercicio->save();

            return redirect()->back()->with(['success' => 'Ejercicio añadido a la rutina exitosamente.']);
    }

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
        $fisio = User::where('id', $id)
            ->value('fisioterapeuta_id');
        return $fisio;
    }
}
