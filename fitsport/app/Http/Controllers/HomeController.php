<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(){
        //protegemos la url
        //al metodo index con el constructor le pasamos el parametro de autenticacion
        $this->middleware('auth')->except('index');;
    }
    public function home(){
        return view('dashboard');
    }

    public function index(){
        return view('principal');
    }

   
}
