<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpresaStaffRequests;
use App\Models\Empresa;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

    }

    public function create(Empresa $empresa) {
        Gate::authorize('havepermiso', 'Empresa.admin.create');

        return view('staff.create-empresa-admin', [
            'empresa' => $empresa,
            'persona' => new Persona,
        ]);
    }

    public function store(EmpresaStaffRequests $request, $empresa) {
        Gate::authorize('havepermiso', 'Empresa.admin.create');

        $empresa = Empresa::findOrFail($empresa);
        $request->validated();

        try {
            DB::beginTransaction();

                $idPersona = DB::connection('mysql')->table('personas')->insertGetID([
                    'nombre' => $request['nombre'],
                    'apellido_paterno' => $request['apellido_paterno'],
                    'apellido_materno' => $request['apellido_materno'],
                    'sexo' => $request['sexo'],
                    'telefono' => $request['telefono'],
                    'fecha_nacimiento' => $request['fecha_nacimiento']
                ]);

                DB::connection($empresa->data_base)->table('personas')->insert([
                    'id' => $idPersona,
                    'nombre' => $request['nombre'],
                    'apellido_paterno' => $request['apellido_paterno'],
                    'apellido_materno' => $request['apellido_materno'],
                    'sexo' => $request['sexo'],
                    'telefono' => $request['telefono'],
                    'fecha_nacimiento' => $request['fecha_nacimiento']
                ]);

                $idUser = DB::connection('mysql')->table('users')->insertGetID([
                    'role_id' => 2,
                    'persona_id' => $idPersona,
                    'empresa_id' => $empresa->id,
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password'])
                ]);

                DB::connection($empresa->data_base)->table('users')->insert([
                    'id' => $idUser,
                    'role_id' => 2,
                    'persona_id' => $idPersona,
                    'empresa_id' => $empresa->id,
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password'])
                ]);

                $idStaff = DB::connection('mysql')->table('staffs')->insertGetID([
                    'user_id' => $idUser,
                    'empresa_id' => $empresa->id,
                    'role_id' => 2
                ]);

                DB::connection($empresa->data_base)->table('staffs')->insert([
                    'id' => $idStaff,
                    'user_id' => $idUser,
                    'empresa_id' => $empresa->id,
                    'role_id' => 2
                ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('empresa.show', $empresa)
                ->with('danger', "El usuario Administrador NO pudo crearse correctamente. Comunicarse con TI de Aprore.");
        }

        return redirect()->route('empresa.show', $empresa)
            ->with('success', "El usuario Administrador fue creado correctamente.");
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
