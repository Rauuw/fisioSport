@extends('layouts.plantillabase')

@section('title', 'Home')
@section('h-title', 'Mensajes')
@section('card-title', '')

@section('content')

    {{-- @if (isset($id))
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
    @endif --}}

    <div class="chat-container" style="width: 600; background-color: #f5f5f5; border-radius: 10px; padding: 10px;">
        @foreach ($notificaciones as $notificacion)
            <div class="chat-item {{ $notificacion->tipo == 'F' ? 'chat-item-fisio' : 'chat-item-paciente' }}">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-weight: bold;">{{ $notificacion->tipo == 'F' ? 'Fisioterapeuta: ' : 'Paciente: ' }}</span>
                    <span style="font-size: 12px; color: #777;"></span>
                </div>
                <div style="background-color: #fff; padding: 5px; border-radius: 10px; margin-top: 5px;">
                    {{ $notificacion->mensaje }}
                </div>
            </div>
        @endforeach
    </div>

@endsection
