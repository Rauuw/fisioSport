@extends('layouts.plantillabase')

@section('title', 'Paciente')
@section('h-title', 'Pacientes')
@section('card-title', '')

@section('content')
<div class="container-bottom-3">

    @if ($pacientes->isNotEmpty() ) 
    <div class="row">
        <div class="col sm-8">
            <h1>{{ $pacientes[0]->name }} {{ $pacientes[0]->lastname }}</h1>
        </div>
        <div class="col sm-4">
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalRutinas">
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
                    <div class="mb-3">
                        <label for="rutina" class="form-label">Seleccionar Rutina</label>
                        <select class="form-select" id="rutina">
                            <option value="">Seleccione una rutina</option>
                            @foreach($rutinas as $rutina)
                                <option value="{{ route('seleccionar_rutina', ['rutina_id' => $rutina->id, 'paciente_id' => $pacientes[0]->id]) }}">{{ $rutina->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
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
                        <button type="submit" class="btn btn-primary">Crear Nueva Rutina</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @isset($rutinaid)
    <div class="row">
        <div class="col">
            <strong>Numero de Sesiones</strong>
            <label>{{ $rutinaid->sesion }}</label>
        </div>
    </div>
    <br>
    
    <div class="row">
    <div class="col">
        
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nombre Ejercicio</th>
                <th scope="col">Acción</th>
                <th scope="col">Fecha</th>
            </tr>
        </thead>
        
        <tbody class="table-group-divider">
       
    <tr>
        <td>Movimiendo de hombro</td>
        <td>
            <iframe width="120" height="80" src="" frameborder="0" allowfullscreen></iframe>
        </td>
        <td>15/06/2024</td>
    </tr>
   
    <tr>
        <td>Extension de espalda</td>
        <td>
            <iframe width="120" height="80" src="../../../public/storage/videos/" frameborder="0" allowfullscreen></iframe>
        </td>
        <td>16/06/2024</td>
    </tr>
   
    <tr>
        <td>Remo con Peso</td>
        <td>
            <iframe width="120" height="80" src="" frameborder="0" allowfullscreen></iframe>
        </td>
        <td>18/06/2024</td>
    </tr>
        </tbody>
    </table>
    <div class="col">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearRutinaModal">Añadir Ejercicio</button>
    </div>
</div>
    @endisset
    @endif
</div>

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
                    <form id="rutinaEjercicioForm" action="{{ route('rutina.addExercise') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="rutina_id" class="form-label">Seleccionar Rutina</label>
                            <select class="form-select" id="rutina_id" name="rutina_id" required>
                                <option value="">Seleccione una rutina</option>
                                @foreach($rutinas as $rutina)
                                    <option value="{{ $rutina->id }}">{{ $rutina->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="ejercicio_id" class="form-label">Seleccionar Ejercicio</label>
                            <select class="form-select" id="ejercicio_id" name="ejercicio_id" required>
                                <option value="">Seleccione un ejercicio</option>
                                @foreach($ejercicios as $ejercicio)
                                    <option value="{{ $ejercicio->id }}">{{ $ejercicio->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Número de Sesiones</label>
                            <select class="form-select" name="sesion">
                                @for ($i = 1; $i <= $rutinaid->sesion; $i++)
                                    <option value="{{ $i }}">Día {{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <!-- Agrega el campo para el paciente -->
                        <input type="hidden" name="paciente_id" value="{{ $pacientes[0]->id }}">
                        <button type="submit" class="btn btn-primary">Añadir Ejercicio</button>
                    </form>
                @endif
            </div>
            @endisset
        </div>
    </div>
</div>

<script>
    document.getElementById('btnCrearRutina').addEventListener('click', function() {
        document.getElementById('crearRutinaForm').style.display = 'block';
        document.getElementById('modalBody').innerHTML = '';
    });
</script>
<script>
document.getElementById('rutina').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    if (selectedOption.value) {
        window.location.href = selectedOption.value;
    }
});
</script>
<script>
document.getElementById('addExercise').addEventListener('click', function() {
    const ejercicioId = document.getElementById('ejercicio').value;
    const ejercicioNombre = document.getElementById('ejercicio').options[document.getElementById('ejercicio').selectedIndex].text;
    const sesion = document.getElementById('sesion').value;
    
    if (ejercicioId && sesion) {
        // Crear una nueva fila
        const table = document.querySelector('table tbody');
        const newRow = document.createElement('tr');
        
        newRow.innerHTML = `
            <td>${ejercicioNombre}</td>
            <td>
                <iframe width="120" height="80" src="https://www.youtube.com/embed/ridGylKQ0WY" frameborder="0" allowfullscreen></iframe>
            </td>
            <td></td>
            <td></td>
            <td>
                <div class="col">
                    <button type="button" class="btn btn-success btn-sm">Enviar Retroalimentacion</button>
                </div>
            </td>
        `;

        table.appendChild(newRow);

        // Cerrar el modal
        document.getElementById('crearRutinaModal').querySelector('.btn-close').click();
    } else {
        alert('Por favor, selecciona un ejercicio y una sesión.');
    }
});
</script>

@endsection