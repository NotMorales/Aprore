<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ValidacionSolicitada;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\PostulanteRequests;
use App\Http\Requests\InformacionRequests;
use App\Models\Empresa;
use App\Models\Persona;
use App\Models\User;
use App\Models\UserPriv;
use App\Models\Trabajador;
use App\Models\Staff;
use Carbon\Carbon;

class PostulanteController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        Gate::authorize('havepermiso', 'Postulante.index');

        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $postulantes = UserPriv::where([['empresa_id', $empresa->id], ['role_id', '6']])->get();

        return view('postulantes.index', [
            'postulantes'   => $postulantes,
            'empresa'       => $empresa
        ]);
    }

    public function create() {
        Gate::authorize('havepermiso', 'Postulante.create');

        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );

        return view('postulantes.create', [
            'empresa' => $empresa
        ]);
    }

    public function store(PostulanteRequests $request) {
        Gate::authorize('havepermiso', 'Postulante.create');

        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $request->validated();

        try {
            DB::beginTransaction();
                $idPersona = DB::connection('mysql')->table('personas')->insertGetID([
                    'nombre'            => $request['nombre'],
                    'apellido_paterno'  => $request['apellido_paterno'],
                    'apellido_materno'  => $request['apellido_materno'],
                    'sexo'              => $request['sexo'],
                    'telefono'          => $request['telefono'],
                    'fecha_nacimiento'  => $request['fecha_nacimiento']
                ]);

                DB::connection($empresa->data_base)->table('personas')->insert([
                    'id'                => $idPersona,
                    'nombre'            => $request['nombre'],
                    'apellido_paterno'  => $request['apellido_paterno'],
                    'apellido_materno'  => $request['apellido_materno'],
                    'sexo'              => $request['sexo'],
                    'telefono'          => $request['telefono'],
                    'fecha_nacimiento'  => $request['fecha_nacimiento']
                ]);

                $idUser = DB::connection('mysql')->table('users')->insertGetID([
                    'role_id'           => 6,
                    'persona_id'        => $idPersona,
                    'empresa_id'        => $empresa->id,
                    'name'              => $request['nombre'],
                    'email'             => $request['email'],
                    'password'          => Hash::make( 'Aprore-2020' )
                ]);

                DB::connection($empresa->data_base)->table('users')->insert([
                    'id'                => $idUser,
                    'role_id'           => 6,
                    'persona_id'        => $idPersona,
                    'empresa_id'        => $empresa->id,
                    'name'              => $request['nombre'],
                    'email'             => $request['email'],
                    'password'          => Hash::make( 'Aprore-2020' )
                ]);

                $idTrabajador = DB::connection($empresa->data_base)->table('trabajadores')->insertGetID([
                    'user_id'           => $idUser,
                    'estado'            => 0,
                    'visto_bueno'       => 0,
                ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('postulante.index')
                ->with('danger', "El Postulante NO pudo crearse correctamente. Comunicarse con TI de Aprore.");
        }
        return redirect()->route('postulante.informacion.create', $idTrabajador)
            ->with('success', "El Postulante fue creado correctamente.");
    }

    public function show($id) {
        Gate::authorize('havepermiso', 'Postulante.show');
        $postulante = Trabajador::findOrFail( $id );
        return view('postulantes.show', [
            'postulante' => $postulante
        ]);
    }

    public function edit($id) {
        Gate::authorize('havepermiso', 'Postulante.edit');
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $postulante = Trabajador::findOrFail( $id );
        if ($postulante->visto_bueno == 2){
            return redirect()->route('postulante.index')
                ->with('danger', "El Postulante no puede ser editado, Solicitar con TI el permiso.");
        }
        return view('postulantes.edit', [
            'empresa' => $empresa,
            'postulante' => $postulante
        ]);
    }

    public function update(PostulanteRequests $request, $id) {
        Gate::authorize('havepermiso', 'Postulante.edit');
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $postulante = Trabajador::findOrFail( $id );
        $request->validated();

        if ($postulante->visto_bueno == 2){
            return redirect()->route('postulante.index')
                ->with('danger', "El Postulante no puede ser editado, Solicitar con TI el permiso.");
        }

        try {
            DB::beginTransaction();
                DB::connection('mysql')->table('personas')->where('id', $postulante->user->persona->id)->update([
                    'nombre'            => $request['nombre'],
                    'apellido_paterno'  => $request['apellido_paterno'],
                    'apellido_materno'  => $request['apellido_materno'],
                    'sexo'              => $request['sexo'],
                    'telefono'          => $request['telefono'],
                    'fecha_nacimiento'  => $request['fecha_nacimiento']
                ]);

                DB::connection($empresa->data_base)->table('personas')->where('id', $postulante->user->persona->id)->update([
                    'nombre'            => $request['nombre'],
                    'apellido_paterno'  => $request['apellido_paterno'],
                    'apellido_materno'  => $request['apellido_materno'],
                    'sexo'              => $request['sexo'],
                    'telefono'          => $request['telefono'],
                    'fecha_nacimiento'  => $request['fecha_nacimiento']
                ]);

                DB::connection('mysql')->table('users')->where('id', $postulante->user->id)->update([
                    'email'             => $request['email']
                ]);

                DB::connection($empresa->data_base)->table('users')->where('id', $postulante->user->id)->update([
                    'email'             => $request['email']
                ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('postulante.index')
                ->with('danger', "El Postulante NO pudo editarse correctamente. Comunicarse con TI de Aprore.");
        }
        return redirect()->route('postulante.index')
            ->with('success', "El Postulante fue editado correctamente.");
    }

    public function destroy($id) {
        Gate::authorize('havepermiso', 'Postulante.destroy');
        $postulante = Trabajador::findOrFail( $id );
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $delete_at = Carbon::now()->toDateTimeString();
        try {
            DB::beginTransaction();
                DB::connection('mysql')->table('personas')->where('id', $postulante->user->persona->id)->update([
                    'deleted_at'    => $delete_at
                ]);
                DB::connection($empresa->data_base)->table('personas')->where('id', $postulante->user->persona->id)->update([
                    'deleted_at'    => $delete_at
                ]);
                DB::connection('mysql')->table('users')->where('id', $postulante->user_id)->update([
                    'deleted_at'    => $delete_at
                ]);
                DB::connection($empresa->data_base)->table('users')->where('id', $postulante->user_id)->update([
                    'deleted_at'    => $delete_at
                ]);
                DB::connection($empresa->data_base)->table('trabajadores')->where('id', $postulante->id)->update([
                    'deleted_at'    => $delete_at
                ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('postulante.index')
                ->with('danger', "El Postulante NO se pudo eliminar. Comunicarse con TI de Aprore.");
        }
        return redirect()->route('postulante.index')
            ->with('success', "El Postulante fue eliminado correctamente.");
    }


    public function validar($id) {
        Gate::authorize('havepermiso', 'Trabajador.show');
        $postulante = Trabajador::findOrFail( $id );
        // dd($postulante->user->empresa->nombre);
        return view('postulantes.validar', [
            'postulante' => $postulante
        ]);
    }
    public function validarSoli(Request $request) {
        $postulante = Trabajador::findOrFail( $request->trabajador );
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        // return  new ValidacionSolicitada($postulante);
        try {
            DB::beginTransaction();
                DB::connection($empresa->data_base)->table('trabajadores')->where('id', $postulante->id)->update([
                    'visto_bueno'   => 1,
                    'estado'        => 3,
                ]);

                //Enviar Correo
                    Mail::to('daniel@gmail.com')->queue(new ValidacionSolicitada($postulante));
                // $staffs = Staff::where('empresa_id', $empresa->id)-get();
                // foreach($staffs as $staff){
                // }

                // return  new ValidacionSolicitada($postulante);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('postulante.index')
                ->with('danger', "No fue posible solicitar la validación. Comunicarse con TI de Aprore.");
        }
        return redirect()->route('postulante.index')
            ->with('success', "La validacion fue solicitada correctamente.");
    }
    public function solicitudes() {
        $asignaciones = Trabajador::where('visto_bueno', 1)->count();
        return $asignaciones;
    }
    public function indexSoli() {
        Gate::authorize('havepermiso', 'Trabajador.validar.aprobar');
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $postulantes = Trabajador::where('visto_bueno', 1)->get();
        return view('postulantes.solicitud-index', [
            'postulantes' => $postulantes
        ]);
    }
    public function aprobarSoli($id) {
        Gate::authorize('havepermiso', 'Trabajador.show');
        $postulante = Trabajador::findOrFail( $id );
        return view('postulantes.solicitud-show', [
            'postulante' => $postulante
        ]);
    }

    public function solicitudAceptar(Request $request) {
        Gate::authorize('havepermiso', 'Trabajador.show');

        $request->validate([
            'trabajador'    => 'required | Numeric',
        ]);

        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $postulante = Trabajador::findOrFail( $request->trabajador );

        // return  new ValidacionSolicitada($postulante);
        try {
            DB::beginTransaction();
                DB::connection($empresa->data_base)->table('trabajadores')->where('id', $postulante->id)->update([
                    'visto_bueno'   => 2,
                    'estado'        => 4,
                ]);

                //Enviar Correo
                // $staffs = Staff::where('empresa_id', $empresa->id)-get();
                // foreach($staffs as $staff){
                //     Mail::to($staff->user->email)->queue(new ValidacionSolicitada($postulante));
                // }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('solicitudes.index')
                ->with('danger', "No fue posible aceptar la postulación. Comunicarse con TI de Aprore.");
        }
        return redirect()->route('solicitudes.index')
            ->with('success', "La aceptacion fue registrada correctamente.");
    }

    public function solicitudRechazo(Request $request) {
        Gate::authorize('havepermiso', 'Trabajador.show');
        $request->validate([
            'trabajador'    => 'required | Numeric',
            'motivoRechazo'   => 'required | max:10000 | min:1'
        ]);
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $postulante = Trabajador::findOrFail( $request->trabajador );
        // return  new ValidacionSolicitada($postulante);
        try {
            DB::beginTransaction();
                DB::connection($empresa->data_base)->table('trabajadores')->where('id', $postulante->id)->update([
                    'visto_bueno'   => 0,
                    'estado'        => 5,
                    'descripcion'   => $request->motivoRechazo
                ]);

                //Enviar Correo
                // $staffs = Staff::where('empresa_id', $empresa->id)-get();
                // foreach($staffs as $staff){
                //     Mail::to($staff->user->email)->queue(new ValidacionSolicitada($postulante));
                // }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('solicitudes.index')
                ->with('danger', "No fue posible Rechazar la postulación. Comunicarse con TI de Aprore.");
        }
        return redirect()->route('solicitudes.index')
            ->with('success', "El rechazo fue registrado correctamente.");
    }



}
