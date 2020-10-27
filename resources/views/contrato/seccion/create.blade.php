@extends('layouts.appNew')
@section('content')
    <x-subheader title="Sucursal - {{ $sucursal->nombre }} | Area - {{ $area->nombre }}"
                 :subheaders="[ ]"
                 :acciones="[ ]">
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
                Los Secciones podran ser modificadas unicamente por Aprore. <br>
                <a href="https://www.facebook.com/luis.morales.velazquez/" target="_blank">Comunicarme con TI.</a>
            </x-noticia>
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Registro de Secciones</h3>
                    <div class="card-toolbar">
                        @can('havepermiso', 'Area.show')
                            <x-boton class="btn-primary" title="Ver Area">
                                <x-slot name="svg">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M11.0879549,18.2771971 L17.8286578,12.3976203 C18.0367595,12.2161036 18.0583109,11.9002555 17.8767943,11.6921539 C17.8622027,11.6754252 17.8465132,11.6596867 17.8298301,11.6450431 L11.0891271,5.72838979 C10.8815919,5.54622572 10.5656782,5.56679309 10.3835141,5.7743283 C10.3034433,5.86555116 10.2592899,5.98278612 10.2592899,6.10416552 L10.2592899,17.9003957 C10.2592899,18.1765381 10.4831475,18.4003957 10.7592899,18.4003957 C10.8801329,18.4003957 10.9968872,18.3566309 11.0879549,18.2771971 Z" fill="#000000" transform="translate(14.129645, 12.002277) scale(-1, 1) translate(-14.129645, -12.002277) "/>
                                        <rect fill="#000000" opacity="0.3" x="6" y="6" width="3" height="12" rx="1"/>
                                    </g>
                                </x-slot>
                                {{ route('area.show', $area) }}
                            </x-boton>
                        @endcan
                    </div>
                </div>
                <!--begin::Form-->
                <form method="POST" action="{{ route('area.seccion.store', $area) }}" autocomplete="off">
                    @csrf
                    <div class="card-body">
                        @if ( $errors->any() )
                            <x-errors></x-errors>
                        @endif
                        <div class="form-group">
                            <label for="nombre">Nombre de la Seccion: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" id="nombre" name="nombre" placeholder="Aprore" />
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripcion de la Seccion:<span class="text-danger">*</span></label>
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
