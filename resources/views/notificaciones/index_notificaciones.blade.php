@extends('layouts.plantillabase')

@section('title','Home')
@section('h-title','Seleccionar paciente')
@section('card-title','')

@section('content')


    <table class="table table-striped">
        <thead>
            <tr>
                <th style="width: 25%;">Nombre</th>
                <th style="width: 75%;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pacientes as $paciente)
                <tr>
                    <td style="width: 25%;">{{ $paciente->name }}</td>
                    <td style="width: 75%;">
                        <a href="{{ route('ver_mensajes', $paciente->id) }}" class="btn btn-primary">Ver notificaciones</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


@endsection
