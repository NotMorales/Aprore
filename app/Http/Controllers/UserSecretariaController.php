<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmpresaStaffRequests;
use App\Models\Empresa;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserSecretariaController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        //
    }

    public function create(Empresa $empresa) {
        Gate::authorize('havepermiso', 'Empresa.secre.create');

        return view('staff.create-empresa-secre', [
            'empresa' => $empresa,
            'persona' => new Persona,
        ]);
    }

    public function store(EmpresaStaffRequests $request, Empresa $empresa)
    {
        Gate::authorize('havepermiso', 'Empresa.secre.create');

        $empresa = Empresa::findOrFail( $empresa );
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
                    'role_id'           => 5,
                    'persona_id'        => $idPersona,
                    'empresa_id'        => $empresa->id,
                    'name'              => $request['name'],
                    'email'             => $request['email'],
                    'password'          => Hash::make( $request['password'] )
                ]);

                DB::connection($empresa->data_base)->table('users')->insert([
                    'id'                => $idUser,
                    'role_id'           => 5,
                    'persona_id'        => $idPersona,
                    'empresa_id'        => $empresa->id,
                    'name'              => $request['name'],
                    'email'             => $request['email'],
                    'password'          => Hash::make( $request['password'] )
                ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('empresa.show', $empresa)
                ->with('danger', "El usuario Secretaria NO pudo crearse correctamente. Comunicarse con TI de Aprore.");
        }

        return redirect()->route('empresa.show', $empresa)
            ->with('success', "El usuario Secretaria fue creado correctamente.");
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $id) {
        //
    }

    public function destroy($id) {
        //
    }
}
