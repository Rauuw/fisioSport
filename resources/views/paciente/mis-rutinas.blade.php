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
                            <th scope="col">Estado</th>
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
                                @if($rutinasPaciente->accion)
                                    completo
                                @else
                                    incompleto
                                @endif
                            </td>
                            <td>
                                <div class="row">
                                
                                <div class="col-sm-3">
                                <a href="{{ route('paciente-ejer', ['id' => $rutinasPaciente->id]) }}" class="btn section4_btn btn33">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                    </svg>
                                </a>
                                    </div>
                                    <div class="col-sm-2">
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
