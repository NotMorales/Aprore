@extends('layouts.appNew')
@section('content')
    <x-subheader title="Postulantes"
        :subheaders="[ ['href'=>'postulante.index', 'nombre'=>'Inicio'] ]"
        :acciones="[ ['href'=>'postulante.create', 'nombre'=>'Crear Postulante', 'permiso'=>'Postulante.create'] ] ">
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
                        <h3 class="card-label">Postulantes registrados:
                        <span class="d-block text-muted pt-2 font-size-sm">Listado de postulantes, registrados en {{ $empresa->nombre }}.</span></h3>
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
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($postulantes as $postulante)
                                <tr>
                                    <td>{{ $postulante->persona->nombre }}</td>
                                    <td>{{ $postulante->persona->telefono }}</td>
                                    <td>{{ $postulante->email }}</td>
                                    @if ( $postulante->trabajador->estado == 0 )
                                        <td>
                                            <span class="label label-danger label-inline mr-2">Pendiente</span>
                                        </td>
                                        <td>
                                            @can('havepermiso', 'Postulante.informacion.create')
                                                <a href="{{ route('postulante.informacion.create', $postulante->trabajador->id) }}" title="Completar"><i class="flaticon2-pen text-primary"></i></a>
                                            @endcan
                                            @can('havepermiso', 'Postulante.show')
                                                <a href="{{ route('postulante.show', $postulante->trabajador->id) }}" title="Ver"><i class="flaticon-eye text-primary"></i></a>
                                            @endcan
                                            @can('havepermiso', 'Postulante.destroy')
                                                <a href="#" title="Eliminar" data-toggle="modal" data-target="#deleteTrabajador" data-trabajador="{{ $postulante->trabajador->id }}"><i class="flaticon2-trash text-primary"></i></a>
                                            @endcan
                                        </td>
                                    @endif
                                    @if ( $postulante->trabajador->estado == 1 )
                                        <td>
                                            <span class="label label-info label-inline mr-2">Registrado</span>
                                        </td>
                                        <td>
                                            @can('havepermiso', 'Postulante.show')
                                                <a href="{{ route('postulante.show', $postulante->trabajador->id) }}" title="Ver"><i class="flaticon-eye text-primary"></i></a>
                                            @endcan
                                            @can('havepermiso', 'Postulante.expediente.create')
                                                    <a href="{{ route('postulante.expediente.create', $postulante->trabajador->id) }}" title="Expediente"><i class="flaticon2-document text-primary"></i></a>
                                            @endcan
                                            @can('havepermiso', 'Postulante.destroy')
                                                <a href="#" title="Eliminar" data-toggle="modal" data-target="#deleteTrabajador" data-trabajador="{{ $postulante->trabajador->id }}"><i class="flaticon2-trash text-primary"></i></a>
                                            @endcan
                                        </td>
                                    @endif
                                    @if ( $postulante->trabajador->estado == 2 )
                                        <td>
                                            <span class="label label-primary label-inline mr-2">Completo</span>
                                        </td>
                                        <td>
                                            @can('havepermiso', 'Postulante.edit')
                                                <a href="{{ route('postulante.edit', $postulante->trabajador->id) }}" title="Editar"><i class="flaticon2-pen text-primary"></i></a>
                                            @endcan
                                            @can('havepermiso', 'Postulante.show')
                                                <a href="{{ route('postulante.show', $postulante->trabajador->id) }}" title="Ver"><i class="flaticon-eye text-primary"></i></a>
                                            @endcan
                                            @can('havepermiso', 'Postulante.destroy')
                                                <a href="#" title="Eliminar" data-toggle="modal" data-target="#deleteTrabajador" data-trabajador="{{ $postulante->trabajador->id }}"><i class="flaticon2-trash text-primary"></i></a>
                                            @endcan
                                            @can('havepermiso', 'Postulante.validar.solicitar')
                                                <a href="{{ route('trabajador.validar', $postulante->trabajador->id) }}" title="Validar"><i class="flaticon2-checkmark text-primary"></i></a>
                                            @endcan
                                        </td>
                                    @endif
                                    @if ( $postulante->trabajador->estado == 3 )
                                        <td>
                                            <span class="label label-warning label-inline mr-2">Validando</span>
                                        </td>
                                        <td>
                                            @can('havepermiso', 'Postulante.show')
                                                <a href="{{ route('postulante.show', $postulante->trabajador->id) }}" title="Ver"><i class="flaticon-eye text-primary"></i></a>
                                            @endcan
                                        </td>
                                    @endif
                                    @if ( $postulante->trabajador->estado == 4 )
                                        <td>
                                            <span class="label label-success label-inline mr-2">Aceptado</span>
                                        </td>
                                        <td>
                                            @can('havepermiso', 'Postulante.show')
                                                <a href="{{ route('postulante.show', $postulante->trabajador->id) }}" title="Ver"><i class="flaticon-eye text-primary"></i></a>
                                            @endcan
                                        </td>
                                    @endif
                                    @if ( $postulante->trabajador->estado == 5 )
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#mensaje" data-trabajador="{{ $postulante->trabajador->descripcion }}"><span class="label label-danger label-inline mr-2">Rechazado</span></a>
                                        </td>
                                        <td>
                                            @can('havepermiso', 'Postulante.edit')
                                                <a href="{{ route('postulante.edit', $postulante->trabajador->id) }}" title="Editar"><i class="flaticon2-pen text-primary"></i></a>
                                            @endcan
                                            @can('havepermiso', 'Postulante.show')
                                                <a href="{{ route('postulante.show', $postulante->trabajador->id) }}" title="Ver"><i class="flaticon-eye text-primary"></i></a>
                                            @endcan
                                            @can('havepermiso', 'Postulante.validar.solicitar')
                                                <a href="{{ route('trabajador.validar', $postulante->trabajador->id) }}" title="Validar"><i class="flaticon2-checkmark text-primary"></i></a>
                                            @endcan
                                            @can('havepermiso', 'Postulante.destroy')
                                                <a href="#" title="Eliminar" data-toggle="modal" data-target="#deleteTrabajador" data-trabajador="{{ $postulante->trabajador->id }}"><i class="flaticon2-trash text-primary"></i></a>
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
    @include('postulantes.modal.mensaje')
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
            $('#Table').DataTable({
                responsive: true
            });

        } );

        $('#deleteTrabajador').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var trabajador = button.data('trabajador');
            var modal = $(this);
            modal.find('.modal-body form').attr('action', '{{ route('postulante.destroy', '') }}');
            var action = $("#form-eliminar-postulante").attr('action') + '/' + trabajador;
            modal.find('.modal-body form').attr('action', action);
        });

        $('#mensaje').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var msg = button.data('trabajador');
            var modal = $(this);
            modal.find('.mensaje').text(msg);
        });
    </script>
@endsection
