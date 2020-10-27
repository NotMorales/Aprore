@extends('layouts.appNew')
@section('content')
    <x-subheader title="Editar Sucursal"
                 :subheaders="[  ]"
                 :acciones="[ ['href'=>'sucursal.index', 'nombre'=>'Ver Sucursales', 'permiso'=>'Sucursal.index'] ]">
    </x-subheader>

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <x-sesiones></x-sesiones>
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Edicion de Sucursales</h3>
                    <div class="card-toolbar">
                        @can('havepermiso', 'Sucursal.show')
                            <x-boton class="btn-primary" title="Ver Sucursal">
                                <x-slot name="svg">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M11.0879549,18.2771971 L17.8286578,12.3976203 C18.0367595,12.2161036 18.0583109,11.9002555 17.8767943,11.6921539 C17.8622027,11.6754252 17.8465132,11.6596867 17.8298301,11.6450431 L11.0891271,5.72838979 C10.8815919,5.54622572 10.5656782,5.56679309 10.3835141,5.7743283 C10.3034433,5.86555116 10.2592899,5.98278612 10.2592899,6.10416552 L10.2592899,17.9003957 C10.2592899,18.1765381 10.4831475,18.4003957 10.7592899,18.4003957 C10.8801329,18.4003957 10.9968872,18.3566309 11.0879549,18.2771971 Z" fill="#000000" transform="translate(14.129645, 12.002277) scale(-1, 1) translate(-14.129645, -12.002277) "/>
                                        <rect fill="#000000" opacity="0.3" x="6" y="6" width="3" height="12" rx="1"/>
                                    </g>
                                </x-slot>
                                {{ route('sucursal.show', $sucursal) }}
                            </x-boton>
                        @endcan
                    </div>
                </div>
                <!--begin::Form-->
                <form method="POST" action="{{ route('sucursal.update', $sucursal) }}" autocomplete="off">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        @if ( $errors->any() )
                            <x-errors></x-errors>
                        @endif
                        <div class="form-group">
                            <label for="nombre">Nombre de la Sucursal: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $sucursal->nombre) }}" id="nombre" name="nombre" placeholder="Aprore" />
                        </div>

                        <div class="form-group">
                            <label for="razon">Razón Social de la Sucursal: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('razon') is-invalid @enderror" value="{{ old('razon', $sucursal->razon_social) }}" id="razon" name="razon" placeholder="Aprore S.A. de C.V." />
                        </div>

                        <div class="form-group">
                            <label for="rfc">RFC de la Sucursal: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('rfc') is-invalid @enderror" value="{{ old('rfc', $sucursal->rfc) }}" id="rfc" name="rfc" placeholder="APRO991024CA1" />
                        </div>

                        <div class="form-group">
                            <label for="correo">Correo de la Sucursal: <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('correo') is-invalid @enderror" value="{{ old('correo', $sucursal->correo) }}" id="correo" name="correo" placeholder="contacto@aprore.com" />
                        </div>

                        <div class="form-group">
                            <label for="telefono">Telefono de la Sucursal: <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono', $sucursal->telefono) }}" id="telefono" name="telefono" placeholder="9211479791" />
                        </div>

                        <div class="form-group">
                            <label for="direccion">Direccion de la Sucursal: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('direccion') is-invalid @enderror" value="{{ old('direccion', $sucursal->direccion) }}" id="direccion" name="direccion" placeholder="Mexico Mx Cp. 96536" />
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripcion de la Sucursal:<span class="text-danger">*</span></label>
                            <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="3">{{ old('descripcion', $sucursal->descripcion) }}</textarea>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                        <button type="reset" class="btn btn-secondary">Cancelar</button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection

@section('head')

@endsection

@section('script')

@endsection
