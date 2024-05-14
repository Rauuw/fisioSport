<?php

namespace App\Http\Controllers;

use App\Models\Ejercicio;
use App\Models\Paciente;

use Illuminate\Http\Request;
use App\Models\Rutina;
use App\Models\RutinaEjercicio;

class RutinaController extends Controller
{ 
    public function index($id)
    {
        $pacientes = Paciente::join('users', 'users.id', '=', 'pacientes.user_id')
        ->where('pacientes.user_id', $id)
        ->select('pacientes.*', 'users.*')
        ->get();

        $ejercicios = Ejercicio::all();
        $rutinas = Rutina::all();
        return view('rutina.index', ['pacientes' => $pacientes,'ejercicios'=>$ejercicios,'rutinas' => $rutinas]);
    }

    public function create(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'sesion' => 'required|integer',
       ]);

        // Crear una nueva rutina
        $rutina = new Rutina();
        $rutina->nombre = $request->input('nombre');
        $rutina->descripcion = $request->input('descripcion');
        $rutina->sesion = $request->input('sesion');
        $rutina->fisioterapeuta_id = auth()->id(); // Asignar el ID del fisioterapeuta autenticado, puedes ajustar esto según tu lógica de autenticación
        $rutina->fecha_creacion =  now();
        $rutina->fecha_modificacion = "10/10/2010";
        $rutina->save();

        return redirect()->back()->with('success', 'Rutina creada exitosamente.');

    }

    public function select($id, $idRutina)
    {
        $rutina = Rutina::findOrFail($id); // Ejemplo: obtiene la rutina por su ID

        return view('seleccionar_rutina', ['rutina' => $rutina]);
    }
    public function crearRutinaEjercicio(Request $request, $pacienteId){
        $request->validate([
            'ejercicios' => 'required|array',
            'ejercicios.*' => 'exists:ejercicios,id', // Asegurar que los IDs de los ejercicios existen en la tabla de ejercicios
            $ejercicios = $request->input('ejercicios'),
        ]);
            // Asignar ejercicios a la rutina
            foreach ($ejercicios as $ejercicioId) {
                $rutinaEjercicio = new RutinaEjercicio();
                $rutinaEjercicio->rutina_id = $rutina->id;
                $rutinaEjercicio->ejercicio_id = $ejercicioId;
                $rutinaEjercicio->paciente_id = $pacienteId; // Asignar el ID del paciente a la relación rutina-ejercicio
                // Otros campos...
                $rutinaEjercicio->save();
            }
    }
}
