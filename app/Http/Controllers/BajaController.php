<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\BajaRequests;
use App\Models\Baja;
use App\Models\Empresa;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BajaController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function all() {
        Gate::authorize('havepermiso', 'Baja.index');

        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $bajas = Baja::all();

        return view('bajas.index', [
            'bajas'         => $bajas,
            'empresa'       => $empresa
        ]);
    }

    public function index() {

    }

    public function select() {
        Gate::authorize('havepermiso', 'Baja.create');

        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $trabajadores = Trabajador::orWhere('estado', 4)
            ->orWhere('estado', 6)->get();

        return view('bajas.select', [
            'trabajadores'  => $trabajadores,
            'empresa'       => $empresa
        ]);
    }

    public function create($trabajador) {
        Gate::authorize('havepermiso', 'Baja.create');

        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $trabajador = Trabajador::findOrFail($trabajador);

        return view('bajas.create', [
            'trabajador'  => $trabajador,
            'empresa'       => $empresa
        ]);
    }

    public function store(BajaRequests $request, $trabajador) {
        Gate::authorize('havepermiso', 'Baja.create');

        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $trabajador = Trabajador::findOrFail($trabajador);
        $request->validated();

        try {
            DB::beginTransaction();
                if( $request->file() ) {
                    $fileName = time().'_Baja_'.$request->expediente->getClientOriginalName();
                    $filePath = $request->file('expediente');
                    Storage::disk('baja')->put($fileName, File::get($filePath));
                    DB::connection($empresa->data_base)->table('bajas')->insert([
                        'trabajador_id'     => $trabajador->id,
                        'tipo_baja'         => $request['tipo'],
                        'fecha_baja'        => $request['fecha_baja'],
                        'mensaje'           => $request['mensaje'],
                        'doc_renuncia_patch'=> $fileName,
                        'estado'            => 0,
                        'visto_bueno'       => 0
                    ]);
                }
            DB::commit();
        }catch (\Throwable $throwable) {
            DB::rollBack();
            return redirect()->route('baja.index')
                ->with('danger', "El Trabajador no pudo ser dado de Baja. Comunicarse con TI de Aprore.");
        }
        return redirect()->route('baja.index')
            ->with('success', "Fue solicitada la baja del trabajador.");
    }

    public function show($baja) {
        Gate::authorize('havepermiso', 'Baja.create');

        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $baja = Baja::findOrFail($baja);

        return view('bajas.show', [
            'baja'          => $baja,
            'empresa'       => $empresa
        ]);
    }

    public function edit($baja) {
        Gate::authorize('havepermiso', 'Baja.edit');

        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $baja = Baja::findOrFail($baja);

        return view('bajas.edit', [
            'baja'          => $baja,
            'empresa'       => $empresa
        ]);
    }

    public function update(BajaRequests $request, $baja) {
        Gate::authorize('havepermiso', 'Baja.edit');

        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $baja = Baja::findOrFail($baja);
        $request->validated();

        try {
            DB::beginTransaction();
                if( $request->file() ) {
                    $request->validate([
                        'expediente'    => 'required | mimes:rar,zip,pdf| max:2048'
                    ]);
                    $fileName = time().'_Baja_'.$request->expediente->getClientOriginalName();
                    $filePath = $request->file('expediente');
                    Storage::disk('baja')->put($fileName, File::get($filePath));
                }else {
                    $fileName = $baja->doc_renuncia_patch;
                }
                DB::connection($empresa->data_base)->table('bajas')->where('id', $baja->id)->update([
                    'tipo_baja'         => $request['tipo'],
                    'fecha_baja'        => $request['fecha_baja'],
                    'mensaje'           => $request['mensaje'],
                    'doc_renuncia_patch'=> $fileName,
                    'estado'            => 0,
                    'visto_bueno'       => 0
                ]);
            DB::commit();
        }catch (\Throwable $throwable) {
            DB::rollBack();
            return redirect()->route('baja.index')
                ->with('danger', "El Trabajador no pudo ser dado de Baja. Comunicarse con TI de Aprore.");
        }
        return redirect()->route('baja.index')
            ->with('success', "Fue solicitada la baja del trabajador.");
    }

    public function destroy($id) {
        //
    }
}
