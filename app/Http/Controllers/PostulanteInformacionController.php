<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\InformacionRequests;
use App\Models\Empresa;
use App\Models\Trabajador;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

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
        if (!$this::validate_curp($request['curp'])){
            return redirect()->route('postulante.informacion.create', $postulante->id)
                ->with('danger', "Utilizar una CURP valida.")
                ->withInput();
        }
        if (!$this::validate_rfc($request['rfc'])){
            return redirect()->route('postulante.informacion.create', $postulante->id)
                ->with('danger', "Utilizar un RFC valido.")
                ->withInput();
        }
        if (!$this::validate_nss($request['nss'])){
            return redirect()->route('postulante.informacion.create', $postulante->id)
                ->with('danger', "Utilizar un NSS valido.")
                ->withInput();
        }

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
        if (!$this::validate_curp($request['curp'])){
            return redirect()->route('informacion.edit', $postulante->id)
                ->with('danger', "Utilizar una CURP valida.")
                ->withInput();
        }
        if (!$this::validate_rfc($request['rfc'])){
            return redirect()->route('informacion.edit', $postulante->id)
                ->with('danger', "Utilizar un RFC valido.")
                ->withInput();
        }
        if (!$this::validate_nss($request['nss'])){
            return redirect()->route('informacion.edit', $postulante->id)
                ->with('danger', "Utilizar un NSS valido.")
                ->withInput();
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

    function validate_curp($valor) {
        if(Str::length($valor) == 18){
            $letras     = Str::substr($valor, 0, 4);
            $numeros    = Str::substr($valor, 4, 6);
            $sexo       = Str::substr($valor, 10, 1);
            $mxState    = Str::substr($valor, 11, 2);
            $letras2    = Str::substr($valor, 13, 3);
            $homoclave  = Str::substr($valor, 16, 2);
            if(ctype_alpha($letras) && ctype_alpha($letras2) && ctype_digit($numeros) && ctype_digit($homoclave) && $this::is_mx_state($mxState) && $this::is_sexo_curp($sexo)){
                return true;
            }
            return false;
        }else{
            return false;
        }
    }

    function is_mx_state($state){
        $mxStates = [
            'AS','BS','CL','CS','DF','GT',
            'HG','MC','MS','NL','PL','QR',
            'SL','TC','TL','YN','NE','BC',
            'CC','CM','CH','DG','GR','JC',
            'MN','NT','OC','QT','SP','SR',
            'TS','VZ','ZS'
        ];
        if(in_array(Str::upper($state), $mxStates)){
            return true;
        }
        return false;
    }

    function is_sexo_curp($sexo){
        $sexoCurp = ['H','M'];
        if(in_array(Str::upper($sexo), $sexoCurp)){
            return true;
        }
        return false;
    }

    function validate_rfc($valor) {
        if(Str::length($valor) == 13){
            $letras     = Str::substr($valor, 0, 4);
            $numeros    = Str::substr($valor, 4, 6);
            $letras2    = Str::substr($valor, 10, 2);
            $numeros2    = Str::substr($valor, 12, 1);
            if(ctype_alpha($letras) && ctype_alpha($letras2) && ctype_digit($numeros) && ctype_digit($numeros2)){
                return true;
            }
            return false;
        }else{
            return false;
        }
    }

    function validate_nss($valor) {
        if(Str::length($valor) == 11){
            $part1     = Str::substr($valor, 0, 2);
            $part2     = Str::substr($valor, 2, 2);
            $part3     = Str::substr($valor, 4, 2);
            $part4     = Str::substr($valor, 6, 5);
            if(ctype_digit($valor)){

                $anno     = Carbon::now()->format('Y') % 100;
                if($part1 != 97){
                    if ($part2 <= $anno) $part2 += 100;//134
                    if ($part3  <= $anno) $part3  += 100;//156
                    if ($part3  >  $part2)
                        return false; // Err: se dio de alta antes de nacer!
                }else{
                    return false;
                }
                return true;
            }
            return false;
        }else{
            return false;
        }
    }
}
