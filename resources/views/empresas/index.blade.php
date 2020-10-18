@extends('layouts.appNew')
@section('content')
    <x-subheader title="Epresas"
        :subheaders="[ ['href'=>'empresa.index', 'nombre'=>'Inicio'] ]"
        :acciones="[ ['href'=>'empresa.create', 'nombre'=>'Crear Empresa', 'permiso'=>'empresa.create'] ]">
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
                        <h3 class="card-label">Empresas registradas:
                        <span class="d-block text-muted pt-2 font-size-sm">Listado de empresas, relacionadas con aprore.</span></h3>
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
                                <th>Contacto</th>
                                <th>Telefono</th>
                                <th>Correo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($empresas as $empresa)
                                <tr>
                                    <td>{{ $empresa->nombre }}</td>
                                    <td>{{ $empresa->contacto }}</td>
                                    <td>{{ $empresa->telefono }}</td>
                                    <td>{{ $empresa->correo }}</td>
                                    <td>
                                        <a href="{{ route('empresa.show', $empresa) }}">Detalles</a>
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
