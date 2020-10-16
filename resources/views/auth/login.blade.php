@extends('auth.app')
@section('content')
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
        <!--begin::Aside-->
        <div class="login-aside order-2 order-lg-1 d-flex flex-column-fluid flex-lg-row-auto bgi-size-cover bgi-no-repeat p-7 p-lg-10">
            <!--begin: Aside Container-->
            <div class="d-flex flex-row-fluid flex-column justify-content-between">
                <!--begin::Aside body-->
                <div class="d-flex flex-column-fluid flex-column flex-center mt-5 mt-lg-0">
                    <a href="{{ route('index') }}" class="mb-15 text-center">
                        <img src="{{ asset('img/aprore.png') }}" class="max-h-75px" alt="" />
                    </a>
                    <!--begin::Signin-->
                    <div class="login-form login-signin">
                        <div class="text-center mb-10 mb-lg-20">
                            <h2 class="font-weight-bold">Iniciar Sesión</h2>
                            <p class="text-muted font-weight-bold">Ingrese su Correo y Contraseña</p>
                        </div>
                        <!--begin::Form-->
                        <form method="POST" action="{{ route('login') }}" autocomplete="off" class="form">
                            @csrf
                            <div class="form-group py-3 m-0">
                                <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="email" placeholder="Correo" name="email" value="{{ old('email') }}" />
                            </div>
                            <div class="form-group py-3 border-top m-0">
                                <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="password" placeholder="Contraseña" name="password" />
                            </div>
                            <div class="form-group d-flex flex-wrap justify-content-between align-items-center mt-3">
                                <div class="checkbox-inline">
                                    <label class="checkbox checkbox-outline m-0 text-muted">
                                    <input type="checkbox" name="remember" />
                                    <span></span>Recuerdame</label>
                                </div>
                                <a href="{{ route('password.request') }}" class="text-muted text-hover-primary">¿Olvido su contraseña?</a>
                            </div>
                            <div class="form-group d-flex flex-wrap justify-content-between align-items-center mt-2">
                                <div class="my-3 mr-2">
                                    <span class="text-muted mr-2">¿No tienes una cuenta?</span>
                                    <a href="https://aprore.com" id="kt_login_signup" class="font-weight-bold">Registrarme</a>
                                </div>
                                {{-- <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3">Iniciar</button> --}}
                                <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3">Iniciar Sesión</button>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Signin-->

                </div>
                <!--end::Aside body-->
                <!--begin: Aside footer for desktop-->
                <div class="d-flex flex-column-auto justify-content-between mt-15">
                    <div class="text-dark-50 font-weight-bold order-2 order-sm-1 my-2">© 2020 Aprore</div>
                    <div class="d-flex order-1 order-sm-2 my-2">
                        <a href="https://aprore.com" class="text-muted text-hover-primary">Privacidad</a>
                        <a href="https://aprore.com" class="text-muted text-hover-primary ml-4">Legal</a>
                        <a href="https://aprore.com" class="text-muted text-hover-primary ml-4">Contacto</a>
                    </div>
                </div>
                <!--end: Aside footer for desktop-->
            </div>
            <!--end: Aside Container-->
        </div>
        <!--begin::Aside-->
        <!--begin::Content-->
        <div class="order-1 order-lg-2 flex-column-auto flex-lg-row-fluid d-flex flex-column p-7" style="background-image: url({{ asset('img/bg-4.jpg') }});">
            <!--begin::Content body-->
            <div class="d-flex flex-column-fluid flex-lg-center">
                <div class="d-flex flex-column justify-content-center">
                    <h3 class="display-3 font-weight-bold my-7 text-white">¡Bienvenido a SISGP!</h3>
                    <p class="font-weight-bold font-size-lg text-white opacity-80">Sistema Integral de Seguimiento a la Gestion de Personal.</p>
                </div>
            </div>
            <!--end::Content body-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Login-->
</div>
<!--end::Main-->
@endsection

@section('head')
    <link href="{{ asset('css/login/login.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('script')

@endsection
