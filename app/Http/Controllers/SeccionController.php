<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeccionRequests;
use App\Models\Area;
use App\Models\Empresa;
use App\Models\Seccion;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class SeccionController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

    }

    public function create(Area $area) {
        Gate::authorize('havepermiso', 'Seccion.create');

        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );

        return view('contrato.seccion.create', [
            'empresa'       => $empresa,
            'sucursal'      => Sucursal::findOrFail( $area->sucursal_id),
            'area'          => $area
        ]);
    }

    public function store(SeccionRequests $request, Area $area) {
        Gate::authorize('havepermiso', 'Seccion.create');
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $request->validated();

        try {
            DB::beginTransaction();
                DB::connection($empresa->data_base)->table('secciones')->insert([
                    'area_id'           => $area->id,
                    'nombre'            => $request['nombre'],
                    'descripcion'       => $request['descripcion']
                ]);
            DB::commit();
        } catch (\Throwable $th) {
            return redirect()->route('area.show', $area)
                ->with('danger', "La Seccion no pudo crearse correctamente. Comunicarse con TI de Aprore.");
        }
        return redirect()->route('area.show', $area)
            ->with('success', "La Seccion fue creada correctamente.");
    }

    public function show($id) {
        //
    }

    public function edit(Seccion $seccion) {
        Gate::authorize('havepermiso', 'Seccion.edit');
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );

        return view('contrato.seccion.edit', [
            'empresa'       => $empresa,
            'seccion'       => $seccion
        ]);
    }

    public function update(SeccionRequests $request, Seccion $seccion) {
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
