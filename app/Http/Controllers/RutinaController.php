<?php

namespace App\Http\Controllers;

use App\Models\Ejercicio;
use App\Models\Fisioterapeuta;
use App\Models\Paciente;

use Illuminate\Http\Request;
use App\Models\Rutina;
use App\Models\RutinaEjercicio;
use Illuminate\Support\Facades\Auth;
use Psy\Readline\Hoa\Console;
use Illuminate\Support\Facades\DB;
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

        $pacientesEjercicioId = Paciente::join('users', 'users.id', '=', 'pacientes.user_id')
        ->where('pacientes.user_id', $id)
        ->select('pacientes.id')
        ->get();
        
        $ejerciciospaciente = Ejercicio::join('rutina_ejercicio', 'ejercicio.id', '=', 'rutina_ejercicio.ejercicio_id')
        ->where('rutina_ejercicio.paciente_id', $pacientesEjercicioId[0]->id)
        ->select('ejercicio.*')
        ->get();
        return view('rutina.index', 
        ['pacientes' => $pacientes,
        'ejercicios'=>$ejercicios,
        'rutinas' => $rutinas, 
        'ejerciciospaciente' => $ejerciciospaciente
    ]);
    }

    public function create(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'sesion' => 'required|integer',
    ]);
    $fisioterapeuta = Fisioterapeuta::where('user_id', Auth::id())->first();

        // Crear una nueva rutina
        $rutina = new Rutina();
        $rutina->nombre = $request->input('nombre');
        $rutina->descripcion = $request->input('descripcion');
        $rutina->sesion = $request->input('sesion');
        $rutina->fisioterapeuta_id = $fisioterapeuta->id; // Asignar el ID del fisioterapeuta autenticado, puedes ajustar esto según tu lógica de autenticación
        $rutina->fecha_creacion =  now();
        $rutina->fecha_modificacion = "10/10/2010";
        $rutina->save();

        return redirect()->back()->with('success', 'Rutina creada exitosamente.');

    }

    public function select($rutina_id, $paciente_id)
    { 
        $rutinaid = Rutina::findOrFail($rutina_id); 
        $pacientes = Paciente::join('users', 'users.id', '=', 'pacientes.user_id')
        ->where('pacientes.user_id', $paciente_id)
        ->select('pacientes.*', 'users.*')
        ->get();
        $ejercicios = Ejercicio::all();
        $rutinas = Rutina::all();

        return view('rutina.index', ['rutinaid' => $rutinaid, 'pacientes' => $pacientes,'ejercicios'=>$ejercicios,'rutinas' => $rutinas]);
    }



    public function addExerciseToRoutine(Request $request)
    {
        $request->validate([
            'rutina_id' => 'required|integer',
            'ejercicio_id' => 'required|integer',
            'paciente_id' => 'required|integer',
        ]);
        $pacientes = Paciente::join('users', 'users.id', '=', 'pacientes.user_id')
        ->where('pacientes.user_id', $request->input('paciente_id'))
        ->select('pacientes.*')
        ->get();

         $rutinaEjercicio = new RutinaEjercicio();
            $rutinaEjercicio->rutina_id =$request->input('rutina_id');
            $rutinaEjercicio->ejercicio_id =$request->input('ejercicio_id');
            $rutinaEjercicio->paciente_id =$pacientes[0]->id;
            $rutinaEjercicio->accion = false;
            $rutinaEjercicio->fecha = now();
            $rutinaEjercicio->save();

            return redirect()->back()->with(['success' => 'Ejercicio añadido a la rutina exitosamente.']);
    }
}
