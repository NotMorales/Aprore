<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Baja;
use App\Models\Empresa;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class BajaSolicitudController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function solicitudes() {
        $asignaciones = Baja::where('estado', 0)->count();
        return $asignaciones;
    }

    public function index() {
        Gate::authorize('havepermiso', 'Baja.solicitud.index');

        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $bajas = Baja::where('estado', 0)->get();

        return view('bajas.solicitud.index', [
            'bajas'         => $bajas,
            'empresa'       => $empresa
        ]);
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        //
    }

    public function show($baja) {
        Gate::authorize('havepermiso', 'Baja.solicitud.show');

        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $baja = Baja::findOrFail($baja);

        return view('bajas.solicitud.show', [
            'baja'         => $baja,
            'empresa'       => $empresa
        ]);
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $baja) {
        Gate::authorize('havepermiso', 'Baja.solicitud.edit');
        $baja = Baja::findOrFail( $baja );
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $mensaje = "";

        if($baja->visto_bueno != 0) {
            return redirect()->route('baja.solicitudbaja.index', 'ver')
                ->with('danger', "Ocurrio un error. Comunicarse con TI de Aprore.");
        }

        if( $request['do'] == 0 ){
            $request->validate([
                'motivoRechazo'   => 'required | max:10000 | min:1'
            ]);
            try {
                DB::beginTransaction();
                DB::connection($empresa->data_base)->table('bajas')->where('id', $baja->id)->update([
                    'visto_bueno'   => 0,
                    'estado'        => 1,
                    'descripcion'   => $request->motivoRechazo
                ]);

                //Enviar Correo
                // $staffs = Staff::where('empresa_id', $empresa->id)-get();
                // foreach($staffs as $staff){
                //     Mail::to($staff->user->email)->queue(new ValidacionSolicitada($postulante));
                // }

                DB::commit();
                $mensaje = "El rechazo de la Baja fue registrado correctamente.";
            } catch (\Throwable $th) {
                DB::rollBack();
                return redirect()->route('baja.solicitudbaja.index', 'ver')
                    ->with('danger', "No fue posible Rechazar la baja. Comunicarse con TI de Aprore.");
            }
        }elseif ($request['do'] == 1 ){
            try {
                DB::beginTransaction();
                DB::connection($empresa->data_base)->table('bajas')->where('id', $baja->id)->update([
                    'visto_bueno'   => 1,
                    'estado'        => 2,
                ]);
                DB::commit();
                $mensaje = "La aceptacion de la baja fue registrada correctamente.";
            } catch (\Throwable $th) {
                DB::rollBack();
                return redirect()->route('baja.solicitudbaja.index', 'ver')
                    ->with('danger', "No fue posible aceptar la baja. Comunicarse con TI de Aprore.");
            }
        }else{
            return redirect()->route('baja.solicitudbaja.index', 'ver')
                ->with('danger', "Algo salio mal. Comunicarse con TI de Aprore.");
        }

        return redirect()->route('baja.solicitudbaja.index', 'ver')
            ->with('success', $mensaje);
    }

    public function destroy($id) {
        //
    }
}
