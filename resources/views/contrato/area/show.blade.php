@extends('layouts.appNew')
@section('content')
    <x-subheader title="Empresa - {{ $empresa->nombre }}"
                 :subheaders="[ ]"
                 :acciones="[]">
    </x-subheader>

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <x-sesiones></x-sesiones>
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">
                            {{ $sucursal->nombre }} - {{ $sucursal->razon_social }}
                            <small>Area: {{ $area->nombre }}</small>
                        </h3>
                    </div>
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
                <div class="card-body">
                    <div class="form-group row  mb-n4">
                        <div class="form-group col-lg-12">
                            <label for="descripcion">Descripcion del Area:</label>
                            <textarea class="form-control" readonly="readonly" rows="3">{{ $area->descripcion  }}</textarea>
                        </div>

                    </div>
                </div>
                <div class="card-footer">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home">Secciones</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="home" class="container tab-pane active">
                            <div class="card card-custom gutter-b">
                                <div class="card-header flex-wrap py-3">
                                    <div class="card-title">
                                        <h3 class="card-label">Secciones del Area - {{ $area->nombre }}</h3>
                                    </div>
                                    <div class="card-toolbar">
                                        @can('havepermiso', 'Seccion.create')
                                            <x-boton class="btn-primary" title="Crear Seccion">
                                                <x-slot name="svg">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                                                        <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
                                                    </g>
                                                </x-slot>
                                                {{ route('area.seccion.create', $area) }}
                                            </x-boton>
                                        @endcan
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="display responsive nowrap" width="100%" id="myTable0">
                                        <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Descripcion</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($secciones as $seccion)
                                            <tr>
                                                <th>{{ $seccion->nombre }}</th>
                                                <th>{{ $seccion->descripcion }}</th>
                                                <th>
                                                    @can('havepermiso', 'Seccion.edit')
                                                        <a href="{{ route('seccion.edit', $seccion) }}" title="Editar"><i class="flaticon2-pen text-primary"></i></a>
                                                    @endcan
                                                </th>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->

@endsection

@section('head')
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('script')
    <script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
    <script src="{{ asset('js/responsive.bootstrap4.min.js') }}" defer></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}" defer></script>
    <script>
        $(document).ready( function () {
            $('#myTable0').DataTable({
                responsive: true
            });
        } );
    </script>
@endsection
