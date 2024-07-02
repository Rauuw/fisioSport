@extends('layouts.plantillabase')

@section('title', 'Paciente')
@section('h-title', ' Dashboard')
@section('card-title', '')

@section('content')
   <div>
    <div class="row">
    <div class="col-sm-6">
    <h2>Reporte 1</h2>
        <img src="data:image/png;base64,{{ $kpi1Image }}" alt="KPI 1" class="img-fluid" style="max-width: 100%;">
    </div>
    <div class="col-sm-6">
        <h2>Reporte 2</h2>
        <img src="data:image/png;base64,{{ $kpi2Image }}" alt="KPI 2" class="img-fluid" style="max-width: 100%;">
    </div>
    <div>
 </div>

@endsection
