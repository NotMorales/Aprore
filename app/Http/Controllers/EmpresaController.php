<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmpresaRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Empresa;
use App\Models\EmpresaPriv;
use App\Models\Role;
use App\Models\Modulo;
use App\Models\User;


class EmpresaController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        Gate::authorize('havepermiso', 'empresa.index');
        return view('empresas.index', [
            'empresas' => Empresa::get()
        ]);
    }

    public function create() {
        Gate::authorize('havepermiso', 'empresa.create');
        return view('empresas.create', [
            'empresa' => new Empresa()
        ]);
    }

    public function store(EmpresaRequests $request) {
        Gate::authorize('havepermiso', 'empresa.create');

        $request->validated();

        try {
            DB::beginTransaction();
                $idEmpresa = DB::connection('mysql')->table('empresas')->insertGetID([
                    'nombre'        => $request['nombre'],
                    'direccion'     => $request['direccion'],
                    'correo'        => $request['correo'],
                    'contacto'      => $request['contacto'],
                    'telefono'      => $request['telefono'],
                    'rfc'           => $request['rfc'],
                    'data_base'     => $request['data_base']
                ]);

                $empresa = Empresa::find($idEmpresa);
                
                DB::connection($empresa->data_base)->table('empresas')->insert([
                    'id'            => $idEmpresa,
                    'nombre'        => $request['nombre'],
                    'direccion'     => $request['direccion'],
                    'correo'        => $request['correo'],
                    'contacto'      => $request['contacto'],
                    'telefono'      => $request['telefono'],
                    'rfc'           => $request['rfc'],
                    'data_base'     => $request['data_base']
                ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('empresa.index')
                ->with('danger', "La empresa no pudo crearse correctamente. Verifique que la BD sea creada previamente.");
        }
        
        return redirect()->route('empresa.index')
            ->with('success', "Empresa creada correctamente.");
    }

    public function show(Empresa $empresa) {
        Gate::authorize('havepermiso', 'empresa.show');

        return view('empresas.show', [
            'empresa' => $empresa,
            'modulos' => Auth::user()->empresaPriv->modulos,
            'staffs'  => Empresa::find($empresa->id)->staffs,
            'admins'   => User::where([ ['empresa_id', $empresa->id], ['role_id', '3'] ])->get(),
            'secres'   => User::where([ ['empresa_id', $empresa->id], ['role_id', '4'] ])->get()
        ]);
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
