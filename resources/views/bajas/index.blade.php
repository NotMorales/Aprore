@extends('layouts.appNew')
@section('content')
    <x-subheader title="Bajas"
                 :subheaders="[ ]"
                 :acciones="[ ['href'=>'baja.select', 'nombre'=>'Registrar Baja', 'permiso'=>'Baja.create'] ] ">
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
                        <h3 class="card-label">Registro de Bajas:
                            <span class="d-block text-muted pt-2 font-size-sm">Listado de Bajas, registrados en {{ $empresa->nombre }}.</span></h3>
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
                                        <span class="label label-warning label-inline mr-2">Pendiente</span>
                                    </td>
                                    <td>
                                        @can('havepermiso', 'Baja.show')
                                            <a href="{{ route('baja.show', $baja) }}" title="Ver"><i class="flaticon-eye text-primary"></i></a>
                                        @endcan
                                    </td>
                                @endif
                                @if ( $baja->estado == 1 )
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#mensaje" data-trabajador="{{ $baja->descripcion }}"><span class="label label-danger label-inline mr-2">Rechazado</span></a>
                                    </td>
                                    <td>
                                        @can('havepermiso', 'Baja.show')
                                            <a href="{{ route('baja.show', $baja) }}" title="Ver"><i class="flaticon-eye text-primary"></i></a>
                                        @endcan
                                        @can('havepermiso', 'Baja.edit')
                                            <a href="{{ route('baja.edit', $baja) }}" title="Ver"><i class="flaticon-edit text-primary"></i></a>
                                        @endcan
                                    </td>
                                @endif
                                @if ( $baja->estado == 2 )
                                    <td>
                                        <span class="label label-success label-inline mr-2">Aceptada</span>
                                    </td>
                                    <td>
                                        @can('havepermiso', 'Baja.show')
                                            <a href="{{ route('baja.show', $baja) }}" title="Ver"><i class="flaticon-eye text-primary"></i></a>
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

    @include('bajas.modals.mensaje')
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
        $('#mensaje').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var msg = button.data('trabajador');
            var modal = $(this);
            modal.find('.mensaje').text(msg);
        });
        } );
    </script>
@endsection
