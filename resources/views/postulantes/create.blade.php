@extends('layouts.appNew')
@section('content')
    <x-subheader title="Postulante" 
        :subheaders="[ ['href'=>'empresa.index', 'nombre'=>'Registro'] ]"
        :acciones="[ ['href'=>'postulantemasivo.index', 'nombre'=>'Importar Masivamente'] ]">
    </x-subheader>

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <x-sesiones></x-sesiones>
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap ">
                    <!--begin::Wizard-->
				    <div class="wizard wizard-1">
                        <!--begin::Wizard Nav-->
                        <div class="wizard-nav border-bottom">
                            <div class="wizard-steps p-8 p-lg-10">
                                <!--begin::Wizard Step 1 Nav-->
                                <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                                    <div class="wizard-label">
                                        <i class="wizard-icon flaticon-user"></i>
                                        <h3 class="wizard-title">1. Datos Personales</h3>
                                    </div>
                                    <span class="svg-icon svg-icon-xl wizard-arrow">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
                                                <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </div>
                                <!--end::Wizard Step 1 Nav-->
                                <!--begin::Wizard Step 2 Nav-->
                                <div class="wizard-step" data-wizard-type="step" >
                                    <div class="wizard-label">
                                        <i class="wizard-icon flaticon-interface-3"></i>
                                        <h3 class="wizard-title">2. Inforacion del trabajador</h3>
                                    </div>
                                    <span class="svg-icon svg-icon-xl wizard-arrow">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
                                                <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </div>
                                <!--end::Wizard Step 2 Nav-->
                                <!--begin::Wizard Step 3 Nav-->
                                <div class="wizard-step" data-wizard-type="step">
                                    <div class="wizard-label">
                                        <i class="wizard-icon flaticon-doc"></i>
                                        <h3 class="wizard-title">3. Expediente</h3>
                                    </div>
                                </div>
                                <!--end::Wizard Step 3 Nav-->
                            </div>
                        </div> 
                        <!--end::Wizard Nav-->
                    </div>
                </div>
                <!--begin::Form-->
                <form method="POST" action="{{ route('postulante.store') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="empresa" value="{{$empresa->id}}">
                    <div class="card-body">
                        @if ( $errors->any() )
                            <x-errors></x-errors>
                        @endif
                        <div class="form-group">
                            <label for="nombre">Nombre: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" id="nombre" name="nombre" placeholder="Luis Antonio" />
                        </div>

                        <div class="form-group">
                            <label for="apellido_paterno">Apellido Paterno: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('apellido_paterno') is-invalid @enderror" value="{{ old('apellido_paterno') }}" id="apellido_paterno" name="apellido_paterno" placeholder="Morales" />
                        </div>

                        <div class="form-group">
                            <label for="apellido_materno">Apellido Materno: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('apellido_materno') is-invalid @enderror" value="{{ old('apellido_materno') }}" id="apellido_materno" name="apellido_materno" placeholder="Velazquez" />
                        </div>

                        <div class="form-group">
                            <label for="sexo">Sexo <span class="text-danger">*</span> </label>
                            <select class="form-control @error('sexo') is-invalid @enderror" id="sexo" name="sexo">
                                <option value="Masculino" {{ old('sexo') == 'Masculino' ? ' selected' : ''}}>Hombre</option>
                                <option value="Femenino" {{ old('sexo') == 'Femenino' ? ' selected' : ''}}>Mujer</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="telefono">Telefono: <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}" id="telefono" name="telefono" placeholder="9211479791" />
                        </div>

                        <div class="form-group">
                            <label for="kt_datepicker_1">Fecha de Nacimiento: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('fecha_nacimiento') is-invalid @enderror" value="{{ old('fecha_nacimiento') }}" id="kt_datepicker_1" name="fecha_nacimiento" readonly="readonly" placeholder="24/10/1999" />
                        </div>

                        <div class="form-group">
                            <label for="email">Correo Electronico: <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" name="email" placeholder="morales.lamv@gmail.com" />
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                        <button type="reset" class="btn btn-secondary">Cancelar</button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection

@section('head') 
    <link href="{{ asset('css/wizard.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('script')
<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script>
        $("#kt_datepicker_1").datepicker({ 
            format: 'yyyy-mm-dd'
        });
    </script>
@endsection
