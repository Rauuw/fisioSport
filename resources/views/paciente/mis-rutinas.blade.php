@extends('layouts.plantillabase')

@section('title', 'Paciente')
@section('h-title')
Mis Rutinas
@endsection
@section('card-title', '')

@section('content')
<div class="container-bottom-3">
        <div class="row">
   
            <div class="col">
            @if($rutinaId)
                    <strong>Numero de Sesiones</strong>
                    <label>{{ $rutinaId->sesion }}</label>
            </div>
        </div>

        <br>
            <div class="row">
                <div class="col"></div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nombre Ejercicio</th>
                            <th scope="col">Repeticiones</th>
                            <th scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    @if ($rutinasPaciente->isNotEmpty())
                    @foreach($rutinasPaciente as $rutinasPaciente)
                        <tr>
                            <td>{{$rutinasPaciente->nombre}}</td>
                           
                            <td>{{$rutinasPaciente->repeticiones}}</td>
                            <td>
                                <div class="row">
                                
                                <div class="col-sm-3">
                                <button type="button" class="section4_btn btn33"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                        </svg></button>
                                    </div>
                                    <div class="col-sm-2">
                                    <button type="button" class="section4_btn btn22">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                                        </svg>
                                    </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
               
            </div>
        @endIf
</div>

@endsection
