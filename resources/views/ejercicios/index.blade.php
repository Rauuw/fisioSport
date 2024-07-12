@extends('layouts.plantillabase')

@section('title','Lista Ejercicios')
@section('h-title')
    Lista Ejercicios
@endsection
@section('card-title','')

@section('content')
<div class="container">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <!-- Botón fijo en la parte superior -->
         <div class="col">
            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal" style="width: 80%; height: 50%; font-size: 100px; padding: 10px 20px;">+</button>
         </div>
        

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Subir Video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('ejercicio.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="duracion" class="form-label">Duración</label>
                                <input type="text" class="form-control" id="duracion" name="duracion" required>
                            </div>
                            <div class="mb-3">
                                <label for="repeticiones" class="form-label">Repeticiones</label>
                                <input class="form-control" id="repeticiones" name="repeticiones" required></input>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="video_demostrativo" class="form-label">Video Demostrativo</label>
                                <input type="file" class="form-control" id="video_demostrativo" name="video_demostrativo" accept="video/*" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Subir</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Ejercicios -->
        @foreach($ejercicios as $ejercicio)
        <div class="col">
            <div class="card">
                <video controls>
                    <source src="{{ asset('storage/'.$ejercicio->url_video_demostrativo) }}" type="video/mp4">
                </video>
                <div class="card-body">
                    <div class="card-body">
                        <div class="col sm-2">
                        <h5 class="card-title">{{ $ejercicio->nombre }}</h5>
                        </div>
                        <p class="card-text">Duración: {{ $ejercicio->duracion }}</p>
                        <p class="card-text">Descripción: {{ $ejercicio->descripcion }}</p>
                    </div>
                    <div class="col sm-2">
                        <form action="{{ route('ejercicio.destroy', $ejercicio->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                            </svg></button>
                        </form>
                        </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
    @endsection