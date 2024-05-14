<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ejercicio;

class EjercicioController extends Controller
{ 
    public function index()
    {  $ejercicios = Ejercicio::all();
        return view('ejercicios.index', ['ejercicios' => $ejercicios]);
    }

    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'nombre' => 'required',
            'duracion' => 'required',
            'descripcion' => 'required',
            'video_demostrativo' => 'required|mimes:mp4|max:102400', // Max 100MB
        ]);

        // Guardar el video en el directorio de almacenamiento
        $videoPath = $request->file('video_demostrativo')->store('videos', 'public');

        // Crear un nuevo registro de ejercicio
        Ejercicio::create([
            'nombre' => $request->nombre,
            'duracion' => $request->duracion,
            'descripcion' => $request->descripcion,
            'repeticiones' => 0,
            'url_video_demostrativo' => $videoPath,
        ]);

        // Redirigir o retornar una respuesta según necesites
        return redirect()->back()->with('success', 'Video subido exitosamente.');
    }

    public function edit($id)
    {
        $ejercicio = Ejercicio::find($id);
        return view('ejercicios.edit', compact('ejercicio'));
    }
    

    public function destroy($id)
    {
        $ejercicio = Ejercicio::findOrFail($id);
        $ejercicio->delete();

        return redirect()->back()->with('success', 'Ejercicio eliminado correctamente');
    }

    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required',
            'duracion' => 'required',
            'descripcion' => 'required',
            'url_video_demostrativo' => 'required',
        ]);

        // Buscar el ejercicio por su ID
        $ejercicio = Ejercicio::findOrFail($id);

        // Actualizar los datos del ejercicio
        $ejercicio->nombre = $request->nombre;
        $ejercicio->duracion = $request->duracion;
        $ejercicio->descripcion = $request->descripcion;
        $ejercicio->url_video_demostrativo = $request->url_video_demostrativo;

        // Guardar los cambios
        $ejercicio->save();

        // Redireccionar con un mensaje de éxito
        return redirect()->route('ejercicio.index')->with('success', 'Ejercicio actualizado exitosamente.');
    }
}
