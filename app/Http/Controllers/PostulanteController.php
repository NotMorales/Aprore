<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ValidacionSolicitada;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\PostulanteRequests;
use App\Http\Requests\InformacionRequests;
use App\Models\Empresa;
use App\Models\Persona;
use App\Models\User;
use App\Models\UserPriv;
use App\Models\Trabajador;
use App\Models\Staff;
use Carbon\Carbon;

class PostulanteController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        Gate::authorize('havepermiso', 'Trabajador.index');
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $postulantes = UserPriv::where([['empresa_id', $empresa->id], ['role_id', '6']])->get();
        return view('postulantes.index', [
            'postulantes' => $postulantes
        ]);
    }
 
    public function create() {
        Gate::authorize('havepermiso', 'Trabajador.create');
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        return view('postulantes.create', [
            'empresa' => $empresa
        ]);
    }
 
    public function store(PostulanteRequests $request) {
        Gate::authorize('havepermiso', 'Trabajador.create');
        $empresa = Empresa::findOrFail( $request['empresa'] );        
        $request->validated();

        try {
            DB::beginTransaction();
                $idPersona = DB::connection('mysql')->table('personas')->insertGetID([
                    'nombre'            => $request['nombre'],
                    'apellido_paterno'  => $request['apellido_paterno'],
                    'apellido_materno'  => $request['apellido_materno'],
                    'sexo'              => $request['sexo'],
                    'telefono'          => $request['telefono'],
                    'fecha_nacimiento'  => $request['fecha_nacimiento']
                ]);
                
                DB::connection($empresa->data_base)->table('personas')->insert([
                    'id'                => $idPersona,
                    'nombre'            => $request['nombre'],
                    'apellido_paterno'  => $request['apellido_paterno'],
                    'apellido_materno'  => $request['apellido_materno'],
                    'sexo'              => $request['sexo'],
                    'telefono'          => $request['telefono'],
                    'fecha_nacimiento'  => $request['fecha_nacimiento']
                ]);

                $idUser = DB::connection('mysql')->table('users')->insertGetID([
                    'role_id'           => 6,
                    'persona_id'        => $idPersona,
                    'empresa_id'        => $empresa->id,
                    'name'              => $request['nombre'],
                    'email'             => $request['email'],
                    'password'          => Hash::make( 'Aprore-2020' )
                ]);

                DB::connection($empresa->data_base)->table('users')->insert([
                    'id'                => $idUser,
                    'role_id'           => 6,
                    'persona_id'        => $idPersona,
                    'empresa_id'        => $empresa->id,
                    'name'              => $request['nombre'],
                    'email'             => $request['email'],
                    'password'          => Hash::make( 'Aprore-2020' )
                ]);

                $idTrabajador = DB::connection($empresa->data_base)->table('trabajadores')->insertGetID([
                    'user_id'           => $idUser,
                    'estado'            => 0,
                    'visto_bueno'       => 0,
                ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('postulante.index')
                ->with('danger', "El Trabajador NO pudo crearse correctamente. Comunicarse con TI de Aprore.");
        }
        return redirect()->route('informacion.create', $idTrabajador)
            ->with('success', "El Trabajador fue creado correctamente.");
    }

    public function inforCreate($trabajador) {
        Gate::authorize('havepermiso', 'Trabajador.informacion.create');
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $postulante = Trabajador::findOrFail( $trabajador);
        if ($postulante->estado != 0 || $postulante->visto_bueno != 0) {
            return redirect()->route('postulante.index')
                ->with('danger', "Algo ocurrio mal. Comunicarse con TI de Aprore.");
        }
        return view('postulantes.informacion', [
            'empresa' => $empresa,
            'postulante' => $postulante
        ]);
    }

    public function inforStore(InformacionRequests $request) {
        Gate::authorize('havepermiso', 'Trabajador.informacion.create');

        $request->validated();
        $empresa = Empresa::findOrFail( $request['empresa'] );  
        $postulante = Trabajador::findOrFail( $request['postulante'] );     

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
                ->with('danger', "El Trabajador NO pudo editarse correctamente. Comunicarse con TI de Aprore.");
        }
        return redirect()->route('expediente.create', $postulante->id)
            ->with('success', "El Trabajador fue Actualizado correctamente.");
    }

    public function expeCreate($trabajador) {
        Gate::authorize('havepermiso', 'Trabajador.expediente.create');
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $postulante = Trabajador::findOrFail( $trabajador);
        if ($postulante->estado != 1 || $postulante->visto_bueno != 0) {
            return redirect()->route('postulante.index')
                ->with('danger', "Algo ocurrio mal. Comunicarse con TI de Aprore.");
        }
        return view('postulantes.expediente', [
            'empresa' => $empresa,
            'postulante' => $postulante
        ]);
    }
    public function expeStore(Request $request) {
        Gate::authorize('havepermiso', 'Trabajador.expediente.create');

        $request->validate([
            'empresa'       => 'required | Numeric',
            'postulante'    => 'required | Numeric',
            'expediente'    => 'required | mimes:rar,zip,pdf|max:2048'
        ]);

        $empresa = Empresa::findOrFail( $request['empresa'] );  
        $postulante = Trabajador::findOrFail( $request['postulante'] );   

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
                ->with('danger', "El Expediente del Trabajador Fallo. Comunicarse con TI de Aprore.");
        }
        return redirect()->route('postulante.index')
            ->with('success', "El Expediente del Trabajador fue subido correctamente.");
    }
 
    public function show($id) {
        Gate::authorize('havepermiso', 'Trabajador.show');
        $postulante = Trabajador::findOrFail( $id );     
        return view('postulantes.show', [
            'postulante' => $postulante
        ]);
    }
 
    public function edit($id) {
        Gate::authorize('havepermiso', 'Trabajador.edit');
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $postulante = Trabajador::findOrFail( $id );     
        return view('postulantes.edit', [
            'empresa' => $empresa,
            'postulante' => $postulante
        ]);
    }
 
    public function update(Request $request, $id) {
        Gate::authorize('havepermiso', 'Trabajador.edit');
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $postulante = Trabajador::findOrFail( $id );     

        $request->validate([
            'nombre'            => 'required | String | max:255',
            'apellido_paterno'  => 'required | String | max:255',
            'apellido_materno'  => 'required | String | max:255',
            'sexo'              => 'required | String | max:255',
            'telefono'          => 'required | Numeric',
            'fecha_nacimiento'  => 'required | Date',
            'email'             => 'required | Email | max:255 | unique:users,email,'.$postulante->user->id,
        ]);
        
        if ($postulante->visto_bueno != 0) {
            return redirect()->route('postulante.index')
                ->with('danger', "Algo ocurrio mal. Comunicarse con TI de Aprore.");
        }

        try {
            DB::beginTransaction();
                DB::connection('mysql')->table('personas')->where('id', $postulante->user->persona->id)->update([
                    'nombre'            => $request['nombre'],
                    'apellido_paterno'  => $request['apellido_paterno'],
                    'apellido_materno'  => $request['apellido_materno'],
                    'sexo'              => $request['sexo'],
                    'telefono'          => $request['telefono'],
                    'fecha_nacimiento'  => $request['fecha_nacimiento']
                ]);
                
                DB::connection($empresa->data_base)->table('personas')->where('id', $postulante->user->persona->id)->update([
                    'nombre'            => $request['nombre'],
                    'apellido_paterno'  => $request['apellido_paterno'],
                    'apellido_materno'  => $request['apellido_materno'],
                    'sexo'              => $request['sexo'],
                    'telefono'          => $request['telefono'],
                    'fecha_nacimiento'  => $request['fecha_nacimiento']
                ]);

                DB::connection('mysql')->table('users')->where('id', $postulante->user->id)->update([
                    'email'             => $request['email']
                ]);

                DB::connection($empresa->data_base)->table('users')->where('id', $postulante->user->id)->update([
                    'email'             => $request['email']
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
 
    public function inforEdit($id) {
        Gate::authorize('havepermiso', 'Trabajador.edit');
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $postulante = Trabajador::findOrFail( $id );     
        return view('postulantes.informacion-edit', [
            'empresa' => $empresa,
            'postulante' => $postulante
        ]);
    }
    
    public function inforUpdate(Request $request, $id) {
        Gate::authorize('havepermiso', 'Trabajador.edit');
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $postulante = Trabajador::findOrFail( $id );     

        $request->validate([
            'curp'              => 'required | String | max:18',
            'rfc'               => 'required | String | max:15',
            'nss'               => 'required | Numeric',
            'calle'             => 'required | String | max:255',
            'colonia'           => 'required | String | max:255',
            'ciudad'            => 'required | String | max:255',
            'codigo_postal'     => 'required | Numeric',
            'fecha_alta'        => 'required | Date',
            'clabe_bancaria'    => ''
        ]);
        
        if ($postulante->visto_bueno != 0) {
            return redirect()->route('postulante.index')
                ->with('danger', "Algo ocurrio mal. Comunicarse con TI de Aprore.");
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

    public function expeEdit($id) {
        Gate::authorize('havepermiso', 'Trabajador.edit');
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $postulante = Trabajador::findOrFail( $id );    
        return view('postulantes.expediente-edit', [
            'empresa' => $empresa,
            'postulante' => $postulante
        ]);
    }

    public function expeUpdate(Request $request, $id)
    {
        Gate::authorize('havepermiso', 'Trabajador.edit');
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
                ->with('danger', "El Expediente del Trabajador Fallo. Comunicarse con TI de Aprore.");
        }
        return redirect()->route('postulante.index')
            ->with('success', "El Expediente del Trabajador fue editado correctamente.");
    }
    
    public function expeshow($id) {
        Gate::authorize('havepermiso', 'Trabajador.edit');
        $postulante = Trabajador::findOrFail( $id );     
        $file = Storage::disk('expediente')->url($postulante->expediente_path);
        return $file;
    }

    public function destroy(Request $request) {
        Gate::authorize('havepermiso', 'Trabajador.destroy');
        $postulante = Trabajador::findOrFail( $request->trabajador );
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $delete_at = Carbon::now()->toDateTimeString();
        try {
            DB::beginTransaction();
                DB::connection('mysql')->table('personas')->where('id', $postulante->user->persona->id)->update([
                    'deleted_at'    => $delete_at
                ]);
                DB::connection($empresa->data_base)->table('personas')->where('id', $postulante->user->persona->id)->update([
                    'deleted_at'    => $delete_at
                ]);
                DB::connection('mysql')->table('users')->where('id', $postulante->user_id)->update([
                    'deleted_at'    => $delete_at
                ]);
                DB::connection($empresa->data_base)->table('users')->where('id', $postulante->user_id)->update([
                    'deleted_at'    => $delete_at
                ]);
                DB::connection($empresa->data_base)->table('trabajadores')->where('id', $postulante->id)->update([
                    'deleted_at'    => $delete_at
                ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('postulante.index')
                ->with('danger', "El Postulante NO se pudo eliminar. Comunicarse con TI de Aprore.");
        }
        return redirect()->route('postulante.index')
            ->with('success', "El Postulante fue eliminado correctamente.");
    }
    public function validar($id) {
        Gate::authorize('havepermiso', 'Trabajador.show');
        $postulante = Trabajador::findOrFail( $id );     
        // dd($postulante->user->empresa->nombre);
        return view('postulantes.validar', [
            'postulante' => $postulante
        ]);
    }
    public function validarSoli(Request $request) {
        $postulante = Trabajador::findOrFail( $request->trabajador );
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        // return  new ValidacionSolicitada($postulante);
        try {
            DB::beginTransaction();
                DB::connection($empresa->data_base)->table('trabajadores')->where('id', $postulante->id)->update([
                    'visto_bueno'   => 1,
                    'estado'        => 3, 
                ]);
                
                //Enviar Correo
                    Mail::to('daniel@gmail.com')->queue(new ValidacionSolicitada($postulante)); 
                // $staffs = Staff::where('empresa_id', $empresa->id)-get();
                // foreach($staffs as $staff){
                // }
                
                // return  new ValidacionSolicitada($postulante);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('postulante.index')
                ->with('danger', "No fue posible solicitar la validación. Comunicarse con TI de Aprore.");
        }
        return redirect()->route('postulante.index')
            ->with('success', "La validacion fue solicitada correctamente.");
    }
    public function solicitudes() {
        $asignaciones = Trabajador::where('visto_bueno', 1)->count();
        return $asignaciones;
    }
    public function indexSoli() {
        Gate::authorize('havepermiso', 'Trabajador.validar.aprobar');
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $postulantes = Trabajador::where('visto_bueno', 1)->get();
        return view('postulantes.solicitud-index', [
            'postulantes' => $postulantes
        ]);
    }
    public function aprobarSoli($id) {
        Gate::authorize('havepermiso', 'Trabajador.show');
        $postulante = Trabajador::findOrFail( $id );     
        return view('postulantes.solicitud-show', [
            'postulante' => $postulante
        ]);
    }

    public function solicitudAceptar(Request $request) {
        Gate::authorize('havepermiso', 'Trabajador.show');
        
        $request->validate([
            'trabajador'    => 'required | Numeric',
        ]);

        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $postulante = Trabajador::findOrFail( $request->trabajador );  
          
        // return  new ValidacionSolicitada($postulante);
        try {
            DB::beginTransaction();
                DB::connection($empresa->data_base)->table('trabajadores')->where('id', $postulante->id)->update([
                    'visto_bueno'   => 2,
                    'estado'        => 4, 
                ]);
                
                //Enviar Correo
                // $staffs = Staff::where('empresa_id', $empresa->id)-get();
                // foreach($staffs as $staff){
                //     Mail::to($staff->user->email)->queue(new ValidacionSolicitada($postulante)); 
                // }
                
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('solicitudes.index')
                ->with('danger', "No fue posible aceptar la postulación. Comunicarse con TI de Aprore.");
        }
        return redirect()->route('solicitudes.index')
            ->with('success', "La aceptacion fue registrada correctamente.");
    }

    public function solicitudRechazo(Request $request) {
        Gate::authorize('havepermiso', 'Trabajador.show');
        $request->validate([
            'trabajador'    => 'required | Numeric',
            'motivoRechazo'   => 'required | max:10000 | min:1'
        ]);
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        $postulante = Trabajador::findOrFail( $request->trabajador );    
        // return  new ValidacionSolicitada($postulante);
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
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('solicitudes.index')
                ->with('danger', "No fue posible Rechazar la postulación. Comunicarse con TI de Aprore.");
        }
        return redirect()->route('solicitudes.index')
            ->with('success', "El rechazo fue registrado correctamente.");
    }
}
