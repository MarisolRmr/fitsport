<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoticiasController extends Controller
{
    public function __construct(){
        //protegemos la url
        //al metodo index con el constructor le pasamos el parametro de autenticacion
        $this->middleware('auth');
    }
    public function index(){
        return view('admin.noticias.mostrar');
    }
    public function create(){
        return view('admin.noticias.crear');
    }
}
