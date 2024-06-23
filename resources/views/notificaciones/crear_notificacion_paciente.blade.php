@extends('layouts.plantillabase')

@section('title', 'Home')
@section('h-title', ' Crear notificacion')
@section('card-title', '')

@section('content')

    <form action="{{ route('guardar_notificacion_paciente') }}" method="POST">
        @csrf
        <div class="form-group">
        </div>
        <div class="form-group">
            <label for="fecha_envio">Fecha de envio</label>
            <input type="date" name="fecha_envio" id="fecha_envio" class="form-control" style="width: 25%"
                value="<?php echo date('Y-m-d', time()); ?>">
        </div>
        <div class="form-group">
            <label for="fisioterapeuta_id">Fisioterapeuta</label>
            @inject('rutinaController', 'App\Http\Controllers\RutinaEjercicioController')
            <?php $fisioterapeuta_id = $rutinaController->getFisioByPacienteUser(auth()->user()->id) ?>
            <input type="number" name="fisioterapeuta_id" id="fisioterapeuta_id" class="form-control"
                value="{{ $fisioterapeuta_id }}" readonly>
        </div>
        <div class="form-group">
            <label for="mensaje">Mensaje</label>
            <textarea name="mensaje" id="mensaje" class="form-control"></textarea><br>
        </div>
        <button type="submit" class="btn btn-primary">Notificar</button>
    </form>

@endsection
