@extends('layouts.appNew')
@section('content')
    <x-subheader title="Postulante" 
        :subheaders="[ ['href'=>'empresa.index', 'nombre'=>'Editar'] ]"
        :acciones="[ ]">
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
                                <div class="wizard-step" data-wizard-type="step">
                                    <div class="wizard-label">
                                        <a href="{{ route('postulante.edit', $postulante->id) }}">
                                            <i class="wizard-icon flaticon-user"></i>
                                            <h3 class="wizard-title">1. Datos Personales</h3>
                                        </a>
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
                                <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
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
                <form method="POST" action="{{ route('informacion.update', $postulante->id) }}" autocomplete="off">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        @if ( $errors->any() )
                            <x-errors></x-errors>
                        @endif
                        <div class="form-group">
                            <label>Persona:</label>
                            <input type="text" class="form-control" readonly value="{{ $postulante->user->persona->nombre }} {{ $postulante->user->persona->apellido_paterno }} {{ $postulante->user->persona->apellido_materno }}"/>
                        </div>
                        <div class="form-group">
                            <label for="curp">Curp: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('curp') is-invalid @enderror" value="{{ old('curp', $postulante->curp) }}" id="curp" name="curp" placeholder="MOVL991024GHXDSC06" />
                        </div>

                        <div class="form-group">
                            <label for="rfc">RFC: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('rfc') is-invalid @enderror" value="{{ old('rfc', $postulante->rfc) }}" id="rfc" name="rfc" placeholder="MOVL991024CD5" />
                        </div>

                        <div class="form-group">
                            <label for="nss">Numero de Seguro Social: <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control @error('nss') is-invalid @enderror" value="{{ old('nss', $postulante->nss) }}" id="nss" name="nss" placeholder="0155745512" />
                        </div>

                        <p class="font-size-h5">Dirección: </p>

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="calle">Calle y Numero:</label>
                                <input type="text" class="form-control @error('calle') is-invalid @enderror" value="{{ old('calle', $postulante->calle) }}" id="calle" name="calle" placeholder="Av. Universitaria #105" />
                            </div>
                            
                            <div class="form-group col-lg-6">
                                <label for="colonia">Colonia:</label>
                                <input type="text" class="form-control @error('colonia') is-invalid @enderror" value="{{ old('colonia', $postulante->colonia) }}" id="colonia" name="colonia" placeholder="Centro" />
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="ciudad">Ciudad:</label>
                                <input type="text" class="form-control @error('ciudad') is-invalid @enderror" value="{{ old('ciudad', $postulante->ciudad) }}" id="ciudad" name="ciudad" placeholder="Coatzacoalcos" />
                            </div>
                            
                            <div class="form-group col-lg-6">
                                <label for="codigo_postal">Codigo Postal:</label>
                                <input type="tel" class="form-control @error('codigo_postal') is-invalid @enderror" value="{{ old('codigo_postal', $postulante->codigo_postal) }}" id="codigo_postal" name="codigo_postal" placeholder="96536" />
                            </div>

                        </div>
                        
                        <div class="form-group">
                            <label for="kt_datepicker_1">Fecha de Alta: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('fecha_alta') is-invalid @enderror" value="{{ old('fecha_alta', $postulante->fecha_alta) }}" id="kt_datepicker_1" name="fecha_alta" readonly="readonly" placeholder="05/10/2020" />
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                        <button type="reset" class="btn btn-secondary mr-2">Cancelar</button>
                        <a href="{{ route('expediente.edit', $postulante->id) }}" class="btn btn-info">Siguiente</a>
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
