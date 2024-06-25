@extends('layouts.plantillabase')

@section('title', 'Paciente')
@section('h-title', ' Pacientes')
@section('card-title', '')

@section('content')
    <div class="container-bottom-3">
        <div class="col-lg-2 col-md-2 col-xs-12 col-sm-6">
            <button class="section2_btn btn2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">+ Crear
                Paciente </button>
        </div>


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content p-4" style="align-items: center;border-radius: 30px;">
                    <div class="modal-header border-0 mb-2">
                        <div class="modal-title" id="exampleModalLabel">Crear Paciente</div>
                    </div>
                    <div class="modal-body">
                        <div class="c2">
                            <form id="crearPacienteForm" action="{{ route('crear_paciente') }}" method="POST">
                                @csrf
                                <div class="row input-group mb-3">
                                    <div class="col">
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" placeholder="{{ __('Name') }}" required
                                            autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <input id="lastname" type="text"
                                            class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                            value="{{ old('lastname') }}" placeholder="{{ __('lastname') }}" required
                                            autofocus>

                                        @error('lastname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="row input-group mb-3">
                                    <div class="col">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" placeholder="{{ __('Email Address') }}" required
                                            autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row input-group mb-3">
                                    <div class="col">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            placeholder="{{ __('Password') }}" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="row input-group mb-3">
                                    <div class="col">
                                        <select id="genero" aria-label="Default select example"
                                            class="form-control @error('especialidad') is-invalid @enderror" name="genero"
                                            required autofocus>
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
                                    <div class="col">
                                        <input id="fecha_nacimiento" type="date"
                                            class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                                            name="fecha_nacimiento" placeholder="{{ __('fecha_nacimiento') }}" required
                                            autocomplete="fecha_nacimiento">

                                        @error('fecha_nacimiento')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row input-group mb-3">
                                    <div class="col">
                                        <input id="telefono" type="text"
                                            class="form-control @error('telefono') is-invalid @enderror" name="telefono"
                                            value="{{ old('telefono') }}" placeholder="{{ __('telefono') }}" required
                                            autofocus>

                                        @error('telefono')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row input-group mb-3">
                                    <div class="col sm-2">
                                        <!-- Checkbox -->
                                        <input class="form-check-input" type="checkbox" id="hasHistorial"
                                            name="hasHistorial" value="true">
                                        <label class="form-check-label" for="hasHistorial">Historial</label>
                                    </div>
                                    <!-- Input oculto -->
                                    <input type="hidden" name="hasHistorial" id="hiddenHasHistorial" value="false">
                                </div>
                                <br>
                                <button type="submit" class="section2_btn btn2 right">Guardar Paciente</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="table-wrap">
            <table class="table table-borderless table-responsive">
                <thead>
                    <tr>
                        <th class="text-muted fw-600">Email</th>
                        <th class="text-muted fw-600">Paciente</th>
                        <th class="text-muted fw-600">Sesiones</th>
                        <th class="text-muted fw-600">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pacientes as $paciente)
                        <tr class="align-middle alert" role="alert">

                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="img-container">
                                        <img src="https://images.pexels.com/photos/2379005/pexels-photo-2379005.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                                            alt="" width="25vw" height="28vh">
                                    </div>
                                    <div class="ps-3">
                                        <div class="fw-600 pb-1">{{ $paciente->user->email }}</div>
                                        <p class="m-0 text-grey fs-09">Added: {{ $paciente->created_at->format('d/m/Y') }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="fw-600">{{ $paciente->user->name }} {{ $paciente->user->lastname }}</div>
                            </td>
                            <!--  <td>
                            <div class="d-inline-flex align-items-center active">
                                <div class="circle"></div>
                                <div class="ps-2">Active</div>
                            </div>
                                                   <div class="d-inline-flex align-items-center waiting">
                                <div class="circle"></div>
                                <div class="ps-2">Waiting for Reassignment</div>
                            </div>
                        </td>-->
                            <td>
                                3
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <a href="{{ route('listar_rutina', ['id' => $paciente->user->id]) }}"
                                            class="section3_btn btn4 btn-sm" style="font-size: .8rem; color: white;">
                                            + Rutina
                                        </a>
                                    </div>

                                    <div class="col">
                                        <a href="{{ route('formHistorial', ['id' => $paciente->user->id]) }}"
                                            class="section3_btn btn4 btn-sm" style="font-size: .8rem; color: white;">
                                            + Historial
                                        </a>
                                    </div>

                                    <div class="col">
                                        <a href="{{ route('ver_historial', ['id' => $paciente->user->id]) }}"
                                            class="section3_btn btn4 btn-sm" style="font-size: .8rem; color: white;">
                                            Ver Historial
                                        </a>
                                    </div>

                                    <div class="col">
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                            <button type="button" class="section4_btn btn33"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                                </svg></button>
                                            <button type="button" class="section4_btn btn22"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                                    <path
                                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                                </svg></button>
                                            <button type="button" class="section4_btn btn11"> <svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                                </svg></button>
                                        </div>
                                    </div>
                                </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            // Selecciona el formulario del modal
            const form = document.getElementById('crearPacienteForm');

            // Escucha el evento submit del formulario
            form.addEventListener('submit', function() {
                // Borra el contenido del formulario después de que se haya enviado
                setTimeout(() => {
                    form.reset();
                    $('#exampleModal').modal('hide');
                }, 1000);
            });
        });
    </script>


@endsection
