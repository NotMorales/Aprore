<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\PostulanteImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Empresa;
use Carbon\Carbon;

class PostulanteMasivoController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('masivo.index');
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        try {
            $request->validate([
                'file' => 'required',
            ]);

            $fileName = time().'_Masivo_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file');

            Storage::disk('masivo')->put($fileName, File::get($filePath));
            $array = Excel::toArray(new PostulanteImport, $filePath);

            return view('masivo.create', [
                'array'     => $array[0],
                'file'      => $fileName,
            ]);
        }catch (\Throwable $exception) {
            return redirect()->route('postulantemasivo.index')
                ->with('danger', "La lectura del documento fallo. Comunicarse con TI de Aprore.");
        }
    }

    public function save(Request $request) {
        $empresa = Empresa::findOrFail( Auth::user()->empresa_id );
        try {
            $fileName = $request->file;
            $array = Excel::toArray(new PostulanteImport, $fileName, 'masivo');
            DB::beginTransaction();
                foreach ($array[0] as $key => $value) {
                    if($key == 0){
                        continue;
                    }
                    if($value[0] == null && $value[1] == null && $value[1] == null){
                        continue;
                    }

                    $fechaNacimiento = new Carbon('01-01-1900');
                    $fechaAlta = new Carbon('01-01-1900');
                    $request->merge([
                        'nombre'            => $value[0],
                        'apellido_paterno'  => $value[1],
                        'apellido_materno'  => $value[2],
                        'sexo'              => $value[3],
                        'telefono'          => $value[4],
                        'fecha_nacimiento'  => $fechaNacimiento->addDays($value[5]-2)->format('Y-m-d'),
                        'email'             => $value[6],
                        'curp'              => $value[7],
                        'rfc'               => $value[8],
                        'nss'               => $value[9],
                        'calle'             => $value[10],
                        'colonia'           => $value[11],
                        'ciudad'            => $value[12],
                        'codigo_postal'     => $value[13],
                        'fecha_alta'        => $fechaAlta->addDays($value[14]-2)->format('Y-m-d'),
                        'clabe_bancaria'    => $value[15]
                    ]);
                    $validator  = Validator::make($request->all(), [
                        'nombre'            => 'required | String | max:255',
                        'apellido_paterno'  => 'required | String | max:255',
                        'apellido_materno'  => 'required | String | max:255',
                        'sexo'              => 'required | String | max:9',
                        'telefono'          => 'required | Numeric',
                        'fecha_nacimiento'  => 'required | Date',
                        'email'             => 'required | Email | max:255 | unique:users,email',
                        'curp'              => 'required | String | max:18 | min:18 | unique:'. $empresa->data_base . '.trabajadores,curp',
                        'rfc'               => 'required | String | max:13 | min:13 | unique:'. $empresa->data_base . '.trabajadores,rfc',
                        'nss'               => 'required | Numeric | digits:11 | unique:'. $empresa->data_base . '.trabajadores,nss',
                        'calle'             => 'required | String | max:255',
                        'colonia'           => 'required | String | max:255',
                        'ciudad'            => 'required | String | max:255',
                        'codigo_postal'     => 'required | Numeric',
                        'fecha_alta'        => 'required | Date',
                        'clabe_bancaria'    => ''
                    ]);

                    if ($validator->fails()) {
                        DB::rollBack();
                        return redirect()->route('postulantemasivo.index')
                            ->withErrors($validator)
                            ->with('danger', "Corregir informacion de: " . $value[0] . " " . $value[1]);
                    }

                    if (!PostulanteInformacionController::validate_curp($request['curp'])){
                        return redirect()->route('postulantemasivo.index')
                            ->with('danger', "Corregir informacion de: " . $value[0] . " " . $value[1] . "Utilizar una CURP valida.");
                    }
                    if (!PostulanteInformacionController::validate_rfc($request['rfc'])){
                        return redirect()->route('postulantemasivo.index')
                            ->with('danger', "Corregir informacion de: " . $value[0] . " " . $value[1] . "Utilizar un RFC valido.");
                    }
                    if (!PostulanteInformacionController::validate_nss($request['nss'])){
                        return redirect()->route('postulantemasivo.index')
                            ->with('danger', "Corregir informacion de: " . $value[0] . " " . $value[1] . "Utilizar un NSS valido.");
                    }

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
                        'curp'              => $request['curp'],
                        'rfc'               => $request['rfc'],
                        'nss'               => $request['nss'],
                        'calle'             => $request['calle'],
                        'colonia'           => $request['colonia'],
                        'ciudad'            => $request['ciudad'],
                        'codigo_postal'     => $request['codigo_postal'],
                        'fecha_alta'        => $request['fecha_alta'],
                        'estado'            => 1,
                        'visto_bueno'       => 0,
                        'clabe_bancaria'    => $request['clabe_bancaria']
                    ]);
                }
            DB::commit();
            return redirect()->route('postulante.index')
                ->with('success', "La importacion masiva fue todo un exito.");
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('postulantemasivo.index')
                ->with('danger', "La importacion masiva fallo. Comunicarse con TI de Aprore.");
        }

    }

    public function show($id) {
        //
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $id) {
        //
    }

    public function destroy($id) {
        //
    }

    public function descargar() {
         //Descargar la plantilla
         return Storage::disk('public')->download('Personal.xlsx');
    }
}
