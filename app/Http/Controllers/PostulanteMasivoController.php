<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostulanteMasivoController extends Controller {
    public function index() {
        return view('masivo.index');
    }
 
    public function create() {
        //
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

    public function descargar() {
         //PDF file is stored under project/public/download/info.pdf
         return Storage::disk('public')->download('Personal.xlsx');
    }
}
