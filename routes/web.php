<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
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
Route::get('empresa/secre/create/{empresa}', [StaffController::class, 'secreCreate'])->name('empresa.secre.create');
Route::post('empresa/secre/create/store/', [StaffController::class, 'secreStore'])->name('empresa.secre.store');



Route::get('/home', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('index');
=======

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('index');
});
>>>>>>> 9ed7d5fc5b4ed4f293600aa9e3fd7803762622ee

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
<<<<<<< HEAD

=======
>>>>>>> 9ed7d5fc5b4ed4f293600aa9e3fd7803762622ee
