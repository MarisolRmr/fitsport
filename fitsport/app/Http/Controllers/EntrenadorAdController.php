<?php

namespace App\Http\Controllers;

use App\Models\Entrenador;
use App\Models\Gimnasios;
use Illuminate\Http\Request;
use App\Models\Ejercicio;

class EntrenadorAdController extends Controller
{
    //Constructor del controlador
    public function __construct(){
        //Middleware para proteger las rutas con autenticación
        $this->middleware('auth');
    }
    public function index(){
        return view('admin.entrenador.mostrar');
    }
    public function create(){
        // Obtener todos los gimnasios
        $gimnasios = Gimnasios::all();
        return view('admin.entrenador.crear', ['gimnasios' => $gimnasios]);
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
