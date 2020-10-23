<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostulanteExpedienteController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        //
    }

    public function create($id) {
        Gate::authorize('havepermiso', 'Postulante.expediente.create');
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $postulante = Trabajador::findOrFail( $id );

        if ($postulante->visto_bueno == 2){
            return redirect()->route('postulante.index')
                ->with('danger', "El Postulante no puede ser editado, Solicitar con TI el permiso.");
        }

        if ($postulante->estado != 1) {
            return redirect()->route('postulante.expediente.edit', $postulante->id)
                ->with('danger', "El expediente ya fue creado.");
        }

        return view('postulantes.expediente.create', [
            'empresa' => $empresa,
            'postulante' => $postulante
        ]);
    }

    public function store(Request $request, $id) {
        Gate::authorize('havepermiso', 'Postulante.expediente.create');

        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $postulante = Trabajador::findOrFail( $id );
        $request->validate([
            'expediente'    => 'required | mimes:rar,zip,pdf| max:2048'
        ]);

        try {
            DB::beginTransaction();
                if( $request->file() ) {
                    $fileName = time().'_Expediente_'.$request->expediente->getClientOriginalName();
                    $filePath = $request->file('expediente');
                    Storage::disk('expediente')->put($fileName, File::get($filePath));

                    DB::connection($empresa->data_base)->table('trabajadores')->where('id', $postulante->id)->update([
                        'expediente_path'   => $fileName,
                        'estado'            => 2,
                    ]);
                }
            DB::commit();
        } catch (\Throwable $th) {
            return redirect()->route('postulante.index')
                ->with('danger', "El Expediente del Postulante No pudo ser guardado. Comunicarse con TI de Aprore.");
        }
        return redirect()->route('postulante.index')
            ->with('success', "El Expediente del Postulante fue agregado correctamente.");
    }

    public function show($id) {
        Gate::authorize('havepermiso', 'Postulante.edit');
        $postulante = Trabajador::findOrFail( $id );
        $file = Storage::disk('expediente')->url($postulante->expediente_path);
        return $file;
    }

    public function edit($id) {
        Gate::authorize('havepermiso', 'Postulante.edit');
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $postulante = Trabajador::findOrFail( $id );

        if ($postulante->expediente_path == null){
            return redirect()->route('postulante.expediente.create')
                ->with('danger', "El Postulante no debe crear su Expediente.");
        }

        return view('postulantes.expediente.edit', [
            'empresa' => $empresa,
            'postulante' => $postulante
        ]);
    }

    public function update(Request $request, $id) {
        Gate::authorize('havepermiso', 'Postulante.edit');
        $request->validate([
            'expediente'    => 'required | mimes:rar,zip,pdf|max:2048'
        ]);
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $postulante = Trabajador::findOrFail( $id );

        try {
            DB::beginTransaction();
            if( $request->file() ) {
                $fileName = time().'_Expediente_'.$request->expediente->getClientOriginalName();
                $filePath = $request->file('expediente');
                Storage::disk('expediente')->put($fileName, File::get($filePath));

                DB::connection($empresa->data_base)->table('trabajadores')->where('id', $postulante->id)->update([
                    'expediente_path'   => $fileName,
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('postulante.index')
                ->with('danger', "El Expediente del Postulante Fallo. Comunicarse con TI de Aprore.");
        }
        return redirect()->route('postulante.index')
            ->with('success', "El Expediente del Postulante fue editado correctamente.");
    }

    public function destroy($id) {
        //
    }
}
