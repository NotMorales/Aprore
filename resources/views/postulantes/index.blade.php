@extends('layouts.appNew')
@section('content')
    <x-subheader title="Postulantes" 
        :subheaders="[ ['href'=>'postulante.index', 'nombre'=>'Inicio'] ]"
        :acciones="[ ['href'=>'postulante.create', 'nombre'=>'Crear Postulante', 'permiso'=>'Trabajador.create'] ]">
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
                        <span class="d-block text-muted pt-2 font-size-sm">Listado de empresas, relacionadas con aprore.</span></h3>
                    </div>
                    <div class="card-toolbar">
                        {{-- <x-boton class="btn-primary" title="exportar">
                            <x-slot name="svg">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M17,8 C16.4477153,8 16,7.55228475 16,7 C16,6.44771525 16.4477153,6 17,6 L18,6 C20.209139,6 22,7.790861 22,10 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,9.99305689 C2,7.7839179 3.790861,5.99305689 6,5.99305689 L7.00000482,5.99305689 C7.55228957,5.99305689 8.00000482,6.44077214 8.00000482,6.99305689 C8.00000482,7.54534164 7.55228957,7.99305689 7.00000482,7.99305689 L6,7.99305689 C4.8954305,7.99305689 4,8.88848739 4,9.99305689 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,10 C20,8.8954305 19.1045695,8 18,8 L17,8 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                    <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 8.000000) scale(1, -1) rotate(-180.000000) translate(-12.000000, -8.000000) " x="11" y="2" width="2" height="12" rx="1"/>
                                    <path d="M12,2.58578644 L14.2928932,0.292893219 C14.6834175,-0.0976310729 15.3165825,-0.0976310729 15.7071068,0.292893219 C16.0976311,0.683417511 16.0976311,1.31658249 15.7071068,1.70710678 L12.7071068,4.70710678 C12.3165825,5.09763107 11.6834175,5.09763107 11.2928932,4.70710678 L8.29289322,1.70710678 C7.90236893,1.31658249 7.90236893,0.683417511 8.29289322,0.292893219 C8.68341751,-0.0976310729 9.31658249,-0.0976310729 9.70710678,0.292893219 L12,2.58578644 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 2.500000) scale(1, -1) translate(-12.000000, -2.500000) "/>
                                </g>
                            </x-slot>
                            {{ route('empresa.index') }}
                        </x-boton> --}}
                    </div>
                </div>
                <div class="card-body">
                    <!--begin: Datatable-->
                    <table class="table display" id="myTable">
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
                                            @can('havepermiso', 'Trabajador.informacion.create')
                                                <a href="{{ route('informacion.create', $postulante->trabajador->id) }}" title="Completar"><i class="flaticon2-pen text-primary"></i></a>
                                            @endcan
                                            @can('havepermiso', 'Trabajador.show')
                                                <a href="{{ route('postulante.show', $postulante->trabajador->id) }}" title="Ver"><i class="flaticon-eye text-primary"></i></a>
                                            @endcan
                                            @can('havepermiso', 'Trabajador.destroy')
                                                <a href="#" title="Eliminar" data-toggle="modal" data-target="#deleteTrabajador" data-trabajador="{{ $postulante->trabajador->id }}"><i class="flaticon2-trash text-primary"></i></a>
                                            @endcan
                                        </td>
                                    @endif
                                    @if ( $postulante->trabajador->estado == 1 )
                                        <td>
                                            <span class="label label-info label-inline mr-2">Registrado</span>
                                        </td>
                                        <td>
                                            @can('havepermiso', 'Trabajador.show')
                                                <a href="{{ route('postulante.show', $postulante->trabajador->id) }}" title="Ver"><i class="flaticon-eye text-primary"></i></a>
                                            @endcan
                                            <a href="{{ route('expediente.create', $postulante->trabajador->id) }}" title="Expediente"><i class="flaticon2-document text-primary"></i></a>
                                            @can('havepermiso', 'Trabajador.destroy')
                                                <a href="#" title="Eliminar" data-toggle="modal" data-target="#deleteTrabajador" data-trabajador="{{ $postulante->trabajador->id }}"><i class="flaticon2-trash text-primary"></i></a>
                                            @endcan
                                        </td>
                                    @endif
                                    @if ( $postulante->trabajador->estado == 2 )
                                        <td>
                                            <span class="label label-primary label-inline mr-2">Completo</span>
                                        </td>
                                        <td>
                                            @can('havepermiso', 'Trabajador.edit')
                                                <a href="{{ route('postulante.edit', $postulante->trabajador->id) }}" title="Editar"><i class="flaticon2-pen text-primary"></i></a>
                                            @endcan
                                            @can('havepermiso', 'Trabajador.show')
                                                <a href="{{ route('postulante.show', $postulante->trabajador->id) }}" title="Ver"><i class="flaticon-eye text-primary"></i></a>
                                            @endcan
                                            @can('havepermiso', 'Trabajador.validar.solicitar')
                                                <a href="{{ route('trabajador.validar', $postulante->trabajador->id) }}" title="Validar"><i class="flaticon2-checkmark text-primary"></i></a>
                                            @endcan  
                                            @can('havepermiso', 'Trabajador.destroy')
                                                <a href="#" title="Eliminar" data-toggle="modal" data-target="#deleteTrabajador" data-trabajador="{{ $postulante->trabajador->id }}"><i class="flaticon2-trash text-primary"></i></a>
                                            @endcan                                          
                                        </td>
                                    @endif
                                    @if ( $postulante->trabajador->estado == 3 )
                                        <td>
                                            <span class="label label-warning label-inline mr-2">Validando</span>
                                        </td>
                                        <td>
                                            @can('havepermiso', 'Trabajador.show')
                                                <a href="{{ route('postulante.show', $postulante->trabajador->id) }}" title="Ver"><i class="flaticon-eye text-primary"></i></a>
                                            @endcan
                                        </td>
                                    @endif
                                    @if ( $postulante->trabajador->estado == 4 )
                                        <td>
                                            <span class="label label-success label-inline mr-2">Aceptado</span>
                                        </td>
                                    @endif
                                    @if ( $postulante->trabajador->estado == 5 )
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#mensaje" data-trabajador="{{ $postulante->trabajador->descripcion }}"><span class="label label-danger label-inline mr-2">Rechazado</span></a>
                                        </td>
                                        <td>
                                            @can('havepermiso', 'Trabajador.edit')
                                                <a href="{{ route('postulante.edit', $postulante->trabajador->id) }}" title="Editar"><i class="flaticon2-pen text-primary"></i></a>
                                            @endcan
                                            @can('havepermiso', 'Trabajador.show')
                                                <a href="{{ route('postulante.show', $postulante->trabajador->id) }}" title="Ver"><i class="flaticon-eye text-primary"></i></a>
                                            @endcan
                                            @can('havepermiso', 'Trabajador.validar.solicitar')
                                                <a href="{{ route('trabajador.validar', $postulante->trabajador->id) }}" title="Validar"><i class="flaticon2-checkmark text-primary"></i></a>
                                            @endcan  
                                            @can('havepermiso', 'Trabajador.destroy')
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
    <div class="modal fade" id="mensaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Postulante Rechazado:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Mensaje:</h4>
                    <p class="mensaje"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
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
        $('#deleteTrabajador').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var trabajador = button.data('trabajador');
            var modal = $(this);
            modal.find('.modal-body input[name=trabajador]').val(trabajador);
        });
        $('#mensaje').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var msg = button.data('trabajador');
            var modal = $(this);
            modal.find('.mensaje').text(msg);
        });
        $(document).ready( function () {
            $('#myTable').DataTable({
                responsive: true
            });
            
        } );
    </script>
@endsection
