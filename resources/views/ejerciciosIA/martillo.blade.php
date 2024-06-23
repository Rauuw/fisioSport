@extends('layouts.plantillabase')

@section('title', 'Home')
@section('h-title', 'Sesión de ejercicios')
@section('card-title', '')

@section('content')
    <h3 class="display-10">Pasos a seguir antes de empezar:</h3>
    <div class="lead">
        <ul class="list-unstyled">
            <li><strong>1:</strong> Vea el vídeo de referencia para aprender el movimiento a realizar.</li>
            <li><strong>2:</strong> Memorice el movimiento.</li>
            <li><strong>3:</strong> Haga click en empezar para comenzar el ejercicio.</li>
            <li><strong>4:</strong> Cuando cumpla las repeticiones en la pantalla le saldrá "finalizado".</li>
            <li><strong>5:</strong> Para terminar haga click en "Sí" para guardar sus datos.</li>
            <li style="font-size: small;"><strong>Nota:</strong> Si no pudo terminar, haga click en "No", describa el motivo
                y las repeticiones ejecutadas correctamente.</li>
        </ul>
    </div>
    <br>
    <!-- Mostrar el video de YouTube -->
    <div class="youtube-video">
        <iframe width="350" height="200" src="https://www.youtube.com/embed/j99intoPKGE" frameborder="0"
            allowfullscreen></iframe>
    </div>

    <button onclick="startVideo()" class="btn btn-primary">Empezar</button>
    <div class="ml-2">
        <span id="timer" class="badge badge-primary"></span>
    </div>
    
    <img id="video" src="" width="640" height="480" style="display: none;">

    <div>¿Finalizó las repeticiones con exito?</div>
    <button onclick="" class="btn btn-primary">Sí</button>
    <button onclick="showForm()" class="btn btn-primary">No</button>
    <div id="form-container" style="display: none;" class="form-container card mb-3">
        <h3 class="card-header">Retroalimentación</h3>

        <form action="/ejerciciosIA/martillo/fail" method="POST" class="form-row">
            @csrf
            <div class="form-group col-md-6">
                <label for="repeticiones" class="form-label">Cuantas repeticiones realizaste:</label>
                <input type="number" class="form-control" id="repeticiones" name="repeticiones" required>
            </div>
            <div class="form-group col-md-6">
                <label for="motivo" class="form-label">Motivo:</label>
                <textarea class="form-control" id="motivo" name="motivo" required></textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Enviar</button>

        </form>

    </div>

    <script>
        var timer;
        var seconds = 10;
        function startVideo() {
            var videoFeed = document.getElementById('video');
            videoFeed.style.display = 'block';
            videoFeed.src = 'http://localhost:5000/calentamiento';
            timer = setInterval(function() {
                seconds--;
                if (seconds > 0) {
                    document.getElementById('timer').innerHTML = seconds + " segundos";
                } else {
                    clearInterval(timer);
                    document.getElementById('timer').innerHTML = "";
                }
            }, 1000);
        }
    </script>


    <!-- Mostrar la salida del código Python en la página -->
    {{-- <div id="output">
        {{ $output ?? '' }}
    </div> --}}

@endsection

