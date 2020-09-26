<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Staff;

class HomeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function asignaciones() {
        $asignaciones = Staff::where('user_id', Auth::user()->id)->get();
        return $asignaciones;
    }
    
    public function index() {
        
        // dd($asignaciones);
        return view('index' );
    }
}
