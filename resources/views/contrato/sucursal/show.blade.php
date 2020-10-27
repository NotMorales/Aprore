@extends('layouts.appNew')
@section('content')
    <x-subheader title="Empresa - {{ $empresa->nombre }}"
        :subheaders="[ ]"
        :acciones="[ ['href'=>'sucursal.index', 'nombre'=>'Ver Sucursales', 'permiso'=>'Sucursal.index']]">
    </x-subheader>

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <x-sesiones></x-sesiones>
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">{{ $sucursal->nombre }} - {{ $sucursal->razon_social }}</h3>
                    <div class="card-toolbar">
                        @can('havepermiso', 'Sucursal.edit')
                            <x-boton class="btn-primary" title="Editar Sucursal">
                                <x-slot name="svg">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>
                                    </g>
                                </x-slot>
                                {{ route('sucursal.edit', $sucursal) }}
                            </x-boton>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row  mb-n4">
                        <div class="form-group col-lg-6">
                            <label for="direccion">Dirección de la Sucursal:</label>
                            <input type="text" readonly="readonly" class="form-control" value="{{ $sucursal->direccion }}" id="direccion" />
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="correo">Correo de la Sucursal:</label>
                            <input type="email" readonly="readonly" class="form-control" value="{{ $sucursal->correo }}" id="correo" />
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="Telefono">Telefono de la Sucursal:</label>
                            <input type="tel" readonly="readonly" class="form-control" value="{{ $sucursal->telefono }}" id="telefonoEmp" />
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="rfc">RFC de la Sucursal:</label>
                            <input type="text" readonly="readonly" class="form-control" value="{{ $sucursal->rfc }}" id="rfc" />
                        </div>

                        <div class="form-group col-lg-12">
                            <label for="descripcion">Descripcion de la Sucursal:</label>
                            <textarea class="form-control" readonly="readonly" rows="3">{{ $sucursal->descripcion  }}</textarea>
                        </div>

                    </div>
                </div>
                <div class="card-footer">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home">Areas</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="home" class="container tab-pane active">
                            <div class="card card-custom gutter-b">
                                <div class="card-header flex-wrap py-3">
                                    <div class="card-title">
                                        <h3 class="card-label">Areas de la Sucursal:</h3>
                                    </div>
                                    <div class="card-toolbar">
                                        @can('havepermiso', 'Area.create')
                                            <x-boton class="btn-primary" title="Crear Area">
                                                <x-slot name="svg">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                                                        <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
                                                    </g>
                                                </x-slot>
                                                {{ route('sucursal.area.create', $sucursal) }}
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
                                        @foreach ($areas as $area)
                                            <tr>
                                                <th>{{ $area->nombre }}</th>
                                                <th>{{ $area->descripcion }}</th>
                                                <th>
                                                    @can('havepermiso', 'Area.edit')
                                                        <a href="{{ route('area.edit', $area) }}" title="Editar"><i class="flaticon2-pen text-primary"></i></a>
                                                    @endcan
                                                    @can('havepermiso', 'Area.show')
                                                        <a href="{{ route('area.show', $area) }}" title="Ver"><i class="flaticon-eye text-primary"></i></a>
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
