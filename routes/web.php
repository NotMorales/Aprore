<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\PostulanteExpedienteController;
use App\Http\Controllers\PostulanteInformacionController;
use App\Http\Controllers\PostulanteController;
use App\Http\Controllers\PostulanteMasivoController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\UserStaffController;
use App\Http\Controllers\UserEncargadoController;
use App\Http\Controllers\UserSecretariaController;

// Auth::loginUsingId(2);

Route::resource('empresa', EmpresaController::class)->except(['edit', 'update', 'destroy']);
Route::resource('empresa.admin', UserAdminController::class)->only(['create', 'store']);
Route::resource('empresa.staff', UserStaffController::class)->only(['create', 'store']);
Route::get('empresa/{empresa}/staff/assign', [UserStaffController::class, 'assign'])->name('empresa.staff.assign');
Route::post('empresa/{empresa}/staff/assign', [UserStaffController::class, 'assignStore'])->name('empresa.staff.assign.store');
Route::resource('empresa.encargado', UserEncargadoController::class)->only(['create', 'store']);
Route::resource('empresa.secretaria', UserSecretariaController::class)->only(['create', 'store']);

Route::resource('postulantemasivo', PostulanteMasivoController::class)->only(['index', 'store']);
Route::post('postulante/save/', [PostulanteMasivoController::class, 'save'])->name('postulantemasivo.save');
Route::get('postulantemasivo/plantilla/descargar', [PostulanteMasivoController::class, 'descargar'])->name('postulantemasivo.plantilla');

Route::resource('postulante', PostulanteController::class);
Route::resource('postulante.informacion', PostulanteInformacionController::class)->except(['index', 'show', 'destroy'])->shallow();
Route::resource('postulante.expediente', PostulanteExpedienteController::class)->except(['index', 'destroy'])->shallow();
//Route::post('postulante/delete/destroy', [PostulanteController::class, 'destroy'])->name('postulante.delete');
//Route::get('postulante/expediente/get/{trabajador}', [PostulanteController::class, 'expeshow'])->name('expediente.show');
//Route::get('postulante/informacion/create/{trabajador}', [PostulanteController::class, 'inforCreate'])->name('informacion.create');
//Route::post('postulante/informacion/create/store/', [PostulanteController::class, 'inforStore'])->name('informacion.store');
//Route::get('postulante/informacion/edit/{trabajador}', [PostulanteController::class, 'inforEdit'])->name('informacion.edit');
//Route::patch('postulante/informacion/update/{trabajador}', [PostulanteController::class, 'inforUpdate'])->name('informacion.update');
//Route::get('postulante/expediente/create/{trabajador}', [PostulanteController::class, 'expeCreate'])->name('expediente.create');
//Route::post('postulante/expediente/create/store/', [PostulanteController::class, 'expeStore'])->name('expediente.store');
//Route::get('postulante/expediente/edit/{trabajador}', [PostulanteController::class, 'expeEdit'])->name('expediente.edit');
//Route::patch('postulante/expediente/update/{trabajador}', [PostulanteController::class, 'expeUpdate'])->name('expediente.update');
//Route::get('postulante/expediente/get/{trabajador}', [PostulanteController::class, 'expeshow'])->name('expediente.show');
Route::get('postulante/validar/show/{trabajador}', [PostulanteController::class, 'validar'])->name('trabajador.validar');
Route::post('postulante/validar/show', [PostulanteController::class, 'validarSoli'])->name('trabajador.soliValidar');

Route::get('postulante/solicitudes/index', [PostulanteController::class, 'indexSoli'])->name('solicitudes.index');
Route::get('postulante/solicitudes/aporbar/{trabajador}', [PostulanteController::class, 'aprobarSoli'])->name('solicitudes.aprobar');
Route::post('postulante/solicitudes/aprobar/pos', [PostulanteController::class, 'solicitudAceptar'])->name('solicitud.aceptar');
Route::post('postulante/solicitudes/rechazo/pos', [PostulanteController::class, 'solicitudRechazo'])->name('solicitud.rechazo');

Route::get('/home', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('index');
})->name('dashboard');
