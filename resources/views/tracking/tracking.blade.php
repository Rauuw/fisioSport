@extends('layouts.plantillabase')

@section('title', 'Home')
@section('h-title', 'Tracking')
@section('card-title', '')

@section('content')

    <!-- Mostrar el video de YouTube -->
    <div class="youtube-video">
        <iframe width="350" height="200" src="https://www.youtube.com/embed/j99intoPKGE" frameborder="0"
            allowfullscreen></iframe>
    </div>

    <!-- Mostrar la salida del código Python en la página -->
    <div id="output">
        {{ $output ?? '' }}
    </div>

    {{-- <head>
        <link rel="stylesheet" href="https://pyscript.net/alpha/pyscript.css"/>
        <script defer src="https://pyscript.net/alpha/pyscript.js"></script>
        <py-env>
            - cv2
            - mediapipe
        </py-env>
    </head>

    <body>
        <div class="youtube-video">
            <iframe width="350" height="200" src="https://www.youtube.com/embed/j99intoPKGE" frameborder="0"
                allowfullscreen></iframe>
        </div>



    </body> --}}
@endsection
