@extends('layouts.plantillabase')

@section('title', 'Paciente')
@section('h-title', 'Gestionar Rutina')

@section('card-title', '')

@section('content')
<div class="container-bottom-3">

    <div class="row">
        <div class="col-sm-3 ">
            <button type="button" class="section4_btn btn4" style="color: white;" data-bs-toggle="modal" data-bs-target="#modalRutinas">
                Crear Rutina
            </button>
        </div>
        <div class="col sm-4">
            @if($rutinas->isEmpty())
                <p>No hay rutinas disponibles.</p>
            @else
                <select class="form-select" id="rutina-select">
                    <option value="">Seleccione una rutina</option>
                    @foreach($rutinas as $rutina)
                        <option value="{{ $rutina->id }}">{{ $rutina->nombre }}</option>
                    @endforeach
                </select>
            @endif
        </div>
    </div>

    <!-- Sección para agregar información adicional después de seleccionar una rutina -->
    <div class="row mt-3" id="additional-fields" style="display: none;">
        <div class="col">
            <form id="add-info-form">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre">
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                </div>
                <button type="button" class="btn btn-primary" id="add-to-table">Añadir a la tabla</button>
            </form>
        </div>
    </div>


    <!-- Modal para Crear Rutina -->
    <div class="modal fade" id="modalRutinas" tabindex="-1" aria-labelledby="modalRutinasLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalRutinasLabel">Crear Rutina</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('rutina_create') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre de la Nueva Rutina:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción:</label>
                            <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Crear Nueva Rutina</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Mensajes de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Sección para mostrar la rutina seleccionada -->
    @isset($rutinaid)
    <br>
        <div class="row">
            <div class="col">
                <strong>Nombre rutina:</strong>
                <label>{{ $rutinaid->nombre }}</label>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nombre Ejercicio</th>
                            <th scope="col">Acción</th>
                            <th scope="col">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ejercicios_rutina as $ejercicio_rutina)
                        <tr>
                            <td>{{ $ejercicio_rutina->nombre }}</td>
                            <td>
                            <video width="120" height="70" controls>
                            <source src="{{ asset('storage/'.$ejercicio_rutina->url_video_demostrativo) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                            </td>
                            <td>{{ $ejercicio_rutina->fecha }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="col">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearRutinaModal">Añadir Ejercicio</button>
                </div>
            </div>
        </div>
    @endisset

</div>

<!-- Modal para Añadir Ejercicio -->
<div class="modal fade" id="crearRutinaModal" tabindex="-1" aria-labelledby="crearRutinaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRutinasLabel">Añadir Ejercicio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @isset($rutinaid)
            <div class="modal-body">
                @if($rutinas->isEmpty())
                    <p>No hay rutinas disponibles.</p>
                @else
                <form id="rutinaEjercicioForm" action="{{ route('asign_ejercicio') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="ejercicio_id" class="form-label">Seleccionar Ejercicio</label>
                    <select class="form-select" id="ejercicio_id" name="ejercicio_id" required>
                        <option value="">Seleccione un ejercicio</option>
                        @foreach($ejercicios as $ejercicio)
                            <option value="{{ $ejercicio->id }}">{{ $ejercicio->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            
                <!-- Campo oculto para enviar rutina_id -->
                <input type="hidden" name="rutina_id" value="{{ $rutina->id }}">

                <button type="submit" class="btn btn-primary">Añadir Ejercicio</button>
            </form>

                @endif
            </div>
            @endisset
        </div>
    </div>
</div>

<script>
document.getElementById('rutina-select').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    if (selectedOption.value) {
        window.location.href = '/select-rutina/' + selectedOption.value;
    }
});
</script>
<script>
document.getElementById('add-to-table').addEventListener('click', function() {
    var rutinaId = document.getElementById('rutina-select').value;
    var nombre = document.getElementById('nombre').value;
    var descripcion = document.getElementById('descripcion').value;

    if (rutinaId && nombre && descripcion) {
        var table = document.getElementById('rutina-table').getElementsByTagName('tbody')[0];
        var newRow = table.insertRow();
        var cellId = newRow.insertCell(0);
        var cellNombre = newRow.insertCell(1);
        var cellDescripcion = newRow.insertCell(2);

        cellId.textContent = rutinaId;
        cellNombre.textContent = nombre;
        cellDescripcion.textContent = descripcion;

        // Limpiar los campos del formulario
        document.getElementById('rutina-select').selectedIndex = 0;
        document.getElementById('nombre').value = '';
        document.getElementById('descripcion').value = '';

        // Ocultar los campos adicionales
        document.getElementById('additional-fields').style.display = 'none';
    } else {
        alert('Por favor, complete todos los campos.');
    }
});
</script>

@endsection
