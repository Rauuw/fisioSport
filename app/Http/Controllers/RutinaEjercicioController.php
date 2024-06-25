<?php

namespace App\Http\Controllers;

use App\Models\Fisioterapeuta;
use App\Models\Ejercicio;
use App\Models\Paciente;
use App\Models\Rutina;
use App\Models\RutinaEjercicio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function select($rutina_id)
    { 
        $rutinaid = Rutina::findOrFail($rutina_id); 
        $rutinas = Rutina::all();  // O la lógica necesaria para obtener las rutinas
        $ejercicios = Ejercicio::all();  // O la lógica necesaria para obtener los ejercicios
        $ejercicios_rutina = DB::table('rutina_ejercicio')
        ->join('ejercicio', 'rutina_ejercicio.ejercicio_id', '=', 'ejercicio.id')
        ->select('ejercicio.nombre', 'ejercicio.url_video_demostrativo', 'rutina_ejercicio.fecha')
        ->where('rutina_ejercicio.rutina_id', $rutina_id)
        ->get();
        return view('rutina_ejercicio.lista-rutina-ejercicio', compact('rutinaid', 'rutinas', 'ejercicios', 'ejercicios_rutina'))->with('success', 'Rutina seleccionada exitosamente.');
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
            $rutinaEjercicio->accion = false;
            $rutinaEjercicio->fecha =now();
          
            $rutinaEjercicio->save();

            return redirect()->back()->with(['success' => 'Ejercicio añadido a la rutina exitosamente.']);
    }

    public function getAllPacientesByFisio($id)
    {
        $id_fisio = Fisioterapeuta::where('user_id', $id)
            ->value('id');

        $pacientes = Paciente::where('fisioterapeuta_id', $id_fisio)
            ->join('users', 'users.id', '=', 'pacientes.user_id')
            ->select('pacientes.id', 'pacientes.user_id', 'users.name', 'users.lastname')
            ->get();
        return $pacientes;
    }

    public function getFisioByPaciente($id)
    {
        $fisio = Paciente::where('id', $id)
            ->value('fisioterapeuta_id');
        return $fisio;
    }
    
    public function getFisioByPacienteUser($id)
    {
        $fisio = Paciente::where('user_id', $id)
            ->value('fisioterapeuta_id');

        return $fisio;
    }

    //PUT
    public function saveCorrecto(Request $request,$ejercicio_id) {
        $noti = new NotificacionesController();
        $id_paciente = $noti->getPacienteByUser(auth()->user()->id);
        dd($id_paciente,$ejercicio_id);
        $segundos = intval($request->input('segundos'));
    
        $rutinaEjercicios = RutinaEjercicio::where('paciente_id', $id_paciente)
        ->where('ejercicio_id', $ejercicio_id)
        ->get();
     
        foreach ($rutinaEjercicios as $rutinaEjercicio) {
            $rutinaEjercicio->tiempo_ejercicio = $segundos; // Ajustado a tiempo_ejercicio en lugar de $segundos para usar el input directamente
            $rutinaEjercicio->cantidad_repeticiones = 10;
            $rutinaEjercicio->motivo = 'Ejercicio correcto';
            $rutinaEjercicio->save();
        }

        return redirect()->route('home')->with('success', 'Ejercicio guardado exitosamente.');
    }

    //PUT
    public function saveIncorrecto(Request $request,$ejercicio_id) {  
        // dd($request->All());
        $noti = new NotificacionesController();
        $id_paciente = $noti->getPacienteByUser(auth()->user()->id);
        $segundos = intval($request->input('segundos'));

        $rutinaEjercicios = RutinaEjercicio::where('paciente_id', $id_paciente)
        ->where('ejercicio_id', $ejercicio_id)
        ->get();
     
        foreach ($rutinaEjercicios as $rutinaEjercicio) {
            $rutinaEjercicio->tiempo_ejercicio = $segundos; // Ajustado a tiempo_ejercicio en lugar de $segundos para usar el input directamente
            $rutinaEjercicio->cantidad_repeticiones = $request->input('repeticiones');
            $rutinaEjercicio->motivo = $request->input('motivo');
            $rutinaEjercicio->save();
        }
        return redirect()->route('home')->with('success', 'Ejercicio guardado exitosamente.');
    }
    
}
