@extends('layouts.appNew')
@section('content')
    <x-subheader title="Crear Contrato"
                 :subheaders="[  ]"
                 :acciones="[ ['href'=>'contrato.index', 'nombre'=>'Ver Contratos', 'permiso'=>'Contrato.index'] ]">
    </x-subheader>

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <x-sesiones></x-sesiones>
            <x-noticia>
                <x-slot name="svg">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="#000000" opacity="0.3"/>
                        <rect fill="#000000" x="11" y="9" width="2" height="7" rx="1"/>
                        <rect fill="#000000" x="11" y="17" width="2" height="2" rx="1"/>
                    </g>
                </x-slot>
                Los Contratos unicamente podran ser modificadas unicamente por Aprore. <br>
                <a href="https://www.facebook.com/luis.morales.velazquez/" target="_blank">Comunicarme con TI.</a>
            </x-noticia>
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Registro de Contrato</h3>
                </div>
                <!--begin::Form-->
                <form method="POST" action="{{ route('contrato.store') }}" autocomplete="off">
                    @csrf
                    <div class="card-body">
                        @if ( $errors->any() )
                            <x-errors></x-errors>
                        @endif

                        <div class="form-group">
                            <label for="nombre">Nombre: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" readonly="readonly" value="{{ old('nombre') }}" id="nombre" name="nombre" placeholder="Aprore" />
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Correo:</label>
                                <input type="email" class="form-control" placeholder="Enter full name"/>
                            </div>
                            <div class="col-lg-6">
                                <label>Telefono:</label>
                                <input type="email" class="form-control" placeholder="Enter contact number"/>
                            </div>
                        </div>

                        <div class="separator separator-dashed my-10"></div>

                        <div class="form-group row">
                            <div class="col-lg-8">
                                <label for="exampleSelect1">Tipo de Contrato: <span class="text-danger">*</span></label>
                                <select class="form-control" id="exampleSelect1">
                                    <option value="01">Contrato Tiempo Indeterminado</option>
                                    <option value="02">Obra Determinada</option>
                                    <option value="03">Tiempo Determinado</option>
                                    <option value="04">Trabajo por Temporada</option>
                                    <option value="05">Sujeto a Prueba</option>
                                    <option value="06">Capacitacion inicial</option>
                                    <option value="07">Por pago de Hora laborada</option>
                                    <option value="08">Comision Laboral</option>
                                    <option value="09">Trabajo donde no existe relacion de Trabajo</option>
                                    <option value="99">Otros</option>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label for="exampleSelect1">Periodo de Pago: <span class="text-danger">*</span></label>
                                <select class="form-control" id="exampleSelect1">
                                    <option value="">Semanal</option>
                                    <option value="">Quincenal</option>
                                    <option value="">Mensual</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label>Sueldo Diario Registrado:</label>
                                <input type="text" class="form-control"/>
                            </div>
                            <div class="col-lg-4">
                                <label>Sueldo Diario Fiscal:</label>
                                <input type="text" class="form-control"/>
                            </div>
                            <div class="col-lg-4">
                                <label>Sueldo Base de Cotizacion:</label>
                                <input type="text" class="form-control"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label for="exampleSelect1">Base de Cotizacion: <span class="text-danger">*</span></label>
                                <select class="form-control" id="exampleSelect1">
                                    <option value="F">Fijo</option>
                                    <option value="V">Variable</option>
                                    <option value="M">Mixto</option>
                                </select>
                            </div>
                            <div class="col-lg-8">
                                <label for="exampleSelect1">Sucursal: <span class="text-danger">*</span></label>
                                <select class="form-control" id="exampleSelect1">
                                    <option value=""></option>
                                    @foreach($sucursales as $sucursal)
                                        <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label for="exampleSelect1">Tipo de Empleado: <span class="text-danger">*</span></label>
                                <select class="form-control" id="exampleSelect1">
                                    <option value="C">Confianza</option>
                                    <option value="S">Sindicato</option>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label for="exampleSelect1">Turno Laboral: <span class="text-danger">*</span></label>
                                <select class="form-control" id="exampleSelect1">
                                    <option value="M">Matutino</option>
                                    <option value="V">Vespertino</option>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label for="exampleSelect1">Base Pago: <span class="text-danger">*</span></label>
                                <select class="form-control" id="exampleSelect1">
                                    <option value="S">Sueldo</option>
                                    <option value="E">Sueldo-Destajo</option>
                                    <option value="O">Sueldo-Comision</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label for="exampleSelect1">Metodo de Pago: <span class="text-danger">*</span></label>
                                <select class="form-control" id="exampleSelect1">
                                    <option value="01">Efectivo</option>
                                    <option value="02">Cheque</option>
                                    <option value="03">Transferencia</option>
                                    <option value="04">Tarjeta de Credito</option>
                                    <option value="05">Monedero Electronico</option>
                                    <option value="06">Dinero Electronico</option>
                                    <option value="08">Vales de Despensa</option>
                                    <option value="12">Dacion en Pago</option>
                                    <option value="13">Subrogacion</option>
                                    <option value="14">Consignacion</option>
                                    <option value="15">Condonacion</option>
                                    <option value="17">Compensacion</option>
                                    <option value="23">Novacion</option>
                                    <option value="24">Confusion</option>
                                    <option value="25">Remision de Deuda</option>

                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label for="exampleSelect1">Area: <span class="text-danger">*</span></label>
                                <select class="form-control" id="exampleSelect1">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label for="exampleSelect1">Seccion: <span class="text-danger">*</span></label>
                                <select class="form-control" id="exampleSelect1">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label for="exampleSelect1">Puesto: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control"/>
                            </div>
                            <div class="col-lg-4">
                                <label for="exampleSelect1">Alta: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="kt_datepicker_1" readonly placeholder="Select date"/>
                            </div>
                            <div class="col-lg-4">
                                <label for="exampleSelect1">Baja: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="kt_datepicker_2" readonly placeholder="Select date"/>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                        <button type="reset" class="btn btn-secondary">Cancelar</button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection

@section('head')

@endsection

@section('script')
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script>
        $("#kt_datepicker_1").datepicker({
            format: 'yyyy-mm-dd'
        });
        $("#kt_datepicker_2").datepicker({
            format: 'yyyy-mm-dd'
        });
    </script>
@endsection
