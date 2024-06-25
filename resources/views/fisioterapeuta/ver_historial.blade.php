@extends('layouts.plantillabase')

@section('title', 'Historial')
@section('h-title', ' Historial')
@section('card-title', '')

@section('content')


    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($historial as $historial)
                <tr>
                    <td>{{ $historial->fecha_creacion }}</td>
                    <td>{{ $historial->historial }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


@endsection
