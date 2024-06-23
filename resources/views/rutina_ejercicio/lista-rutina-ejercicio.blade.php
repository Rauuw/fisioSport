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

    <!-- Modal -->
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
    <br>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @isset($rutinaid)
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
                        <!-- Aquí debes mostrar los ejercicios relacionados con la rutina -->
                        @foreach($rutinaid->ejercicios as $ejercicio)
                            <tr>
                                <td>{{ $ejercicio->nombre }}</td>
                                <td>
                                    <iframe width="120" height="80" src="{{ $ejercicio->video_url }}" frameborder="0" allowfullscreen></iframe>
                                </td>
                                <td>{{ $ejercicio->fecha }}</td>
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
                                    <option value="{{ $rutina->id }}"> {{ $rutina->nombre }}</option>
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
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const rutinaSelect = document.getElementById('rutina_id');
            const rutinaDetalles = document.getElementById('rutina-detalles');
            const rutinaNombre = document.getElementById('rutina-nombre');
            const ejerciciosLista = document.getElementById('ejercicios-lista');

            if (rutinaSelect) {
                rutinaSelect.addEventListener('change', function() {
                    const rutinaId = this.value;
                    if (rutinaId) {
                        // Construir la URL de la API con el ID seleccionado
                        const apiUrl = `{{ url('/api/rutinas') }}/${rutinaId}`;

                        fetch(apiUrl)
                            .then(response => response.json())
                            .then(data => {
                                rutinaNombre.textContent = data.nombre;
                                ejerciciosLista.innerHTML = '';
                                data.ejercicios.forEach(ejercicio => {
                                    const row = document.createElement('tr');
                                    row.innerHTML = `
                                        <td>${ejercicio.nombre}</td>
                                        <td>
                                            <iframe width="120" height="80" src="${ejercicio.video_url}" frameborder="0" allowfullscreen></iframe>
                                        </td>
                                        <td>${ejercicio.fecha}</td>
                                    `;
                                    ejerciciosLista.appendChild(row);
                                });
                                rutinaDetalles.style.display = 'block';
                            })
                            .catch(error => {
                                console.error('Error fetching rutina:', error);
                            });
                    } else {
                        rutinaDetalles.style.display = 'none';
                    }
                });
            } else {
                console.error('El elemento rutina_id no se encontró en el DOM.');
            }
        });
    </script>


@endsection