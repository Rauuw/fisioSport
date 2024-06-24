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


        $pacientesEjercicios = RutinaEjercicio::where('paciente_id',$pacientesEjercicioId[0]->id)->get();
        $rutinaId = null;
        $rutinasPaciente = collect();
        if($pacientesEjercicios->isNotEmpty()){
            $rutinaId = Rutina::find($pacientesEjercicios[0]->rutina_id);

            $rutinasPaciente = collect();
            foreach ($pacientesEjercicios as $ejercicio) {
                $eje = Ejercicio::find($ejercicio->ejercicio_id);
                if ( $eje) {
                    $rutina = $eje; // Agregar el ejercicio como una propiedad de la rutina
                    $rutinasPaciente->push($rutina);
                }
            }
        }
        return view('rutina.index', 
        ['pacientes' => $pacientes,
        'ejercicios'=>$ejercicios,
        'rutinas' => $rutinas, 
        'rutinaId' => $rutinaId,
        'rutinasPaciente' => $rutinasPaciente
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
    public function select(Request $request, $paciente_id)
    {  
        $request->validate([
            'rutina_id' => 'required|integer',
            'sesion' => 'required|integer',
        ]);
        $rutina = Rutina::findOrFail($request->input('rutina_id'));
        
        // Actualizar la rutina con los datos enviados
        $rutina->sesion = $request->input('sesion');
        $rutina->save();
        // Aquí puedes realizar otras operaciones si es necesario, como obtener datos adicionales
        $pacientes = Paciente::join('users', 'users.id', '=', 'pacientes.user_id')
        ->where('pacientes.user_id', $paciente_id)
        ->select('pacientes.*')
        ->get();
        $rutinaEjercicios = RutinaEjercicio::where('rutina_id', $rutina->id)->get();
    
        foreach ($rutinaEjercicios as $rutinaEjercicio) {
            $rutinaEjercicio->paciente_id = $pacientes[0]->id;
            $rutinaEjercicio->save();
        }
        // Redirigir de vuelta con un mensaje de éxito
        return redirect()->back()->with('success', 'Rutina actualizada exitosamente.');
    }
  /*   public function select($rutina_id, $paciente_id)
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
 */


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
