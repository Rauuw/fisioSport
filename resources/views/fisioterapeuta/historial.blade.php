@extends('layouts.plantillabase')

@section('title', 'Historial')
@section('h-title', ' Historial')
@section('card-title', '')

@section('content')

    <div class="card mb-4 border-left-primary">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Agregar historial</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('saveHistorial') }}" method="POST" class="form-row">
                @csrf
                <div class="form-group col-md-6">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-control form-control-sm w-50" value="{{ now()->format('Y-m-d') }}">
                </div>
                <input type="hidden" name="paciente_id" id="paciente_id" value="{{ $id }}">
                <div class="form-group col-md-6">
                    <label for="historial">Historial</label>
                    <textarea name="historial" id="historial" class="form-control form-control-sm"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-sm mt-3">Guardar</button>
            </form>
        </div>
    </div>

@endsection
