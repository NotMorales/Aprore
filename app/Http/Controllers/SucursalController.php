<?php

namespace App\Http\Controllers;

use App\Http\Requests\SucursalRequests;
use App\Models\Area;
use App\Models\Empresa;
use App\Models\Sucursal;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class SucursalController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        Gate::authorize('havepermiso', 'Sucursal.index');

        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $sucursales = Sucursal::get();

        return view('contrato.sucursal.index', [
            'sucursales'   => $sucursales,
            'empresa'       => $empresa
        ]);
    }

    public function create() {
        Gate::authorize('havepermiso', 'Sucursal.create');

        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );

        return view('contrato.sucursal.create', [
            'empresa'       => $empresa
        ]);
    }

    public function store(SucursalRequests $request) {
        Gate::authorize('havepermiso', 'Sucursal.create');
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $request->validated();
        if (!PostulanteInformacionController::validate_rfc($request['rfc'])){
            return redirect()->route('sucursal.create')
                ->with('danger', "Utilizar una RFC valida.")
                ->withInput();
        }

        try {
            DB::beginTransaction();
                DB::connection($empresa->data_base)->table('sucursales')->insert([
                    'nombre'            => $request['nombre'],
                    'razon_social'      => $request['razon'],
                    'rfc'               => Str::upper( $request['rfc'] ),
                    'correo'            => $request['correo'],
                    'telefono'          => $request['telefono'],
                    'direccion'         => $request['direccion'],
                    'descripcion'       => $request['descripcion']
                ]);
            DB::commit();
        } catch (\Throwable $th) {
            return redirect()->route('sucursal.index')
                ->with('danger', "La sucursal no pudo crearse correctamente. Comunicarse con TI de Aprore.");
        }
        return redirect()->route('sucursal.index')
            ->with('success', "La sucursal fue creada correctamente.");
    }

    public function show(Sucursal $sucursal) {
        Gate::authorize('havepermiso', 'Sucursal.show');

        return view('contrato.sucursal.show', [
            'empresa'       => Empresa::findOrFail( Auth::user()->empresa_id ),
            'sucursal'      => Sucursal::findOrFail( $sucursal->id ),
            'areas'         => Area::where('sucursal_id', $sucursal->id)->get(),
        ]);
    }

    public function edit(Sucursal $sucursal) {
        Gate::authorize('havepermiso', 'Sucursal.edit');
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );

        return view('contrato.sucursal.edit', [
            'empresa'       => $empresa,
            'sucursal'      => $sucursal
        ]);
    }

    public function update(SucursalRequests $request, $sucursal) {
        Gate::authorize('havepermiso', 'Sucursal.edit');
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $sucursal = Sucursal::findOrFail($sucursal);
        $request->validated();

        if (!PostulanteInformacionController::validate_rfc($request['rfc'])){
            return redirect()->route('contrato.sucursal.edit', $sucursal)
                ->with('danger', "Utilizar un RFC valido.")
                ->withInput();
        }

        try {
            DB::beginTransaction();
            DB::connection($empresa->data_base)->table('sucursales')->where('id', $sucursal->id)->update([
                'nombre'            => $request['nombre'],
                'razon_social'      => $request['razon'],
                'rfc'               => Str::upper( $request['rfc'] ),
                'correo'            => $request['correo'],
                'telefono'          => $request['telefono'],
                'direccion'         => $request['direccion'],
                'descripcion'       => $request['descripcion']
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('sucursal.index')
                ->with('danger', "La sucursal no pudo editarse correctamente. Comunicarse con TI de Aprore.");
        }
        return redirect()->route('sucursal.index')
            ->with('success', "La sucursal fue editada correctamente.");
    }

    public function destroy($id) {
        //
    }
}
