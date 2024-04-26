@extends('layouts.plantillabase')

@section('title','Home')
@section('h-title','Notificaciones')
@section('card-title','')

@section('content')

    <form action="{{route('guardar_notificacion')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="paciente_id">Paciente</label>
            <select name="paciente_id" id="paciente_id" class="form-control" style="width:25%">
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
            <label for="fisioterapeuta_id">Fisioterapeuta</label>
            <input type="number" name="fisioterapeuta_id" id="fisioterapeuta_id" class="form-control" style="width: 25%">
        </div>
        <div class="form-group">
            <label for="mensaje">Mensaje</label>
            <textarea name="mensaje" id="mensaje" class="form-control"></textarea><br>
        </div>
        <button type="submit" class="btn btn-primary">Notificar</button>
    </form>

@endsection
