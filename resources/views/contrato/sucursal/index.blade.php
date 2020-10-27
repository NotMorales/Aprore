@extends('layouts.appNew')
@section('content')
    <x-subheader title="Sucursales"
        :subheaders="[  ]"
        :acciones="[ ['href'=>'sucursal.create', 'nombre'=>'Crear Sucursal', 'permiso'=>'Sucursal.create'] ]">
    </x-subheader>

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <x-sesiones></x-sesiones>
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap py-3">
                    <div class="card-title">
                        <h3 class="card-label">Sucursales Registradas:
                            <span class="d-block text-muted pt-2 font-size-sm">Listado de sucursales, relacionadas con {{ $empresa->nombre }}.</span></h3>
                    </div>
                    <div class="card-toolbar">

                    </div>
                </div>
                <div class="card-body">
                    <!--begin: Datatable-->
                    <table class="table display" id="myTable">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Informacion</th>
                            <th>Telefono</th>
                            <th>Direccion</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($sucursales as $sucursal)
                            <tr>
                                <td>{{ $sucursal->nombre }}</td>
                                <td>{{ $sucursal->descripcion }}</td>
                                <td>{{ $sucursal->telefono }}</td>
                                <td>{{ $sucursal->direccion }}</td>
                                <td>
                                    @can('havepermiso', 'Sucursal.show')
                                        <a href="{{ route('sucursal.show', $sucursal) }}" title="Ver"><i class="flaticon-eye text-primary"></i></a>
                                    @endcan
                                    @can('havepermiso', 'Sucursal.edit')
                                            <a href="{{ route('sucursal.edit', $sucursal) }}" title="Editar"><i class="flaticon2-pen text-primary"></i></a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!--end: Datatable-->
                </div>
            </div>
            <!--end::Card-->
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
            $('#myTable').DataTable({
                responsive: true
            });

        } );
    </script>
@endsection
