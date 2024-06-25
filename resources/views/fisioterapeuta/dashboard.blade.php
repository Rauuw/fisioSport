@extends('layouts.plantillabase')

@section('title', 'Paciente')
@section('h-title', ' Dashboard')
@section('card-title', '')

@section('content')
    <div>
        <h2>Reporte 1</h2>
        <img src="data:image/png;base64,{{ $kpi1Image }}" alt="KPI 1">
    </div>

    <div>
        <h2>Reporte 2</h2>
        <img src="data:image/png;base64,{{ $kpi2Image }}" alt="KPI 2">
    </div>
@endsection
