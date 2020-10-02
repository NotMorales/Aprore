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
                        <x-boton class="btn-primary" title="Imprimir">
                            <x-slot name="svg">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M16,17 L16,21 C16,21.5522847 15.5522847,22 15,22 L9,22 C8.44771525,22 8,21.5522847 8,21 L8,17 L5,17 C3.8954305,17 3,16.1045695 3,15 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,15 C21,16.1045695 20.1045695,17 19,17 L16,17 Z M17.5,11 C18.3284271,11 19,10.3284271 19,9.5 C19,8.67157288 18.3284271,8 17.5,8 C16.6715729,8 16,8.67157288 16,9.5 C16,10.3284271 16.6715729,11 17.5,11 Z M10,14 L10,20 L14,20 L14,14 L10,14 Z" fill="#000000"/>
                                    <rect fill="#000000" opacity="0.3" x="8" y="2" width="8" height="2" rx="1"/>
                                </g>
                            </x-slot>
                            {{ route('empresa.index') }}
                        </x-boton>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="sexo">Sexo </label>
                            <input type="tel" class="form-control @error('telefono') is-invalid @enderror" value="{{ $postulante->user->persona->sexo }}" id="telefono" name="telefono" placeholder="9211479791" />
                            </select>
                        </div>
                        
                        <div class="form-group col-lg-6">
                            <label for="telefono">Telefono:</label>
                            <input type="tel" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono', $postulante->user->persona->telefono) }}" id="telefono" name="telefono" placeholder="9211479791" />
                        </div>
    
                        <div class="form-group col-lg-6">
                            <label for="kt_datepicker_1">Fecha de Nacimiento:</label>
                            <input type="text" class="form-control @error('fecha_nacimiento') is-invalid @enderror" value="{{ old('fecha_nacimiento',  $postulante->user->persona->fecha_nacimiento) }}" id="kt_datepicker_1" name="fecha_nacimiento" readonly="readonly" placeholder="24/10/1999" />
                        </div>
    
                        <div class="form-group col-lg-6">
                            <label for="email">Correo Electronico:</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email',  $postulante->user->email) }}" id="email" name="email" placeholder="morales.lamv@gmail.com" />
                        </div>
    
                        <div class="form-group col-lg-6">
                            <label for="curp">Curp:</label>
                            <input type="text" class="form-control @error('curp') is-invalid @enderror" value="{{ old('curp', $postulante->curp) }}" id="curp" name="curp" placeholder="MOVL991024GHXDSC06" />
                        </div>
    
                        <div class="form-group col-lg-6">
                            <label for="rfc">RFC:</label>
                            <input type="text" class="form-control @error('rfc') is-invalid @enderror" value="{{ old('rfc', $postulante->rfc) }}" id="rfc" name="rfc" placeholder="MOVL991024CD5" />
                        </div>
    
                        <div class="form-group col-lg-6">
                            <label for="nss">Numero de Seguro Social:</label>
                            <input type="tel" class="form-control @error('nss') is-invalid @enderror" value="{{ old('nss', $postulante->nss) }}" id="nss" name="nss" placeholder="0155745512" />
                        </div>
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

                        @if ( $postulante->expediente_path == null )
                            Sin expediente
                        @else
                            con expediente
                        @endif
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                </div>
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
