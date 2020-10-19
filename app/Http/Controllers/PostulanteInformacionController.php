<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\InformacionRequests;
use App\Models\Empresa;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PostulanteInformacionController extends Controller {

    public function index() {
        //
    }

    public function create($id) {
        Gate::authorize('havepermiso', 'Postulante.informacion.create');
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $postulante = Trabajador::findOrFail( $id);

        if ($postulante->visto_bueno == 2){
            return redirect()->route('postulante.index')
                ->with('danger', "El Postulante no puede ser editado, Solicitar con TI el permiso.");
        }

        if ($postulante->estado != 0) {
            return redirect()->route('postulante.informacion.edit', $postulante->id)
                ->with('danger', "La informacion ya fue creada.");
        }

        return view('postulantes.informacion.create', [
            'empresa' => $empresa,
            'postulante' => $postulante
        ]);
    }

    public function store(InformacionRequests $request, $id) {
        Gate::authorize('havepermiso', 'Postulante.informacion.create');
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $postulante = Trabajador::findOrFail( $id);
        $request->validated();

        if ($postulante->visto_bueno == 2){
            return redirect()->route('postulante.index')
                ->with('danger', "El Postulante no puede ser editado, Solicitar con TI el permiso.");
        }

        if ($postulante->estado != 0) {
            return redirect()->route('postulante.informacion.edit', $postulante->id)
                ->with('danger', "La informacion ya fue creada.");
        }

        try {
            DB::beginTransaction();
                DB::connection($empresa->data_base)->table('trabajadores')->where('id', $postulante->id)->update([
                    'curp'              => $request['curp'],
                    'rfc'               => $request['rfc'],
                    'nss'               => $request['nss'],
                    'calle'             => $request['calle'],
                    'colonia'           => $request['colonia'],
                    'ciudad'            => $request['ciudad'],
                    'codigo_postal'     => $request['codigo_postal'],
                    'fecha_alta'        => $request['fecha_alta'],
                    'estado'            => 1,
                    'clabe_bancaria'    => $request['clabe_bancaria']
                ]);
            DB::commit();
        } catch (\Throwable $th) {
            return redirect()->route('postulante.index')
                ->with('danger', "El Postulante NO pudo editarse correctamente. Comunicarse con TI de Aprore.");
        }
        return redirect()->route('postulante.expediente.create', $postulante->id)
            ->with('success', "El Trabajador fue Actualizado correctamente.");
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        Gate::authorize('havepermiso', 'Postulante.edit');
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $postulante = Trabajador::findOrFail( $id );
        return view('postulantes.informacion.edit', [
            'empresa' => $empresa,
            'postulante' => $postulante
        ]);
    }

    public function update(InformacionRequests $request, $id) {
        Gate::authorize('havepermiso', 'Postulante.edit');
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $postulante = Trabajador::findOrFail( $id);
        $request->validated();

        if ($postulante->visto_bueno == 2){
            return redirect()->route('postulante.index')
                ->with('danger', "El Postulante no puede ser editado, Solicitar con TI el permiso.");
        }

        try {
            DB::beginTransaction();
                DB::connection($empresa->data_base)->table('trabajadores')->where('id', $postulante->id)->update([
                    'curp'              => $request['curp'],
                    'rfc'               => $request['rfc'],
                    'nss'               => $request['nss'],
                    'calle'             => $request['calle'],
                    'colonia'           => $request['colonia'],
                    'ciudad'            => $request['ciudad'],
                    'codigo_postal'     => $request['codigo_postal'],
                    'fecha_alta'        => $request['fecha_alta'],
                    'clabe_bancaria'    => $request['clabe_bancaria']
                ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('postulante.index')
                ->with('danger', "El Trabajador NO pudo editarse correctamente. Comunicarse con TI de Aprore.");
        }
        return redirect()->route('postulante.index')
            ->with('success', "El Trabajador fue editado correctamente.");
    }

    public function destroy($id) {
        //
    }
}
