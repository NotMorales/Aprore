<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\Persona;
use App\Models\Staff;
use App\Models\User;
use App\Http\Requests\EmpresaStaffRequests;

class StaffController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function staffCreate(Empresa $empresa) {
        Gate::authorize('havepermiso', 'Empresa.staff.create');

        return view('staff.create-empresa-staff', [
            'empresa' => $empresa,
            'persona' => new Persona,
        ]);
    }

    public function staffStore(EmpresaStaffRequests $request) {
        Gate::authorize('havepermiso', 'Empresa.staff.create');
        
        $empresa = Empresa::findOrFail( $request['empresa'] );        
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

    public function staffAssign(Empresa $empresa) {
        Gate::authorize('havepermiso', 'Empresa.staff.assign');

        //Tarea:
        //Filtrar, No debe salir, si ya pertenece
        $postulantes = Staff::where('empresa_id', '!=', $empresa->id)->groupBy('user_id')->get();

        return view('staff.assign-empresa-staff', [
            'empresa' => $empresa,
            'postulantes' => $postulantes
        ]);
    }

    public function staffAssignStore(Request $request) {
        Gate::authorize('havepermiso', 'Empresa.staff.assign');
        
        $request = $request->validate([
            'empresa' => 'required | numeric',
            'usuario' => 'required | numeric',
        ]);
        
        $empresa = Empresa::findOrFail( $request['empresa'] );
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

    public function adminCreate(Empresa $empresa) {
        Gate::authorize('havepermiso', 'Empresa.admin.create');

        return view('staff.create-empresa-admin', [
            'empresa' => $empresa,
            'persona' => new Persona,
        ]);
    }

    public function adminStore(EmpresaStaffRequests $request)
    {
        Gate::authorize('havepermiso', 'Empresa.admin.create');
        
        $empresa = Empresa::findOrFail( $request['empresa'] );        
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
                    'role_id'           => 2,
                    'persona_id'        => $idPersona,
                    'empresa_id'        => $empresa->id,
                    'name'              => $request['name'],
                    'email'             => $request['email'],
                    'password'          => Hash::make( $request['password'] )
                ]);

                DB::connection($empresa->data_base)->table('users')->insert([
                    'id'                => $idUser,
                    'role_id'           => 2,
                    'persona_id'        => $idPersona,
                    'empresa_id'        => $empresa->id,
                    'name'              => $request['name'],
                    'email'             => $request['email'],
                    'password'          => Hash::make( $request['password'] )
                ]);

                $idStaff = DB::connection('mysql')->table('staffs')->insertGetID([
                    'user_id'           => $idUser,
                    'empresa_id'        => $empresa->id,
                    'role_id'           => 2
                ]);

                DB::connection($empresa->data_base)->table('staffs')->insert([
                    'id'                => $idStaff,
                    'user_id'           => $idUser,
                    'empresa_id'        => $empresa->id,
                    'role_id'           => 2
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

    public function encargadoCreate(Empresa $empresa) {
        Gate::authorize('havepermiso', 'Empresa.encargado.create');

        return view('staff.create-empresa-encargado', [
            'empresa' => $empresa,
            'persona' => new Persona,
        ]);
    }

    public function encargadoStore(EmpresaStaffRequests $request)
    {
        Gate::authorize('havepermiso', 'Empresa.encargado.create');
        
        $empresa = Empresa::findOrFail( $request['empresa'] );        
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
                    'role_id'           => 4,
                    'persona_id'        => $idPersona,
                    'empresa_id'        => $empresa->id,
                    'name'              => $request['name'],
                    'email'             => $request['email'],
                    'password'          => Hash::make( $request['password'] )
                ]);

                DB::connection($empresa->data_base)->table('users')->insert([
                    'id'                => $idUser,
                    'role_id'           => 4,
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
                ->with('danger', "El usuario Encargado NO pudo crearse correctamente. Comunicarse con TI de Aprore.");
        }
        
        return redirect()->route('empresa.show', $empresa)
            ->with('success', "El usuario Encargado fue creado correctamente.");
    }

    public function secreCreate(Empresa $empresa) {
        Gate::authorize('havepermiso', 'Empresa.secre.create');

        return view('staff.create-empresa-secre', [
            'empresa' => $empresa,
            'persona' => new Persona,
        ]);
    }

    public function secreStore(EmpresaStaffRequests $request)
    {
        Gate::authorize('havepermiso', 'Empresa.secre.create');
        
        $empresa = Empresa::findOrFail( $request['empresa'] );        
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

    public function index() {
        //
    }
    
    public function create() {
        //
    }

    public function store(Request $request) {
        //
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
