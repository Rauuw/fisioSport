@extends('layouts.plantillabase')

@section('title','Paciente')
@section('h-title',' Pacientes')
@section('card-title','')

@section('content')
<div class="container-bottom-3">
    @if ($pacientes->isNotEmpty())
      <h1>{{ $pacientes[0]->name }} {{ $pacientes[0]->lastname }}</h1>
    <br>
    <div class="row">
    <div class="col">
        <strong> Dia 1</strong> 
        </div>
        <div class="col">
        <strong> Numero de Sesiones</strong> 
        <label>15</label>
        </div>
        <div class="col">
        <button type="button" class="btn btn-primary btn-sm">Enviar Retroalimentacion</button>
        </div>
    </div>
    <br>
    <div class="row">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">Nombre Rutina</th>
      <th scope="col">Video</th>
      <th scope="col">Repeticiones</th>
      <th scope="col">estado</th>
      <th scope="col">Retroalimentacion</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
    <tr>
      <td>Mark</td>
      <td>Otto</td>
      <td>
      <iframe width="120" height="80" src="https://www.youtube.com/embed/ridGylKQ0WY" frameborder="0" allowfullscreen></iframe>
      </td>
</td>
    </tr>
  </tbody>
</table>
        <div class="col">
        <button type="button" class="btn btn-primary">+</button>
        </div>
    </div>
    @endif
</div>
@endsection