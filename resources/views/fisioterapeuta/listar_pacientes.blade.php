@extends('layouts.plantillabase')

@section('title','Paciente')
@section('h-title',' Pacientes')
@section('card-title','')

@section('content')
<div class="container-bottom-3">
    <!-- Button que abre el modal -->
    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Crea Paciente
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Paciente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mx-3">
                    <form action="{{ route('crear_paciente') }}" method="POST">
                        @csrf
                        <div class="row input-group mb-3">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="{{ __('Name') }}" required autofocus>


                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="row input-group mb-3">
                            <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" placeholder="{{ __('lastname') }}" required autofocus>


                            @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="row input-group mb-3">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('Email Address') }}" required autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="row input-group mb-3">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}" required autocomplete="new-password">


                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="row input-group mb-3">
                            <select id="genero" aria-label="Default select example" class="form-control @error('especialidad') is-invalid @enderror" name="genero" required autofocus>
                                <option value="">SELECCIONE</option>
                                <option value="F">F</option>
                                <option value="M">M</option>
                            </select>

                            @error('tipo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="row input-group mb-3">
                            <input id="fecha_nacimiento" type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" name="fecha_nacimiento" placeholder="{{ __('fecha_nacimiento') }}" required autocomplete="fecha_nacimiento">


                            @error('fecha_nacimiento')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="row input-group mb-3">
                            <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" placeholder="{{ __('telefono') }}" required autofocus>


                            @error('telefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="row input-group mb-3">
                            <div class="col sm-2">
                                <!-- Checkbox -->
                                <input class="form-check-input" type="checkbox" id="hasHistorial" name="hasHistorial" value="true">
                                <label class="form-check-label" for="hasHistorial">Historial</label>
                            </div>
                            <!-- Input oculto -->
                            <input type="hidden" name="hasHistorial" id="hiddenHasHistorial" value="false">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Paciente</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="table-wrap">
        <table class="table table-borderless table-responsive">
            <thead>
                <tr>
                    <th></th>
                    <th class="text-muted fw-600">Paciente</th>
                    <th class="text-muted fw-600">Email</th>
                    <th class="text-muted fw-600">Estado</th>
                    <th class="text-muted fw-600">Sesiones</th>
                    <th class="text-muted fw-600">Accion</th>
                </tr>
            </thead>
            <tbody>
            @foreach($pacientes as $paciente)
                <tr class="align-middle alert" role="alert">
                    <td>
                        
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                        <div class="img-container">
                                <img src="https://images.pexels.com/photos/2379005/pexels-photo-2379005.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="">
                            </div>
                            <div class="ps-3">
                                <div class="fw-600 pb-1">{{ $paciente->user->email }}</div>
                                <p class="m-0 text-grey fs-09">Added: {{ $paciente->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </td>
            
                    <td>
                        <div class="fw-600">Markov98</div>
                    </td>
                    <td>
                        <div class="d-inline-flex align-items-center active">
                            <div class="circle"></div>
                            <div class="ps-2">Active</div>
                        </div>
                        <div class="d-inline-flex align-items-center waiting">
                            <div class="circle"></div>
                            <div class="ps-2">Waiting for Reassignment</div>
                        </div>
                    </td>
                    <td>
                        <div class="btn p-0" data-bs-dismiss="alert">
                            <span class="fas fa-times"></span>
                        </div>
                    </td>
                </tr>
                @endforeach    
              
            </tbody>
        </table>
    </div>
</div>
<script>
    document.getElementById('hasHistorial').addEventListener('change', function() {
       
        document.getElementById('hiddenHasHistorial').value = this.checked ? 'true' : 'false';
        console.log(this.checked);
    });
</script>
<script>
    function guardarPaciente() {
        // Aquí puedes realizar la lógica para guardar el paciente
        
        // Cierra el modal después de guardar los datos
        $('#exampleModal').modal('hide');
    }
</script>
@endsection
