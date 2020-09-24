@extends('layouts.appNew')
@section('content')
    <x-subheader title="Empresa" 
        :subheaders="[ ['href'=>'empresa.index', 'nombre'=>'Inicio'], ['href'=>'empresa.index', 'nombre'=>'Ver'] ]"
        :acciones="[ ['href'=>'empresa.index', 'nombre'=>'Ver Empresas'] ]">
    </x-subheader>

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <x-sesiones></x-sesiones>
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">{{ $empresa->nombre }}</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row  mb-n4">
                        <div class="form-group col-lg-6">
                            <label for="direccion">Dirección de la Empresa:</label>
                            <input type="text" readonly="readonly" class="form-control" value="{{ $empresa->direccion }}" id="direccion" />
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="correo">Correo de la Empresa:</label>
                            <input type="email" readonly="readonly" class="form-control" value="{{ $empresa->correo }}" id="correo" />
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="contacto">Persona de contacto de la Empresa:</label>
                            <input type="text" readonly="readonly" class="form-control" value="{{ $empresa->contacto }}" id="contacto" />
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="c">Telefono de la Empresa:</label>
                            <input type="tel" readonly="readonly" class="form-control" value="{{ $empresa->telefono }}" id="telefonoEmp" />
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="rfc">RFC de la Empresa:</label>
                            <input type="text" readonly="readonly" class="form-control" value="{{ $empresa->rfc }}" id="rfc" />
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="data_base">Base de Datos de la Empresa:</label>
                            <input type="text" readonly="readonly" class="form-control" value="{{ $empresa->data_base }}" id="data_base" />
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home">Modulos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu0" id="staff">Administradores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu1" id="staff">Staffs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu2">Encargados</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu3">Secretarias</a>
                        </li>
                    </ul>
                    
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="home" class="container tab-pane active">
                            <div class="card card-custom gutter-b">
                                <div class="card-header flex-wrap py-3">
                                    <div class="card-title">
                                        <h3 class="card-label">Modulos Adquiridos:</h3>
                                    </div>
                                    <div class="card-toolbar">
                                        <x-boton class="btn-primary" title="Asignar Modulo">
                                            <x-slot name="svg">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                                                    <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
                                                </g>
                                            </x-slot>
                                            {{ route('empresa.index') }}
                                        </x-boton>
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
                                            @foreach ($modulos as $modulo)
                                                <tr>
                                                    <td>{{ $modulo->nombre }}</td>
                                                    <td>{{ $modulo->descripcion }}</td>
                                                    <td>
                                                        <a href="{{ route('empresa.show', $modulo) }}">Detalles</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="menu0" class="container tab-pane active"><br>
                            <div class="card card-custom gutter-b">
                                <div class="card-header flex-wrap py-3">
                                    <div class="card-title">
                                        <h3 class="card-label">Administradores:</h3>
                                    </div>
                                    <div class="card-toolbar">
                                        <x-boton class="btn-primary" title="Crear Administrador">
                                            <x-slot name="svg">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                                                    <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
                                                </g>
                                            </x-slot>
                                            {{ route('empresa.admin.create', $empresa) }}
                                        </x-boton>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="display responsive nowrap" width="100%" id="myTable1">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Correo</th>
                                                <th>Telefono</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($admins as $admin)
                                                <tr>
                                                    <td>{{ $admin->persona->nombre }} {{ $admin->persona->apellido_paterno }}</td>
                                                    <td>{{ $admin->email }}</td>
                                                    <td>{{ $admin->persona->telefono }}</td>
                                                    <td>
                                                        <a href="#" data-toggle="modal" data-target="#verPersona"
                                                        data-nombre="{{ $admin->persona->nombre }}" data-paterno="{{ $admin->persona->apellido_paterno }}"
                                                        data-sexo="{{ $admin->persona->sexo }}" data-materno="{{ $admin->persona->apellido_materno }}"
                                                        data-telefono="{{ $admin->persona->telefono }}" data-fecha="{{ $admin->persona->fecha_nacimiento }}"
                                                        data-name="{{ $admin->name }}" data-correo="{{ $admin->email }}"
                                                        data-foto="{{ $admin->profile_photo_path }}" 
                                                        >Ver</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>   
                        </div>
                        <div id="menu1" class="container tab-pane active"><br>
                            <div class="card card-custom gutter-b">
                                <div class="card-header flex-wrap py-3">
                                    <div class="card-title">
                                        <h3 class="card-label">Staff Aprore Asignado:</h3>
                                    </div>
                                    <div class="card-toolbar">
                                        <x-boton class="btn-primary" title="Crear Staff">
                                            <x-slot name="svg">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                                                    <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
                                                </g>
                                            </x-slot>
                                            {{ route('empresa.staff.create', $empresa) }}
                                        </x-boton>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="display responsive nowrap" width="100%" id="myTable2">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Correo</th>
                                                <th>Telefono</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($staffs as $staff)
                                                <tr>
                                                    <td>{{ $staff->persona->nombre }} {{ $staff->persona->apellido_paterno }}</td>
                                                    <td>{{ $staff->email }}</td>
                                                    <td>{{ $staff->persona->telefono }}</td>
                                                    <td>
                                                        <a href="#" data-toggle="modal" data-target="#verPersona"
                                                        data-nombre="{{ $staff->persona->nombre }}" data-paterno="{{ $staff->persona->apellido_paterno }}"
                                                        data-sexo="{{ $staff->persona->sexo }}" data-materno="{{ $staff->persona->apellido_materno }}"
                                                        data-telefono="{{ $staff->persona->telefono }}" data-fecha="{{ $staff->persona->fecha_nacimiento }}"
                                                        data-name="{{ $staff->name }}" data-correo="{{ $staff->email }}"
                                                        data-foto="{{ $staff->profile_photo_path }}" 
                                                        >Ver</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>    
                        </div>
                        <div id="menu2" class="container tab-pane active"><br>
                            <div class="card card-custom gutter-b">
                                <div class="card-header flex-wrap py-3">
                                    <div class="card-title">
                                        <h3 class="card-label">Encargados:</h3>
                                    </div>
                                    <div class="card-toolbar">
                                        <x-boton class="btn-primary" title="Crear Encargado">
                                            <x-slot name="svg">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                                                    <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
                                                </g>
                                            </x-slot>
                                            {{ route('empresa.encargado.create', $empresa) }}
                                        </x-boton>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="display responsive nowrap" width="100%" id="myTable3">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Correo</th>
                                                <th>Telefono</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($encargados as $encargado)
                                                <tr>
                                                    <td>{{ $encargado->persona->nombre }} {{ $encargado->persona->apellido_paterno }}</td>
                                                    <td>{{ $encargado->email }}</td>
                                                    <td>{{ $encargado->persona->telefono }}</td>
                                                    <td>
                                                        <a href="#" data-toggle="modal" data-target="#verPersona"
                                                        data-nombre="{{ $encargado->persona->nombre }}" data-paterno="{{ $encargado->persona->apellido_paterno }}"
                                                        data-sexo="{{ $encargado->persona->sexo }}" data-materno="{{ $encargado->persona->apellido_materno }}"
                                                        data-telefono="{{ $encargado->persona->telefono }}" data-fecha="{{ $encargado->persona->fecha_nacimiento }}"
                                                        data-name="{{ $encargado->name }}" data-correo="{{ $encargado->email }}"
                                                        data-foto="{{ $encargado->profile_photo_path }}" 
                                                        >Ver</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>   
                        </div>
                        <div id="menu3" class="container tab-pane active"><br>
                            <div class="card card-custom gutter-b">
                                <div class="card-header flex-wrap py-3">
                                    <div class="card-title">
                                        <h3 class="card-label">Secretarias:</h3>
                                    </div>
                                    <div class="card-toolbar">
                                        <x-boton class="btn-primary" title="Crear Secretaria">
                                            <x-slot name="svg">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                                                    <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
                                                </g>
                                            </x-slot>
                                            {{ route('empresa.secre.create', $empresa) }}
                                        </x-boton>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="display responsive nowrap" width="100%" id="myTable4">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Correo</th>
                                                <th>Telefono</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($secres as $secre)
                                                <tr>
                                                    <td>{{ $secre->persona->nombre }} {{ $secre->persona->apellido_paterno }}</td>
                                                    <td>{{ $secre->email }}</td>
                                                    <td>{{ $secre->persona->telefono }}</td>
                                                    <td>
                                                        <a href="#" data-toggle="modal" data-target="#verPersona"
                                                        data-nombre="{{ $secre->persona->nombre }}" data-paterno="{{ $secre->persona->apellido_paterno }}"
                                                        data-sexo="{{ $secre->persona->sexo }}" data-materno="{{ $secre->persona->apellido_materno }}"
                                                        data-telefono="{{ $secre->persona->telefono }}" data-fecha="{{ $secre->persona->fecha_nacimiento }}"
                                                        data-name="{{ $secre->name }}" data-correo="{{ $secre->email }}"
                                                        data-foto="{{ $secre->profile_photo_path }}" 
                                                        >Ver</a>
                                                    </td>
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
    @include('empresas.modal-ver-persona')

    <script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
    <script src="{{ asset('js/responsive.bootstrap4.min.js') }}" defer></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}" defer></script>
    <script>
        $('#verPersona').on('show.bs.modal', function (event) {
            var data = $(event.relatedTarget);
            var modal = $(this);
            modal.find('.nombre').text( data.data('nombre') + " " + data.data('paterno') + " " + data.data('materno') );
            modal.find('.modal-body input[name=sexo]').val( data.data('sexo') );
            modal.find('.modal-body input[name=telefono]').val( data.data('telefono') );
            modal.find('.modal-body input[name=fecha]').val( data.data('fecha') );
            modal.find('.modal-body input[name=name]').val( data.data('name') );
            modal.find('.modal-body input[name=email]').val( data.data('correo') );
            
        });
        
        $(document).ready( function () {
            $('#myTable0').DataTable({
                responsive: true
            });

            $('#myTable1').DataTable({
                responsive: true
            });

            $('#myTable2').DataTable({
                responsive: true
            });

            $('#myTable3').DataTable({
                responsive: true
            });

            $('#myTable4').DataTable({
                responsive: true
            });
            $('#menu0').addClass( "fade" );
            $('#menu1').addClass( "fade" );
            $('#menu2').addClass( "fade" );
            $('#menu3').addClass( "fade" );
            $('#menu0').removeClass( "active" );
            $('#menu1').removeClass( "active" );
            $('#menu2').removeClass( "active" );
            $('#menu3').removeClass( "active" );
        } );
    </script>
@endsection