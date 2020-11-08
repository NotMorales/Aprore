<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\Sucursal;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ContratoController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        Gate::authorize('havepermiso', 'Contrato.index');

        return view('contrato.index', [
            'empresa'           => Empresa::findOrFail( Auth::user()->empresa_id ),
            'trabajadores'      => Trabajador::where('estado', 4)->get(),
        ]);
    }

    public function create() {
        Gate::authorize('havepermiso', 'Contrato.create');

        return view('contrato.create', [
            'empresa'           => Empresa::findOrFail( Auth::user()->empresa_id ),
            'sucursales'        => Sucursal::get(),
        ]);
    }

    public function store(Request $request) {
        //
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
}
