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

    <button onclick="startVideo()" class="btn btn-primary">Empezar</button>
    <img id="video" src="" width="640" height="480" style="display: none;">

    <div>¿Finalizó las repeticiones con exito?</div>
    <button onclick="" class="btn btn-primary">Sí</button>
    <button onclick="showForm()" class="btn btn-primary">No</button>
    <div id="form-container" style="display: none;">
        <h3>Retroalimentación</h3>
        <form action="/ejerciciosIA/martillo/fail" method="POST">
            @csrf
            <div class="form-group col-md-6">
                <label for="repeticiones">Cuantas repeticiones realizaste:</label>
                <input type="number" class="form-control" id="repeticiones" name="repeticiones" required>
            </div>
            <div class="form-group col-md-6">
                <label for="motivo">Motivo:</label>
                <textarea class="form-control" id="motivo" name="motivo" required></textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
    
    <script>
        function showForm() {
            var formContainer = document.getElementById('form-container');
            formContainer.style.display = 'block';
        }
    </script>
    <script>
        function startVideo() {
            var videoFeed = document.getElementById('video');
            videoFeed.style.display = 'block';
            videoFeed.src = 'http://localhost:5000/calentamiento';
        }
    </script>


    <!-- Mostrar la salida del código Python en la página -->
    {{-- <div id="output">
        {{ $output ?? '' }}
    </div> --}}

@endsection
