@extends('layouts.appNew')
@section('content')
    <x-subheader title="Editar Baja del trabajador"
                 :subheaders="[  ]"
                 :acciones="[ ['href'=>'baja.index', 'nombre'=>'Ver Bajas', 'permiso'=>'Baja.index'] ]">
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
                <!--begin::Form-->
                <form method="POST" action="{{ route('baja.update', $baja) }}" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
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

                        @if ( $errors->any() )
                            <x-errors></x-errors>
                        @endif

                        <div class="form-group row">
                            <div class="form-group col-lg-6">
                                <label for="tipo">Tipo de Baja: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('tipo') is-invalid @enderror" value="{{ old('tipo', $baja->tipo_baja) }}" id="tipo" name="tipo" placeholder="Baja Temporal" />
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="kt_datepicker_1">Fecha de Baja: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('fecha_baja') is-invalid @enderror" value="{{ old('fecha_baja', $baja->fecha_baja) }}" id="kt_datepicker_1" name="fecha_baja" readonly="readonly" placeholder="24/10/1999" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mensaje">Anotaciones de la baja:</label>
                            <textarea class="form-control @error('mensaje') is-invalid @enderror" id="mensaje" name="mensaje" rows="3">{{ old('mensaje', $baja->mensaje) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Expediente de la Baja:</label>
                            <div></div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('expediente') is-invalid @enderror" id="customFile" name="expediente" accept=".pdf,.zip,.rar"/>
                                <label class="custom-file-label" for="customFile">Seleccionar Archivo</label>
                            </div>
                            <hr>
                            <br>
                            @if ( $baja->doc_renuncia_patch != null )
                                <div>
                                    <iframe src="{{'http://' . Storage::disk('baja')->url($baja->doc_renuncia_patch)}}" width="100%" height="600" frameborder="0"></iframe>
                                </div>
                            @endif
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

@endsection

@section('script')
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script>
        $("#kt_datepicker_1").datepicker({
            format: 'yyyy-mm-dd'
        });
    </script>
@endsection
