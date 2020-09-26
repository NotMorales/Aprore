@extends('layouts.appNew')
@section('content')
    <x-subheader title="Empresas" 
        :subheaders="[ ['href'=>'empresa.index', 'nombre'=>'Inicio'], ['href'=>'empresa.index', 'nombre'=>'Asignar'], ['href'=>'empresa.index', 'nombre'=>'Staff'] ]"
        :acciones="[]">
    </x-subheader>

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Asignacion Usuario Staff</h3>
                </div>
                @if ( count( $postulantes ) == 0 )
                    <div class="card-body">
                        <x-alerta class="alert-light-danger">
                            No existen Usuarios para poder asignar.
                        </x-alerta>
                    </div>    
                    <div class="card-footer">
                        <a href="{{ route('empresa.show', $empresa) }}" class="btn btn-danger">Salir</a>
                    </div>
                @else
                    <!--begin::Form-->
                    <form method="POST" action="{{ route('empresa.staff.assignStore') }}" autocomplete="off">
                        @csrf
                        <input type="hidden" name="empresa" value="{{$empresa->id}}">
                        <div class="card-body">
                            @if ( $errors->any() )
                                <x-errors></x-errors>
                            @endif

                            <div class="form-group">
                                <label for="usuario">Usuarios de Aprore: <span class="text-danger">*</span></label>
                                <select class="form-control  @error('usuario') is-invalid @enderror" id="usuario" name="usuario">
                                    <option value="">Selecciona el usuario</option>
                                    @foreach ($postulantes as $postulante)
                                        <option value="{{ $postulante->user->id }}">{{ $postulante->user->persona->nombre }} {{ $postulante->user->persona->apellido_paterno }} {{ $postulante->user->persona->apellido_materno }}</option>  
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mr-2">Asignar</button>
                            <button type="reset" class="btn btn-secondary">Cancelar</button>
                        </div>
                    </form>
                    <!--end::Form-->
                @endif
                
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection
    
@section('head')

@endsection

@section('script')

@endsection
