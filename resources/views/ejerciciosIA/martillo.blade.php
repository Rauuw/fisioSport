@extends('layouts.plantillabase')

@section('title', 'Home')
@section('h-title', 'Tracking')
@section('card-title', '')

@section('content')
    <h1>PASOS:
    </h1>
    <h3>
        <br>
        1: Vea el vídeo de referencia para aprender el movimiento a realizar
        <br>
        2: Memorice el movimiento
        <br>
        3: Dele click a empezar para comenzar el ejercicio
        <br>
        4: Cuando haya finalizado presiones la tecla "q" para cerrar la ventana
    </h3>
    <br>
    <!-- Mostrar el video de YouTube -->
    <div class="youtube-video">
        <iframe width="350" height="200" src="https://www.youtube.com/embed/j99intoPKGE" frameborder="0"
            allowfullscreen></iframe>
    </div>

    <br>
    <a href="{{ route('tracking') }}" class="btn btn-primary">Comenzar</a>
    

    <!-- Mostrar la salida del código Python en la página -->
    <div id="output">
        {{ $output ?? '' }}
    </div>

@endsection
