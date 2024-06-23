@hasanyrole('fisioterapeuta')
@extends('layouts.plantillabase')

@section('title','Home')
@section('h-title','Bievenido')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    {{ __('You are logged in,') }}
    {{ auth()->user()->name }}!
@endsection
@endhasanyrole
@hasanyrole('paciente')

@endhasanyrole