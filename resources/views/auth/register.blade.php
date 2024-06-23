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
                            <div class="row mb-5 m-3"> </div> <img src="https://www.trakphysio.com/wp-content/uploads/sites/612/2023/03/trak-silver.png" width="250vw" height="280vh" class="mx-auto d-flex" alt="Teacher">
                            <div class="row justify-content-center">
                                <div class="w-75 mx-md-5 mx-1 mx-sm-2 mb-5 mt-4 px-sm-5 px-md-2 px-xl-1 px-2">
                                    <h1 class="wlcm">Bienvenido a FisioSport</h1> <span class="sp1"> <span class="px-3 bg-danger rounded-pill"></span> <span class="ml-2 px-1 rounded-circle"></span> <span class="ml-2 px-1 rounded-circle"></span> </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 c2 px-5 pt-5">
                            <form method="POST" action="{{ route('register') }}" autocomplete="off">
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
                                    <button type="submit" class="text-white text-weight-bold bt"><strong>{{ __('Register') }}</strong></button>
                                </div>
                            </form>

                            <div class="text-center mt-2 mb-3">
                                <h5 class="ac">
                                    <a href="{{ route('login') }}">
                                        Ya tengo Usuario Registrado
                                    </a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- /.card -->
@endsection