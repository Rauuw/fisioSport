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
                        <form method="POST" action="{{ route('login') }}" autocomplete="off">
                         @csrf
                            <div class="d-flex"> 
                                <h3 class="font-weight-bold">Log in</h3>
                            </div> 
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('Email') }}" required autofocus>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}" required autocomplete="current-password">

                            <button type="submit" class="text-white text-weight-bold bt">{{ __('Login') }}</button>

                            <h5 class="ac" id="register">                            
                                <a href="{{ route('register') }}" class="text-center">Registrar</a>
                            </h5>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

    <!-- /.card -->
@endsection