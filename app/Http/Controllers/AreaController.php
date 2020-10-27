<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AreaRequests;
use App\Models\Area;
use App\Models\Empresa;
use App\Models\Seccion;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class AreaController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        //
    }

    public function create(Sucursal  $sucursal) {
        Gate::authorize('havepermiso', 'Area.create');

        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );

        return view('contrato.area.create', [
            'empresa'       => $empresa,
            'sucursal'      => $sucursal
        ]);
    }

    public function store(AreaRequests $request, Sucursal $sucursal) {
        Gate::authorize('havepermiso', 'Area.create');
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $request->validated();

        try {
            DB::beginTransaction();
                DB::connection($empresa->data_base)->table('areas')->insert([
                    'sucursal_id'       => $sucursal->id,
                    'nombre'            => $request['nombre'],
                    'descripcion'       => $request['descripcion']
                ]);
            DB::commit();
        } catch (\Throwable $th) {
            return redirect()->route('sucursal.show', $sucursal)
                ->with('danger', "El Area no pudo crearse correctamente. Comunicarse con TI de Aprore.");
        }
        return redirect()->route('sucursal.show', $sucursal)
            ->with('success', "El Area fue creada correctamente.");
    }

    public function show(Area $area) {
        Gate::authorize('havepermiso', 'Area.show');

        return view('contrato.area.show', [
            'empresa'       => Empresa::findOrFail( Auth::user()->empresa_id ),
            'sucursal'      => Sucursal::findOrFail( $area->sucursal_id ),
            'area'          => $area,
            'secciones'     => Seccion::where('area_id', $area->id)->get()
        ]);
    }

    public function edit(Area $area) {
        Gate::authorize('havepermiso', 'Area.edit');
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );

        return view('contrato.area.edit', [
            'empresa'       => $empresa,
            'area'          => $area,
            'sucursal'      => Sucursal::findOrFail( $area->sucursal_id )
        ]);
    }

    public function update(AreaRequests $request, Area $area) {
        Gate::authorize('havepermiso', 'Area.edit');
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $request->validated();

        try {
            DB::beginTransaction();
                DB::connection($empresa->data_base)->table('areas')->where('id', $area->id)->update([
                    'nombre'            => $request['nombre'],
                    'descripcion'       => $request['descripcion']
                ]);
            DB::commit();
        } catch (\Throwable $th) {
            return redirect()->route('sucursal.show', $area->sucursal_id)
                ->with('danger', "El Area no pudo editarse correctamente. Comunicarse con TI de Aprore.");
        }
        return redirect()->route('sucursal.show', $area->sucursal_id)
            ->with('success', "El Area fue Editada correctamente.");
    }

    public function destroy($id) {
        //
    }
}
