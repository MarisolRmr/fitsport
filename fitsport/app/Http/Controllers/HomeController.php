<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct(){
        //protegemos la url
        //al metodo index con el constructor le pasamos el parametro de autenticacion
        $this->middleware('auth')->except('index');
    }
    
    public function index(){
        return view('principal');
    }

    public function home(){
        if (Auth::check()) {
            // El usuario está autenticado
            return view('dashboard');
        } else {
            // El usuario no está autenticado
            return redirect()->route('login');
        }
    }

   
}
