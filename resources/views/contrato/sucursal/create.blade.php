@extends('layouts.appNew')
@section('content')
    <x-subheader title="Sucursal"
                 :subheaders="[  ]"
                 :acciones="[ ['href'=>'sucursal.index', 'nombre'=>'Ver Sucursales', 'permiso'=>'Sucursal.index'] ]">
    </x-subheader>

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <x-sesiones></x-sesiones>
            <x-noticia>
                <x-slot name="svg">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="#000000" opacity="0.3"/>
                        <rect fill="#000000" x="11" y="9" width="2" height="7" rx="1"/>
                        <rect fill="#000000" x="11" y="17" width="2" height="2" rx="1"/>
                    </g>
                </x-slot>
                Los sucursales podran ser modificadas unicamente por Aprore. <br>
                <a href="https://www.facebook.com/luis.morales.velazquez/" target="_blank">Comunicarme con TI.</a>
            </x-noticia>
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Registro de Sucursales</h3>
                </div>
                <!--begin::Form-->
                <form method="POST" action="{{ route('sucursal.store') }}" autocomplete="off">
                    @csrf
                    <div class="card-body">
                        @if ( $errors->any() )
                            <x-errors></x-errors>
                        @endif
                        <div class="form-group">
                            <label for="nombre">Nombre de la Sucursal: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" id="nombre" name="nombre" placeholder="Aprore" />
                        </div>

                        <div class="form-group">
                            <label for="razon">Razón Social de la Sucursal: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('razon') is-invalid @enderror" value="{{ old('razon') }}" id="razon" name="razon" placeholder="Aprore S.A. de C.V." />
                        </div>

                        <div class="form-group">
                            <label for="rfc">RFC de la Sucursal: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('rfc') is-invalid @enderror" value="{{ old('rfc') }}" id="rfc" name="rfc" placeholder="APRO991024CA1" />
                        </div>

                        <div class="form-group">
                            <label for="correo">Correo de la Sucursal: <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('correo') is-invalid @enderror" value="{{ old('correo') }}" id="correo" name="correo" placeholder="contacto@aprore.com" />
                        </div>

                        <div class="form-group">
                            <label for="telefono">Telefono de la Sucursal: <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}" id="telefono" name="telefono" placeholder="9211479791" />
                        </div>

                        <div class="form-group">
                            <label for="direccion">Direccion de la Sucursal: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('direccion') is-invalid @enderror" value="{{ old('direccion') }}" id="direccion" name="direccion" placeholder="Mexico Mx Cp. 96536" />
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripcion de la Sucursal:<span class="text-danger">*</span></label>
                            <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="3">{{ old('descripcion') }}</textarea>
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
