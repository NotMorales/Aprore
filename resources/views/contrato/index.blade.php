@extends('layouts.appNew')
@section('content')
    <x-subheader title="Contratos"
             :subheaders="[  ]"
             :acciones="[ ['href'=>'contrato.create', 'nombre'=>'Crear Contrato', 'permiso'=>'Postulante.create'] ] ">
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
                        <h3 class="card-label">Trabajadores | Contratos:
                            <span class="d-block text-muted pt-2 font-size-sm">Listado de trabajadores, relacionadas con {{ $empresa->nombre }}.</span></h3>
                    </div>
                    <div class="card-toolbar">

                    </div>
                </div>
                <div class="card-body">
                    <!--begin: Datatable-->
                    <table class="table display" id="myTable">
                        <thead>
                        <tr>
                            <th>N° Empleado</th>
                            <th>Nombre</th>
                            <th>Rfc</th>
                            <th>Email</th>
                            <th>Telefono</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($trabajadores as $trabajador)
                            <tr>
                                <td>{{ $trabajador->user->id }}</td>
                                <td>{{ $trabajador->user->persona->nombre }} {{ $trabajador->user->persona->apellido_paterno }} {{ $trabajador->user->persona->apellido_materno }}</td>
                                <td>{{ $trabajador->rfc }}</td>
                                <td>{{ $trabajador->user->email }}</td>
                                <td>{{ $trabajador->user->persona->telefono }}</td>
                                <td>
                                    @can('havepermiso', 'Contrato.create')
                                        <a href="{{ route('contrato.create') }}" title="crear"><i class="flaticon2-add text-primary"></i></a>
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
