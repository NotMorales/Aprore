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
                    <a href="#" data-toggle="modal" data-target="#solicitudRechazada" data-baja="{{ $baja->id }}" class="btn btn-danger mr-2">Rechazar</a>
                    <a href="{{ route('baja.index') }}" class="btn btn-primary mr-2">Volver</a>
                    <a href="#" data-toggle="modal" data-target="#solicitudAprobada" data-baja="{{ $baja->id }}" class="btn btn-success mr-2">Aceptar</a>
                </div>

            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
    <div class="modal fade" id="solicitudAprobada" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Aceptar Baja</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-baja-acep" method="post" action="{{ route('solicitudbaja.update', $baja->id) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="do" value="1">
                    </form>
                    <h4>¿Esta usted seguro?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success" form="form-baja-acep">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="solicitudRechazada" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rechazar Baja</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-baja-rech" method="post" action="{{ route('solicitudbaja.update', $baja->id) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="do" value="0">
                        <div class="form-group mb-1">
                            <label for="motivoRechazo">Motivo del rechazo:<span class="text-danger">*</span></label>
                            <textarea maxlength="10000" class="form-control @error('motivoRechazo') is-invalid @enderror" id="motivoRechazo" rows="3" name="motivoRechazo"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger" form="form-baja-rech">Rechazar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('head')

@endsection
@section('script')
    <script>
        $('#solicitudRechazada').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var modal = $(this);
        });
        $('#solicitudAprobada').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var modal = $(this);
        });
    </script>
@endsection
