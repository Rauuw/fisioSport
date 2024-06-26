@extends('layouts.plantillabase')

@section('title', 'Home')
@section('h-title', ' Crear notificacion')
@section('card-title', '')

@section('content')

    <form action="{{ route('guardar_notificacion_fisio') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="paciente_id">Paciente</label>
            <select name="paciente_id" id="paciente_id" class="form-control" style="width:25%">
                @inject('rutinaController', 'App\Http\Controllers\RutinaEjercicioController')
                @foreach ($rutinaController->getAllPacientesByFisio(auth()->user()->id) as $paciente)
                    <option value="{{ $paciente->id }}">{{ $paciente->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_envio">Fecha de envio</label>
            <input type="date" name="fecha_envio" id="fecha_envio" class="form-control" style="width: 25%"
                value="<?php echo date('Y-m-d', time()); ?>">
        </div>
        <div class="form-group">
            <label for="fisioterapeuta_id">Fisioterapeuta</label>
            <input type="hidden" name="fisioterapeuta_id" id="fisioterapeuta_id" class="form-control"
                value="{{ auth()->user()->id }}">
            <input type="text" name="fisioterapeuta_id" id="fisioterapeuta_id" class="form-control" style="width: 25%"
                value="{{ auth()->user()->id }}" readonly>
        </div>
        <div class="form-group">
            <label for="mensaje">Mensaje</label>
            <textarea name="mensaje" id="mensaje" class="form-control"></textarea><br>
        </div>
        <button type="submit" class="btn btn-primary">Notificar</button>
    </form>

@endsection
