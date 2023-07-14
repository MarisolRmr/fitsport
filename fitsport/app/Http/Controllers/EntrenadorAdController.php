<?php

namespace App\Http\Controllers;

use App\Models\Entrenador;
use Illuminate\Http\Request;

class EntrenadorAdController extends Controller
{
    public function index(){
        return view('admin.entrenador.mostrar');
    }
    public function create(){
        return view('admin.entrenador.crear');
    }

    //Funcion para registrar los entrenador en la tabla
    public function store(Request $request)
    {
        //Validaciones de formulario
        $this->validate($request, [
            'nombre' => 'required',
            'codigo' => 'required',
            'empresa' => 'required',
            'email' => 'required|email|min:3|max:20',
            'telefono' => 'required|min:10|max:10',
            'imagen' => 'required'
        ]);
        //Se hace el registro en la tabla de entrenador
        Entrenador::create([
            ''
        ]);
        //Se retorna a la vista de entrenador 
        return redirect()->route('entrenador.index');
    }
}
