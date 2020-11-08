<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\PostulanteExpedienteController;
use App\Http\Controllers\PostulanteInformacionController;
use App\Http\Controllers\PostulanteController;
use App\Http\Controllers\PostulanteMasivoController;
use App\Http\Controllers\PostulanteSolicitudController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\UserStaffController;
use App\Http\Controllers\UserEncargadoController;
use App\Http\Controllers\UserSecretariaController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\SeccionController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\BajaController;
use App\Http\Controllers\BajaSolicitudController;

// Auth::loginUsingId(2);

Route::resource('empresa', EmpresaController::class)->except(['edit', 'update', 'destroy']);
Route::resource('empresa.admin', UserAdminController::class)->only(['create', 'store']);
Route::resource('empresa.staff', UserStaffController::class)->only(['create', 'store']);
Route::get('empresa/{empresa}/staff/assign', [UserStaffController::class, 'assign'])->name('empresa.staff.assign');
Route::post('empresa/{empresa}/staff/assign', [UserStaffController::class, 'assignStore'])->name('empresa.staff.assign.store');
Route::resource('empresa.encargado', UserEncargadoController::class)->only(['create', 'store']);
Route::resource('empresa.secretaria', UserSecretariaController::class)->only(['create', 'store']);

//Modulo - Registro de Postulantes
Route::resource('postulante', PostulanteController::class);
Route::resource('postulante.informacion', PostulanteInformacionController::class)->except(['index', 'show', 'destroy'])->shallow();
Route::resource('postulante.expediente', PostulanteExpedienteController::class)->except(['index', 'destroy'])->shallow();
Route::resource('postulantemasivo', PostulanteMasivoController::class)->only(['index', 'store']);
Route::post('postulante/save/', [PostulanteMasivoController::class, 'save'])->name('postulantemasivo.save');
Route::get('postulantemasivo/plantilla/descargar', [PostulanteMasivoController::class, 'descargar'])->name('postulantemasivo.plantilla');
Route::resource('postulante.solicitud', PostulanteSolicitudController::class)->shallow();

Route::resource('postulante.baja', BajaController::class)->shallow();
Route::resource('baja.solicitudbaja', BajaSolicitudController::class)->shallow();
Route::get('baja', [BajaController::class, 'all'])->name('baja.index');
Route::get('baja/select/trabajador', [BajaController::class, 'select'])->name('baja.select');

//Modulo - Asignacion de contrato
Route::resource('sucursal', SucursalController::class);
Route::resource('sucursal.area', AreaController::class)->shallow();
Route::resource('area.seccion', SeccionController::class)->shallow();
Route::resource('contrato', ContratoController::class);

Route::get('/home', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('index');
})->name('dashboard');
