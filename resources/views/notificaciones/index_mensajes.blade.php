@extends('layouts.plantillabase')

@section('title', 'Home')
@section('h-title', 'Mensajes')
@section('card-title', '')

@section('content')

    @if (isset($id))
        @php
            $notificaciones = \App\Models\Notificaciones::where('paciente_id', $id)->get();
        @endphp
        @if ($notificaciones->count() == 0)
            <div>No hay mensajes</div>
        @else
            @foreach ($notificaciones as $i => $notificacion)
                <div>Mensaje {{ $i + 1 }}: {{ $notificacion->mensaje }}</div>
            @endforeach
        @endif
    @endif

@endsection
