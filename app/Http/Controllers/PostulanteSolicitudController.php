<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class PostulanteSolicitudController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function index($th) {
        Gate::authorize('havepermiso', 'Postulante.solicitud.index');
        Empresa::findOrFail( Auth::user()->empresa_id );
        $postulantes = Trabajador::where('visto_bueno', 1)->get();
        return view('postulantes.solicitud.index', [
            'postulantes' => $postulantes
        ]);
    }

    public function create($id) {
        Gate::authorize('havepermiso', 'Postulante.solicitud.create');
        $postulante = Trabajador::findOrFail( $id );
        return view('postulantes.solicitud.create', [
            'postulante' => $postulante
        ]);
    }

    public function store(Request $request, $id) {
        Gate::authorize('havepermiso', 'Postulante.solicitud.create');
        $postulante = Trabajador::findOrFail( $id );
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );

        try {
            DB::beginTransaction();
                DB::connection($empresa->data_base)->table('trabajadores')->where('id', $postulante->id)->update([
                    'visto_bueno'   => 1,
                    'estado'        => 3,
                ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('postulante.index')
                ->with('danger', "No fue posible solicitar la validación. Comunicarse con TI de Aprore.");
        }
        //Enviar Correo
        Mail::to('daniel@gmail.com')->queue(new ValidacionSolicitada($postulante));
        // $staffs = Staff::where('empresa_id', $empresa->id)-get();
        // foreach($staffs as $staff){
        // }
        return redirect()->route('postulante.index')
            ->with('success', "La validacion fue solicitada correctamente.");
    }

    public function show($id) {
        Gate::authorize('havepermiso', 'Postulante.solicitud.show');
        $postulante = Trabajador::findOrFail( $id );
        return view('postulantes.solicitud.show', [
            'postulante' => $postulante
        ]);
    }

    public function edit($id) {
        Gate::authorize('havepermiso', 'Postulante.solicitud.edit');
        $postulante = Trabajador::findOrFail( $id );
        return view('postulantes.solicitud.show', [
            'postulante' => $postulante
        ]);
    }

    public function update(Request $request, $id) {
        Gate::authorize('havepermiso', 'Postulante.solicitud.edit');
        $postulante = Trabajador::findOrFail( $id );
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $mensaje = "";

        if($postulante->visto_bueno != 1) {
            return redirect()->route('postulante.solicitud.index', 'ver')
                ->with('danger', "Ocurrio un error. Comunicarse con TI de Aprore.");
        }

        if( $request['do'] == 0 ){
            $request->validate([
                'motivoRechazo'   => 'required | max:10000 | min:1'
            ]);
            try {
                DB::beginTransaction();
                    DB::connection($empresa->data_base)->table('trabajadores')->where('id', $postulante->id)->update([
                        'visto_bueno'   => 0,
                        'estado'        => 5,
                        'descripcion'   => $request->motivoRechazo
                    ]);

                    //Enviar Correo
                    // $staffs = Staff::where('empresa_id', $empresa->id)-get();
                    // foreach($staffs as $staff){
                    //     Mail::to($staff->user->email)->queue(new ValidacionSolicitada($postulante));
                    // }

                DB::commit();
                $mensaje = "El rechazo fue registrado correctamente.";
            } catch (\Throwable $th) {
                DB::rollBack();
                return redirect()->route('postulante.solicitud.index', 'ver')
                    ->with('danger', "No fue posible Rechazar la postulación. Comunicarse con TI de Aprore.");
            }
        }elseif ($request['do'] == 1 ){
            try {
                DB::beginTransaction();
                    DB::connection($empresa->data_base)->table('trabajadores')->where('id', $postulante->id)->update([
                        'visto_bueno'   => 2,
                        'estado'        => 4,
                    ]);
                DB::commit();
                $mensaje = "La aceptacion fue registrada correctamente.";
            } catch (\Throwable $th) {
                DB::rollBack();
                return redirect()->route('postulante.solicitud.index', 'ver')
                    ->with('danger', "No fue posible aceptar la postulación. Comunicarse con TI de Aprore.");
            }
        }else{
            return redirect()->route('postulante.solicitud.index', 'ver')
                ->with('danger', "Algo salio mal. Comunicarse con TI de Aprore.");
        }

        return redirect()->route('postulante.solicitud.index', 'ver')
            ->with('success', $mensaje);
    }

    public function destroy($id) {
        //
    }

    public function solicitudes() {
        $asignaciones = Trabajador::where('visto_bueno', 1)->count();
        return $asignaciones;
    }
}
