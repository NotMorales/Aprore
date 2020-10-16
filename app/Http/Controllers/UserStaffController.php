<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmpresaStaffRequests;
use App\Models\Empresa;
use App\Models\Persona;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserStaffController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        //
    }

    public function create(Empresa $empresa) {
        Gate::authorize('havepermiso', 'Empresa.staff.create');

        return view('staff.create-empresa-staff', [
            'empresa' => $empresa,
            'persona' => new Persona,
        ]);
    }

    public function store(EmpresaStaffRequests $request, $empresa) {
        Gate::authorize('havepermiso', 'Empresa.staff.create');

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
                    'role_id'           => 3,
                    'persona_id'        => $idPersona,
                    'empresa_id'        => $empresa->id,
                    'name'              => $request['name'],
                    'email'             => $request['email'],
                    'password'          => Hash::make( $request['password'] )
                ]);

                DB::connection($empresa->data_base)->table('users')->insert([
                    'id'                => $idUser,
                    'role_id'           => 3,
                    'persona_id'        => $idPersona,
                    'empresa_id'        => $empresa->id,
                    'name'              => $request['name'],
                    'email'             => $request['email'],
                    'password'          => Hash::make( $request['password'] )
                ]);

                $idStaff = DB::connection('mysql')->table('staffs')->insertGetID([
                    'user_id'           => $idUser,
                    'empresa_id'        => $empresa->id,
                    'role_id'           => 3
                ]);

                DB::connection($empresa->data_base)->table('staffs')->insert([
                    'id'                => $idStaff,
                    'user_id'           => $idUser,
                    'empresa_id'        => $empresa->id,
                    'role_id'           => 3
                ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('empresa.show', $empresa)
                ->with('danger', "El elemento de Staff NO pudo crearse correctamente. Comunicarse con TI de Aprore.");
        }

        return redirect()->route('empresa.show', $empresa)
            ->with('success', "El elemento Staff fue creado correctamente.");
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

    public function assign(Empresa $empresa) {
        Gate::authorize('havepermiso', 'Empresa.staff.assign');

        //Tarea:
        //Filtrar, No debe salir, si ya pertenece
        $postulantes = Staff::where('empresa_id', '!=', $empresa->id)->groupBy('user_id')->get();

        return view('staff.assign-empresa-staff', [
            'empresa' => $empresa,
            'postulantes' => $postulantes
        ]);
    }
    public function assignStore(Request $request, Empresa $empresa) {
        Gate::authorize('havepermiso', 'Empresa.staff.assign');

        $request = $request->validate([
            'usuario' => 'required | numeric',
        ]);

        $empresa = Empresa::findOrFail( $empresa );
        $usuario = User::findOrFail( $request['usuario'] );
        $staffExist = Staff::where([ ['empresa_id', $empresa->id], ['user_id', $usuario->id] ])->first();

        if ($staffExist) {
            return redirect()->route('empresa.show', $empresa)
                ->with('danger', "El usuario Staff ya se encuentra asignado a esta empresa.");
        }

        try {
            DB::beginTransaction();

                $idStaff = DB::connection('mysql')->table('staffs')->insertGetID([
                    'user_id'           => $usuario->id,
                    'empresa_id'        => $empresa->id,
                    'role_id'           => 3
                ]);

                DB::connection($empresa->data_base)->table('staffs')->insert([
                    'id'                => $idStaff,
                    'user_id'           => $usuario->id,
                    'empresa_id'        => $empresa->id,
                    'role_id'           => 3
                ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('empresa.show', $empresa)
                ->with('danger', "El usuario Staff NO pudo asignarse correctamente. Comunicarse con TI de Aprore.");
        }

        return redirect()->route('empresa.show', $empresa)
            ->with('success', "El usuario Staff fue asignado correctamente.");
    }
}
