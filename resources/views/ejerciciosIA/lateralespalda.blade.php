@extends('layouts.plantillabase')

@section('title', 'Home')
@section('h-title', 'Tracking')
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
    <!-- <div class="youtube-video">
        <iframe width="350" height="200" src="https://www.youtube.com/embed/j99intoPKGE" frameborder="0"
            allowfullscreen></iframe>
    </div> -->
    <div class="row">
        <div class="col-sm-12">
            <video width="350" height="200" controls>
                <source src="{{ asset('storage/'.$ejercicio->url_video_demostrativo) }}" type="video/mp4">
                Your browser does not support the video tag.
          </video>
        </div>
    </div>

    <button onclick="startVideo()" class="btn btn-success">Empezar</button>
    <img id="video" src="" width="640" height="480" style="display: none;">

    <!-- Agregar el cronómetro -->
    <div id="countdown" style="font-size: 2rem; margin-top: 20px;"></div>

    <div>¿Finalizó las repeticiones con éxito?</div>
    <form id="saveCorrectoForm" action="{{ route('saveCorrecto') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="segundos" id="segundosInput">
    </form>

    <button onclick="saveCorrecto()" class="btn btn-success">Sí</button>

    <!-- Mostrar formulario para enviar los datos cuando no se completaron correctamente -->
    <button onclick="showForm()" class="btn btn-danger">No</button>
    <div id="form-container" style="display: none;" class="form-container card mb-3">
        <h3 class="card-header">Retroalimentación</h3>

        <form id="saveFailForm" action="{{ route('saveIncorrecto') }}" method="POST" class="form-row">
            @csrf
            <div class="form-group col-md-6">
                <label for="repeticiones" class="form-label">¿Cuántas repeticiones realizaste?</label>
                <input type="number" class="form-control" id="repeticiones" name="repeticiones" required>
            </div>
            <div class="form-group col-md-6">
                <label for="motivo" class="form-label">Motivo:</label>
                <textarea class="form-control" id="motivo" name="motivo" required></textarea>
            </div>
            <input type="hidden" name="segundos" id="segunInput">
            <br>
            <button type="submit" class="btn btn-success">Enviar</button>
        </form>
    </div>

    <script>
        var timer;
        var seconds = 0;
        var countdownElement = document.getElementById('countdown');

        function startVideo() {
            var videoFeed = document.getElementById('video');
            videoFeed.style.display = 'block';
            videoFeed.src = 'https://5b85-189-28-75-192.ngrok-free.app/lateral_espalda';

            // Iniciar el cronómetro después de 15 segundos
            countdownElement.innerText = "Empezando...";
            setTimeout(startTimer, 15000);
        }

        function startTimer() {
            seconds = 0; // Reiniciar los segundos
            countdownElement.innerText = seconds + " segundos";
            timer = setInterval(updateTimer, 1000);
        }

        function updateTimer() {
            seconds++;
            countdownElement.innerText = seconds + " segundos";
        }

        function saveCorrecto() {
            document.getElementById('segundosInput').value = seconds;
            document.getElementById('saveCorrectoForm').submit();
        }

        function saveFail() {
            // document.getElementById('segunInput').value = seconds;
            // document.getElementById('saveFailForm').submit();
        }

        function showForm() {
            document.getElementById('form-container').style.display = 'block';
            document.getElementById('segunInput').value = seconds;
        }
    </script>

@endsection
