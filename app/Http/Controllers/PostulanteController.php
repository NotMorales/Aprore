<?php

namespace App\Http\Controllers;

use App\Mail\ValidacionSolicitada;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\PostulanteRequests;
use App\Models\Empresa;
use App\Models\UserPriv;
use App\Models\Trabajador;
use Carbon\Carbon;
use Illuminate\Support\Str;

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
                    'nombre'            => Str::upper( $request['nombre'] ),
                    'apellido_paterno'  => Str::upper( $request['apellido_paterno'] ),
                    'apellido_materno'  => Str::upper( $request['apellido_materno'] ),
                    'sexo'              => $request['sexo'],
                    'telefono'          => $request['telefono'],
                    'fecha_nacimiento'  => $request['fecha_nacimiento']
                ]);

                DB::connection($empresa->data_base)->table('personas')->insert([
                    'id'                => $idPersona,
                    'nombre'            => Str::upper( $request['nombre'] ),
                    'apellido_paterno'  => Str::upper( $request['apellido_paterno'] ),
                    'apellido_materno'  => Str::upper( $request['apellido_materno'] ),
                    'sexo'              => $request['sexo'],
                    'telefono'          => $request['telefono'],
                    'fecha_nacimiento'  => $request['fecha_nacimiento']
                ]);

                $idUser = DB::connection('mysql')->table('users')->insertGetID([
                    'role_id'           => 6,
                    'persona_id'        => $idPersona,
                    'empresa_id'        => $empresa->id,
                    'name'              => Str::upper( $request['nombre'] ),
                    'email'             => $request['email'],
                    'password'          => Hash::make( 'Aprore-2020' )
                ]);

                DB::connection($empresa->data_base)->table('users')->insert([
                    'id'                => $idUser,
                    'role_id'           => 6,
                    'persona_id'        => $idPersona,
                    'empresa_id'        => $empresa->id,
                    'name'              => Str::upper( $request['nombre'] ),
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
                    'nombre'            => Str::upper( $request['nombre'] ),
                    'apellido_paterno'  => Str::upper( $request['apellido_paterno'] ),
                    'apellido_materno'  => Str::upper( $request['apellido_materno'] ),
                    'sexo'              => $request['sexo'],
                    'telefono'          => $request['telefono'],
                    'fecha_nacimiento'  => $request['fecha_nacimiento']
                ]);

                DB::connection($empresa->data_base)->table('personas')->where('id', $postulante->user->persona->id)->update([
                    'nombre'            => Str::upper( $request['nombre'] ),
                    'apellido_paterno'  => Str::upper( $request['apellido_paterno'] ),
                    'apellido_materno'  => Str::upper( $request['apellido_materno'] ),
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


}
