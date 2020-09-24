<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\StaffController;

// Auth::loginUsingId(2);

Route::resource('empresa', EmpresaController::class);
Route::resource('staff', StaffController::class);
Route::get('empresa/staff/create/{empresa}', [StaffController::class, 'staffCreate'])->name('empresa.staff.create');
Route::post('empresa/staff/create/store/', [StaffController::class, 'staffStore'])->name('empresa.staff.store');
Route::get('empresa/admin/create/{empresa}', [StaffController::class, 'adminCreate'])->name('empresa.admin.create');
Route::post('empresa/admin/create/store/', [StaffController::class, 'adminStore'])->name('empresa.admin.store');
Route::get('empresa/encargado/create/{empresa}', [StaffController::class, 'encargadoCreate'])->name('empresa.encargado.create');
Route::post('empresa/encargado/create/store/', [StaffController::class, 'encargadoStore'])->name('empresa.encargado.store');
Route::get('empresa/secre/create/{empresa}', [StaffController::class, 'secreCreate'])->name('empresa.secre.create');
Route::post('empresa/secre/create/store/', [StaffController::class, 'secreStore'])->name('empresa.secre.store');



Route::get('/home', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
