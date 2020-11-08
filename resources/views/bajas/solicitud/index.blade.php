@extends('layouts.appNew')
@section('content')
    <x-subheader title="Solicitudes de bajas"
                 :subheaders="[]"
                 :acciones="[]">
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
                        <h3 class="card-label">Solicitudes de Bajas:
                            <span class="d-block text-muted pt-2 font-size-sm">Listado de solcitudes de Baja, por aceptar.</span></h3>
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
                            <th>Tipo</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($bajas as $baja)
                                <tr>
                                    <td>{{ $baja->trabajador->user->persona->nombre }}</td>
                                    <td>{{ $baja->tipo_baja }}</td>
                                    <td>{{ $baja->fecha_baja }}</td>
                                    @if ( $baja->estado == 0 )
                                        <td>
                                            <span class="label label-warning label-inline mr-2">Solicitud</span>
                                        </td>
                                        <td>
                                            @can('havepermiso', 'Baja.solicitud.show')
                                                <a href="{{ route('solicitudbaja.show', $baja) }}" title="Ver"><i class="flaticon-eye text-primary"></i></a>
                                            @endcan
                                        </td>
                                    @endif
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
    @include('postulantes.modal.deleteTrabajador')
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
