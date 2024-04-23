@extends('layouts.plantillabase')

@section('title','Home')
@section('h-title','Notificaciones')
@section('card-title','')

@section('content')

    <form action="" method="POST">
        @csrf
        <div class="form-group">
            <label for="paciente">Paciente</label>
            <select name="paciente" id="paciente" class="form-control" style="width:25%">
                {{-- @foreach ($clientes as $cliente)
                    <option value="{{$cliente->id}}">{{$cliente->nombre}} {{$cliente->apellidos}}</option>
                @endforeach --}}
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_envio">Fecha de envio</label>
            <input type="date" name="fecha_envio" id="fecha_envio" class="form-control" style="width: 25%">
        </div>
        <div class="form-group">
            <label for="fisio_id">Fisioterapeuta</label>
            <input type="number" name="fisio_id" id="fisio_id" class="form-control" style="width: 25%">
        </div>
        <div class="form-group">
            <label for="mensaje">Mensaje</label>
            <textarea name="mensaje" id="mensaje" class="form-control"></textarea><br>
        </div>
        <button type="submit" class="btn btn-primary">Notificar</button>
    </form>

@endsection
