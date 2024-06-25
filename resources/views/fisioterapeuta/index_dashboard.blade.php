@extends('layouts.plantillabase')

@section('title', 'Paciente')
@section('h-title', ' Pacientes')
@section('card-title', '')

@section('content')

    <table class="table table-striped">
        <thead>
            <tr>
                <th style="width: 25%;">Nombre</th>
                <th style="width: 75%;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pacientes as $paciente)
                <tr>
                    <td style="width: 25%;">{{ $paciente->name }}</td>
                    <td style="width: 75%;">
                        <a href="{{ route('dashboard', ['id' => $paciente->id]) }}" class="btn btn-primary">Ver
                            reportes</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
