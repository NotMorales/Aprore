@extends('layouts.appNew')
@section('content')
    <x-subheader title="Postulantes" 
        :subheaders="[ ['href'=>'postulante.index', 'nombre'=>'Masivo'] ]"
        :acciones="[ ]">
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
                        <h3 class="card-label">Registro de Personal:
                        <span class="d-block text-info text-danger pt-2 font-size-sm">En caso de error, debera corregir su archivo.</span></h3>
                    </div>
                </div>
                <div class="card-body">
                    <!--begin: Datatable-->
                    <table  class="display responsive nowrap" width="100%"  id="myTable">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido Mat</th>
                                <th>Apellido Pat</th>
                                <th>Sexo</th>
                                <th>Telefono</th>
                                <th>Fecha Naciemiento</th>
                                <th>Correo</th>
                                <th>Curp</th>
                                <th>RFC</th>
                                <th>NSS</th>
                                <th>Calle</th>
                                <th>Colonia</th>
                                <th>Ciudad</th>
                                <th>Codigo Postal</th>
                                <th>Fecha Alta</th>
                                <th>Clabe bancaria</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($array as $key => $item)
                                @if ($key == 0) @continue @endif
                                @if ($item[0] != null && $item[1] != null)
                                    <tr class="">
                                        <td>{{ $item[0] }}</td>
                                        <td>{{ $item[1] }}</td>
                                        <td>{{ $item[2] }}</td>
                                        <td>{{ $item[3] }}</td>
                                        <td>{{ $item[4] }}</td>
                                        <td>
                                            @php
                                                $fecha = new \Carbon\Carbon('01-01-1900');
                                                $fecha = $fecha->addDays($item[5]-2)->format('Y-m-d')
                                            @endphp
                                            {{ $fecha }}
                                        </td>
                                        <td>{{ $item[6] }}</td>
                                        <td>{{ $item[7] }}</td>
                                        <td>{{ $item[8] }}</td>
                                        <td>{{ $item[9] }}</td>
                                        <td>{{ $item[10] }}</td>
                                        <td>{{ $item[11] }}</td>
                                        <td>{{ $item[12] }}</td>
                                        <td>{{ $item[13] }}</td>
                                        <td>
                                            @php
                                                $fecha = new \Carbon\Carbon('01-01-1900');
                                                $fecha = $fecha->addDays($item[14]-2)->format('Y-m-d')
                                            @endphp
                                            {{ $fecha }}
                                        </td>
                                        <td>{{ $item[15] }}</td>
                                    </tr>
                                @endif
                                
                            @endforeach
                        </tbody>
                    </table>
                    <!--end: Datatable-->
                </div>
                <form method="POST" action="{{ route('postulantemasivo.save') }}">
                    @csrf
                    <input type="hidden" name="file" value="{{ $file }}">
                    <input type="hidden" name="nombre" value="">
                    <input type="hidden" name="apellido_paterno" value="">
                    <input type="hidden" name="apellido_materno" value="">
                    <input type="hidden" name="sexo" value="">
                    <input type="hidden" name="telefono" value="">
                    <input type="hidden" name="fecha_nacimiento" value="">
                    <input type="hidden" name="email" value="">
                    <input type="hidden" name="curp" value="">
                    <input type="hidden" name="rfc" value="">
                    <input type="hidden" name="nss" value="">
                    <input type="hidden" name="calle" value="">
                    <input type="hidden" name="colonia" value="">
                    <input type="hidden" name="ciudad" value="">
                    <input type="hidden" name="codigo_postal" value="">
                    <input type="hidden" name="fecha_alta" value="">
                    <input type="hidden" name="clabe_bancaria" value="">
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">Continuar</button>
                        <a href="" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
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
