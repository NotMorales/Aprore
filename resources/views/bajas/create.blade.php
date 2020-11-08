@extends('layouts.appNew')
@section('content')
    <x-subheader title="Baja del trabajador"
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
                        {{ $trabajador->user->persona->nombre }} {{ $trabajador->user->persona->apellido_paterno }} {{ $trabajador->user->persona->apellido_materno }}
                    </div>
                </div>
                <!--begin::Form-->
                <form method="POST" action="{{ route('postulante.baja.store', $trabajador) }}" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="form-group col-lg-6">
                                <label for="Telefono">Telefono:</label>
                                <input readonly="readonly" class="form-control" value="{{ $trabajador->user->persona->telefono }}"/>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="rfc">Correo:</label>
                                <input readonly="readonly" class="form-control" value="{{ $trabajador->user->email }}"/>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="descripcion">RFC:</label>
                                <input readonly="readonly" class="form-control" value="{{ $trabajador->rfc }}"/>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="descripcion">CURP:</label>
                                <input readonly="readonly" class="form-control" value="{{ $trabajador->curp }}"/>
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
                                <input type="text" class="form-control @error('tipo') is-invalid @enderror" value="{{ old('tipo') }}" id="tipo" name="tipo" placeholder="Baja Temporal" />
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="kt_datepicker_1">Fecha de Baja: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('fecha_baja') is-invalid @enderror" value="{{ old('fecha_baja') }}" id="kt_datepicker_1" name="fecha_baja" readonly="readonly" placeholder="24/10/1999" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mensaje">Anotaciones de la baja:</label>
                            <textarea class="form-control @error('mensaje') is-invalid @enderror" id="mensaje" name="mensaje" rows="3">{{ old('mensaje') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Expediente de la Baja:</label>
                            <div></div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('expediente') is-invalid @enderror" id="customFile" name="expediente" accept=".pdf,.zip,.rar"/>
                                <label class="custom-file-label" for="customFile">Seleccionar Archivo</label>
                            </div>
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
