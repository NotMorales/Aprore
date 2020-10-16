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
                    @if ($postulante->estado == 5)
                        <div class="alert alert-custom alert-danger fade show mb-5" role="alert">
                            <div class="alert-icon"><i class="flaticon-warning"></i></div>
                            <div class="alert-text">{{ $postulante->descripcion }}</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                </button>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Sexo </label>
                            <input type="tel" class="form-control" value="{{ $postulante->user->persona->sexo }}" readonly="readonly"/>

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

                    @if ( $postulante->expediente_path == null )
                        <div class="alert alert-custom alert-light-danger fade show mb-5" role="alert">
                            <div class="alert-icon"><i class="flaticon-warning"></i></div>
                            <div class="alert-text">¡Sin Expediente!</div>
                        </div>
                    @else
                        <div>
                            <iframe src="{{'https://' . Storage::disk('expediente')->url($postulante->expediente_path)}}" width="100%" height="400" frameborder="0"></iframe>
                        </div>
                    @endif
                </div>
                <div class="card-footer">
                    <a href="{{ route('postulante.index') }}" class="btn btn-primary mr-2">Volver</a>
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
