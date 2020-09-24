@extends('layouts.appNew')
@section('content')
    <x-subheader title="Empresas" 
        :subheaders="[ ['href'=>'empresa.index', 'nombre'=>'Inicio'], ['href'=>'empresa.index', 'nombre'=>'Crear'], ['href'=>'empresa.index', 'nombre'=>'Admin'] ]"
        :acciones="[]">
    </x-subheader>

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Registro Usuario Encargado</h3>
                </div>
                <!--begin::Form-->
                <form method="POST" action="{{ route('empresa.encargado.store') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="empresa" value="{{$empresa->id}}">
                    <div class="card-body">
                        @if ( $errors->any() )
                            <x-errors></x-errors>
                        @endif
                        <div class="form-group">
                            <label for="nombre">Nombre: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $persona->nombre) }}" id="nombre" name="nombre" placeholder="Luis Antonio" />
                        </div>

                        <div class="form-group">
                            <label for="apellido_paterno">Apellido Paterno: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('apellido_paterno') is-invalid @enderror" value="{{ old('apellido_paterno', $persona->apellido_paterno) }}" id="apellido_paterno" name="apellido_paterno" placeholder="Morales" />
                        </div>

                        <div class="form-group">
                            <label for="apellido_materno">Apellido Materno: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('apellido_materno') is-invalid @enderror" value="{{ old('apellido_materno', $persona->apellido_materno) }}" id="apellido_materno" name="apellido_materno" placeholder="Velazquez" />
                        </div>

                        <div class="form-group">
                            <label for="sexo">Sexo <span class="text-danger">*</span> </label>
                            <select class="form-control @error('sexo') is-invalid @enderror" id="sexo" name="sexo">
                                <option value="Masculino" {{ old('sexo') == $persona->sexo ? ' selected' : ''}}>Hombre</option>
                                <option value="Femenino" {{ old('sexo') == $persona->sexo ? ' selected' : ''}}>Mujer</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="telefono">Telefono: <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono', $persona->telefono) }}" id="telefono" name="telefono" placeholder="9211479791" />
                        </div>

                        <div class="form-group">
                            <label for="kt_datepicker_1">Fecha de Nacimiento: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('fecha_nacimiento') is-invalid @enderror" value="{{ old('fecha_nacimiento') }}" id="kt_datepicker_1" name="fecha_nacimiento" readonly="readonly" placeholder="24/10/1999" />
                        </div>

                        <div class="form-group">
                            <label for="name">Nombre Usuario: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="name" name="name" placeholder="Luis Morales" />
                        </div>

                        <div class="form-group">
                            <label for="email">Correo Electronico: <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" name="email" placeholder="morales.lamv@gmail.com" />
                        </div>

                        <div class="form-group">
                            <label for="password">Contraseña: <span class="text-danger">*</span></label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" id="password" name="password" placeholder="********" />
                                <div class="input-group-addon">
                                    <a href="" class="btn btn-secondary"><i class="far fa-eye-slash"></i></a> <!-- far fa-eye-slash -->
                                </div>
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
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_password input').attr("type") == "text"){
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass( "fa-eye-slash" );
                    $('#show_hide_password i').removeClass( "fa-eye" );
                }else if($('#show_hide_password input').attr("type") == "password"){
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass( "fa-eye-slash" );
                    $('#show_hide_password i').addClass( "fa-eye" );
                }
            });
        });
    </script>
@endsection
