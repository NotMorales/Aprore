@extends('layouts.appNew')
@section('content')
    <x-subheader title="Postulante" 
        :subheaders="[ ['href'=>'empresa.index', 'nombre'=>'Completar'] ]"
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
                    <div class="card-title">
                        {{ $postulante->user->persona->nombre }} {{ $postulante->user->persona->apellido_paterno }} {{ $postulante->user->persona->apellido_materno }}
                    </div>
                    <div class="card-toolbar">
                        {{-- <x-boton class="btn-primary" title="Imprimir">
                            <x-slot name="svg">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M16,17 L16,21 C16,21.5522847 15.5522847,22 15,22 L9,22 C8.44771525,22 8,21.5522847 8,21 L8,17 L5,17 C3.8954305,17 3,16.1045695 3,15 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,15 C21,16.1045695 20.1045695,17 19,17 L16,17 Z M17.5,11 C18.3284271,11 19,10.3284271 19,9.5 C19,8.67157288 18.3284271,8 17.5,8 C16.6715729,8 16,8.67157288 16,9.5 C16,10.3284271 16.6715729,11 17.5,11 Z M10,14 L10,20 L14,20 L14,14 L10,14 Z" fill="#000000"/>
                                    <rect fill="#000000" opacity="0.3" x="8" y="2" width="8" height="2" rx="1"/>
                                </g>
                            </x-slot>
                            {{ route('empresa.index') }}
                        </x-boton> --}}
                    </div>
                </div>
                
                <div class="card-body">
                    @if ( $errors->any() )
                        <x-errors></x-errors>
                        <script>
                            $('#solicitudRechazada').modal('show');
                            $(function(){
                                $('#solicitudRechazada').modal('show')
                            });
                        </script>
                    @endif
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Sexo </label>
                            <input type="tel" class="form-control" value="{{ $postulante->user->persona->sexo }}" readonly="readonly"/>
                            </select>
                        </div>
                        
                        <div class="form-group col-lg-6">
                            <label>Telefono:</label>
                            <input type="tel" class="form-control" value="{{ $postulante->user->persona->telefono }}" readonly="readonly"/>
                        </div>
    
                        <div class="form-group col-lg-6">
                            <label>Fecha de Nacimiento:</label>
                            <input type="text" class="form-control" value="{{ $postulante->user->persona->fecha_nacimiento }}" readonly="readonly"/>
                        </div>
    
                        <div class="form-group col-lg-6">
                            <label>Correo Electronico:</label>
                            <input type="email" class="form-control" value="{{ $postulante->user->email }}" readonly="readonly"/>
                        </div>
    
                        <div class="form-group col-lg-6">
                            <label>Curp:</label>
                            <input type="text" class="form-control" value="{{ $postulante->curp }}" readonly="readonly"/>
                        </div>
    
                        <div class="form-group col-lg-6">
                            <label>RFC:</label>
                            <input type="text" class="form-control" value="{{ $postulante->rfc }}" readonly="readonly"/>
                        </div>
    
                        <div class="form-group col-lg-6">
                            <label>Numero de Seguro Social:</label>
                            <input type="tel" class="form-control" value="{{ $postulante->nss }}" readonly="readonly"/>
                        </div>
                        
                        <div class="form-group col-lg-6">
                            <label>Clabe Interbancaria:</label>
                            <input type="text" class="form-control" value="{{ $postulante->clabe_bancaria }}" readonly="readonly"/>
                        </div>
                    </div>

                    <p class="font-size-h5">Dirección: </p>

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Calle y Numero:</label>
                            <input type="text" class="form-control" value="{{ $postulante->calle }}" readonly="readonly"/>
                        </div>
                        
                        <div class="form-group col-lg-6">
                            <label>Colonia:</label>
                            <input type="text" class="form-control" value="{{ $postulante->colonia }}" readonly="readonly"/>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Ciudad:</label>
                            <input type="text" class="form-control " value="{{ $postulante->ciudad }}" readonly="readonly"/>
                        </div>
                        
                        <div class="form-group col-lg-6">
                            <label>Codigo Postal:</label>
                            <input type="tel" class="form-control" value="{{ $postulante->codigo_postal }}" readonly="readonly"/>
                        </div>
                    </div>
                    
                    <div>
                        <iframe src="{{'https://' . Storage::disk('expediente')->url($postulante->expediente_path)}}" width="100%" height="400" frameborder="0"></iframe>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="#" data-toggle="modal" data-target="#solicitudRechazada" data-trabajador="{{ $postulante->id }}" class="btn btn-danger mr-2">Rechazar</a>
                    <a href="{{ route('solicitudes.index') }}" class="btn btn-primary mr-2">Volver</a>
                    <a href="#" data-toggle="modal" data-target="#solicitudAprobada" data-trabajador="{{ $postulante->id }}" class="btn btn-success mr-2">Aceptar</a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Aceptar Postulante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-postulante-acep" method="post" action="{{ route('solicitud.aceptar') }}">
                        @csrf
                        <input type="hidden" name="trabajador" value="{{ $postulante->id }}">
                    </form>
                    <h4>¿Esta usted seguro?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success" form="form-postulante-acep">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="solicitudRechazada" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rechazar Postulante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-postulante-rech" method="post" action="{{ route('solicitud.rechazo') }}">
                        @csrf
                        <input type="hidden" name="trabajador" value="{{ $postulante->id }}">
                        <div class="form-group mb-1">
                            <label for="motivoRechazo">Motivo del rechazo:<span class="text-danger">*</span></label>
                            <textarea maxlength="10000" class="form-control @error('motivoRechazo') is-invalid @enderror" id="motivoRechazo" rows="3" name="motivoRechazo"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger" form="form-postulante-rech">Rechazar</button>
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
        var trabajador = button.data('trabajador');
        var modal = $(this);
        modal.find('.modal-body input[name=trabajador]').val(trabajador);
    });
</script>
@endsection
