@extends('layouts.plantillabase')

@section('title', 'Paciente')
@section('h-title', 'Pacientes')
@section('card-title', '')

@section('content')
<div class="container-bottom-3">
    @if ($pacientes->isNotEmpty())
    <div class="row">
        <div class="col sm-8">
            <h1>{{ $pacientes[0]->name }} {{ $pacientes[0]->lastname }}</h1>
        </div>
        <div class="col sm-4 ">
            <button type="button left" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalRutinas">
                Seleccionar Rutina
            </button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalRutinas" tabindex="-1" aria-labelledby="modalRutinasLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalRutinasLabel">Seleccionar o Crear Rutina</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($rutinas->isEmpty())
                    <p>No hay rutinas disponibles.</p>
                    @else
                    <p>Selecciona una rutina:</p>
                    <ul>
                        @foreach($rutinas as $rutina)
                        <li><a href="{{ route('seleccionar_rutina', ['id' => $rutina->id]) }}">{{ $rutina->nombre }}</a></li>
                        @endforeach
                    </ul>
                    @endif
                    <!-- Formulario para crear una nueva rutina -->
                    <form action="{{ route('crear_rutina') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre de la Nueva Rutina:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción:</label>
                            <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="sesion" class="form-label">Sesiones:</label>
                            <textarea class="form-control" id="sesion" name="sesion"></textarea>
                        </div>
                        <form action="{{ route('listar_rutina', ['id' => $pacientes[0]->id]) }}" method="GET">
                            <!-- Aquí van los campos del formulario -->
                            <button type="submit" class="btn btn-primary">Crear Nueva Rutina</button>
                        </form>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <strong> Dia 1</strong>
        </div>
        <div class="col">
            <strong>Numero de Sesiones</strong>
            <label>15</label>
        </div>

    </div>
    <br>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nombre Rutina</th>
                    <th scope="col">Video</th>
                    <th scope="col">Repeticiones</th>
                    <th scope="col">estado</th>
                    <th scope="col">Retroalimentacion</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
           
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <iframe width="120" height="80" src="https://www.youtube.com/embed/ridGylKQ0WY" frameborder="0" allowfullscreen></iframe>
                    </td>
                    <td></td>
                    <td>
                        <div class="col">
                            <button type="button" class="btn btn-success btn-sm">Enviar Retroalimentacion</button>
                        </div>
                    </td>

                </tr>

            </tbody>
        </table>
        <div class="col">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearRutinaModal">+</button>
        </div>
    </div>
    @endif
</div>

<!-- Modal para Crear Rutina -->
<div class="modal fade" id="crearRutinaModal" tabindex="-1" aria-labelledby="crearRutinaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRutinasLabel">Seleccionar Rutina</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalBody">
                @if($rutinas->isEmpty())
                <p>No hay rutinas disponibles.</p>
                @else
                <p>Selecciona una rutina:</p>
                <ul>
                    @foreach($rutinas as $rutina)
                    <li><a href="{{ route('seleccionar_rutina', ['id' => $rutina->id]) }}">{{ $rutina->nombre }}</a></li>
                    @endforeach
                </ul>
                @endif
                <div id="crearRutinaForm" style="display: none;">
                    <h5>Crear Nueva Rutina</h5>
                    <form action="{{ route('crear_rutina') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción:</label>
                            <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                        </div>
                        <!-- Otros campos para la nueva rutina -->
                        <button type="submit" class="btn btn-primary">Guardar Rutina</button>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="btnCrearRutina">Crear Rutina</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('btnCrearRutina').addEventListener('click', function() {
        document.getElementById('crearRutinaForm').style.display = 'block';
        document.getElementById('modalBody').innerHTML = '';
    });
</script>

@endsection