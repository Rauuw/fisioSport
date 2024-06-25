@extends('layouts.plantillalogin')

@section('bodystyle')
login-page
@endsection

@section('content')
<div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div>
                <div class="card d-flex mx-auto my-5">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12 c1 p-5">
                            <div class="row mb-5 m-3"></div>
                            <img src="https://www.trakphysio.com/wp-content/uploads/sites/612/2023/03/trak-silver.png" width="250vw" height="280vh" class="mx-auto d-flex" alt="Teacher">
                            <div class="row justify-content-center">
                                <div class="w-75 mx-md-5 mx-1 mx-sm-2 mb-5 mt-4 px-sm-5 px-md-2 px-xl-1 px-2">
                                    <h1 class="wlcm">Bienvenido a FisioSport</h1>
                                    <span class="sp1">
                                        <span class="px-3 bg-danger rounded-pill"></span>
                                        <span class="ml-2 px-1 rounded-circle"></span>
                                        <span class="ml-2 px-1 rounded-circle"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 c2 px-5 pt-5">
                            <form id="registerForm" method="POST" action="{{ route('register') }}" autocomplete="off">
                                @csrf
                                <div class="d-flex">
                                    <h3 class="font-weight-bold">Registrar</h3>
                                </div>
                                <div class="row input-group">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="{{ __('Name') }}" required autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="row input-group">
                                    <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" placeholder="{{ __('lastname') }}" required autofocus>
                                    @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="row input-group mb-3">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('Email Address') }}" required autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="row input-group mb-3">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}" required autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="row input-group mb-3">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password">
                                </div>
                                <div class="row input-group">
                                    <select id="especialidad" aria-label="Default select example" class="form-control @error('especialidad') is-invalid @enderror" name="especialidad" required autofocus>
                                        <option value="">SELECCIONE</option>
                                        <option value="ejercicios">Masaje terapéutico</option>
                                        <option value="lesiones">Lesiones musculoesqueléticas</option>
                                    </select>
                                    @error('tipo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="social-auth-links text-center mt-2 mb-3">
                                    <button type="button" class="text-white text-weight-bold bt" id="registerButton"><strong>{{ __('Register') }}</strong></button>
                                </div>
                            </form>
                            <div class="text-center mt-2 mb-3">
                                <h5 class="ac">
                                    <a href="{{ route('login') }}">Ya tengo Usuario Registrado</a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Términos y Condiciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3>Términos y Condiciones</h3>
                <p>Estos términos y condiciones rigen el uso del software de seguimiento de movimientos de fisioterapia en recuperación deportiva, proporcionado por FisioSport. Al acceder y utilizar este software, usted acepta estar sujeto a los siguientes términos y condiciones:</p>
                <h4>1. Uso del Software</h4>
                <p>El software de seguimiento está destinado exclusivamente a profesionales de la fisioterapia y pacientes en proceso de recuperación deportiva. El uso indebido del software está estrictamente prohibido.</p>
                <h4>2. Recopilación y Uso de Datos</h4>
                <p>El software recopila datos sobre los movimientos y el progreso de los pacientes para proporcionar un seguimiento detallado y personalizado. Los datos recopilados serán utilizados únicamente para mejorar la recuperación del paciente y no serán compartidos con terceros sin el consentimiento del paciente.</p>
                <h4>3. Responsabilidad del Usuario</h4>
                <p>El usuario es responsable de la precisión de la información ingresada en el software. FisioSport no se hace responsable por cualquier daño o lesión que resulte del uso incorrecto o inexacto del software.</p>
                <h4>4. Propiedad Intelectual</h4>
                <p>Todos los derechos de propiedad intelectual del software y su contenido pertenecen a FisioSport. El usuario no tiene derecho a copiar, modificar, distribuir, vender o alquilar ninguna parte del software.</p>
                <h4>5. Modificaciones a los Términos y Condiciones</h4>
                <p>FisioSport se reserva el derecho de modificar estos términos y condiciones en cualquier momento. Las modificaciones serán efectivas inmediatamente después de su publicación en el software. El uso continuado del software después de la publicación de cualquier modificación constituye su aceptación de los nuevos términos y condiciones.</p>
                <h4>6. Contacto</h4>
                <p>Para cualquier pregunta o inquietud sobre estos términos y condiciones, por favor contacte a FisioSport a través de [correo electrónico de contacto] o [número de teléfono de contacto].</p>
                <p>Al hacer clic en "Aceptar", usted confirma que ha leído, comprendido y acepta estos términos y condiciones.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="acceptTerms">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap CSS -->
{{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.mkkin.css" rel="stylesheet"> --}}

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    // Obtén los elementos del DOM
    const registerButton = document.getElementById('registerButton');
    const termsModal = new bootstrap.Modal(document.getElementById('termsModal'), {
        keyboard: false
    });
    const acceptTermsButton = document.getElementById('acceptTerms');
    const registerForm = document.getElementById('registerForm');

    // Abre el modal cuando se haga clic en el botón de registro
    registerButton.addEventListener('click', () => {
        termsModal.show();
    });

    // Cierra el modal y envía el formulario cuando se acepten los términos
    acceptTermsButton.addEventListener('click', () => {
        termsModal.hide();
        registerForm.submit();
    });
});
</script>
@endsection
