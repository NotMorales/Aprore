@extends('layouts.appNew')
@section('content')
    <x-subheader title="Ver Baja del trabajador"
                 :subheaders="[  ]"
                 :acciones="[ ['href'=>'baja.index', 'nombre'=>'Ver Bajas', 'permiso'=>'Baja.create'] ]">
    </x-subheader>

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <x-sesiones></x-sesiones>
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        {{ $baja->trabajador->user->persona->nombre }} {{ $baja->trabajador->user->persona->apellido_paterno }} {{ $baja->trabajador->user->persona->apellido_materno }}
                    </div>
                </div>

                <div class="card-body">
                    @if ($baja->estado == 1)
                        <div class="alert alert-custom alert-danger fade show mb-5" role="alert">
                            <div class="alert-icon"><i class="flaticon-warning"></i></div>
                            <div class="alert-text">{{ $baja->descripcion }}</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                </button>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row">
                        <div class="form-group col-lg-6">
                            <label for="Telefono">Telefono:</label>
                            <input readonly="readonly" class="form-control" value="{{ $baja->trabajador->user->persona->telefono }}"/>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="rfc">Correo:</label>
                            <input readonly="readonly" class="form-control" value="{{ $baja->trabajador->user->email }}"/>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="descripcion">RFC:</label>
                            <input readonly="readonly" class="form-control" value="{{ $baja->trabajador->rfc }}"/>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="descripcion">CURP:</label>
                            <input readonly="readonly" class="form-control" value="{{ $baja->trabajador->curp }}"/>
                        </div>
                    </div>

                    <hr>
                    <br>


                    <div class="form-group row">
                        <div class="form-group col-lg-6">
                            <label for="tipo">Tipo de Baja: <span class="text-danger">*</span></label>
                            <input readonly="readonly" class="form-control" value="{{ $baja->tipo_baja  }}" />
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="kt_datepicker_1">Fecha de Baja: <span class="text-danger">*</span></label>
                            <input readonly="readonly" class="form-control" value="{{ $baja->fecha_baja }}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="mensaje">Anotaciones de la baja:</label>
                        <textarea class="form-control" readonly="readonly" rows="3">{{ $baja->mensaje }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Expediente de la Baja:</label>
                        <div></div>
                        <div class="custom-file">
                            @if ( $baja->doc_renuncia_patch == null )
                                <div class="alert alert-custom alert-light-danger fade show mb-5" role="alert">
                                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                    <div class="alert-text">¡Sin Expediente de Baja!</div>
                                </div>
                            @else
                                <div>
                                    <iframe src="{{'http://' . Storage::disk('baja')->url($baja->doc_renuncia_patch)}}" width="100%" height="600" frameborder="0"></iframe>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <a href="{{ route('baja.index') }}" class="btn btn-primary mr-2">Volver</a>
                </div>

            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection

@section('head')

@endsection

@section('script')

@endsection
