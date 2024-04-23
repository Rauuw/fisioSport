@extends('layouts.plantillabase')

@section('title','Home')
@section('h-title','Notificaciones')
@section('card-title','')

@section('content')

    <form action="" method="POST">
        @csrf
        <div class="form-group">
            <label for="cliente">Cliente</label>
            <select name="cliente" id="cliente" class="form-control" style="width:25%">
                {{-- @foreach ($clientes as $cliente)
                    <option value="{{$cliente->id}}">{{$cliente->nombre}} {{$cliente->apellidos}}</option>
                @endforeach --}}
            </select>
        </div>
        <div class="form-group">
            <label for="mensaje">Mensaje</label>
            <textarea name="mensaje" id="mensaje" class="form-control"></textarea><br>
        </div>
        <button type="submit" class="btn btn-primary">Notificar</button>
    </form>

@endsection
