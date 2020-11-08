@extends('layouts.appNew')
@section('content')
    <x-subheader title="Registrar Baja"
        :subheaders="[ ]"
        :acciones="[ ['href'=>'baja.index', 'nombre'=>'Ver Bajas', 'permiso'=>'Baja.index'] ] ">
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
                        <h3 class="card-label">Seleccione el trabajador que sera dado de Baja:
                            <span class="d-block text-muted pt-2 font-size-sm">Trabajadores, registrados en {{ $empresa->nombre }}.</span></h3>
                    </div>
                    <div class="card-toolbar">

                    </div>
                </div>
                <div class="card-body">
                    <!--begin: Datatable-->
                    <table class="display responsive nowrap" width="100%" id="Table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Telefono</th>
                                <th>Correo</th>
                                <th>Estado</th>
                                <th>Baja</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($trabajadores as $trabajador)
                            <tr>
                                <td>{{ $trabajador->user->persona->nombre }}</td>
                                <td>{{ $trabajador->user->persona->telefono }}</td>
                                <td>{{ $trabajador->user->email }}</td>
                                @if ( $trabajador->estado == 4 )
                                    <td>
                                        <span class="label label-success label-inline mr-2">Aceptado</span>
                                    </td>
                                @endif
                                @if ( $trabajador->estado == 6 )
                                    <td>
                                        <span class="label label-info label-inline mr-2">Contratado</span>
                                    </td>
                                @endif
                                <td><a href="{{ route('postulante.baja.create', $trabajador) }}">Baja</a></td>
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
            $('#Table').DataTable({
                responsive: true
            });
        } );
    </script>
@endsection
