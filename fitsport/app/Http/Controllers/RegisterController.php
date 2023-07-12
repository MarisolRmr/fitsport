<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
use auth;


class RegisterController extends Controller
{
    //crear nuestro primer metodo del controlador
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request) {
        //"dd" dump or die imprime lo que se tiene en el proyecto y lo depura
        //dd ('Post...');
        //dd($request->get('username'));


        //modifico el request para que no se repitan los username
        $request->request->add(['usuario'=>Str::slug($request->usuario)]);
        //validaciones del formulario de registros
        $this->validate($request,[
            'nombre'=>'required',
            'apellido'=>'required', 
            'telefono'=>'required', 
            'fecha_nac'=>'required|date', 
            'usuario'=>'required|unique:users|min:3|max:20', 
            'correo'=>'required|unique:users|email|max:60', 
            'password'=>'required|confirmed|min:6', 
            'password_confirmation'=>'required',
        ]);
        
        //Invocar el modelo User para crear el registro
        User::create([
            'nombre'=>$request->nombre,
            'apellido'=>$request->apellido,
            //Insertar username en minuscula y mayusculas
            'usuario'=>$request->usuario,
            'password'=>$request->password,
            'password'=>Hash::make($request->password),
            'fecha_nac'=>$request->fecha_nac,
            'telefono'=>$request->telefono,
            'correo'=>$request->correo,
            'fotografia'=>$request->fotografia,
            'tipo_id' => 2,
        ]);
        

        //autenticar un usuario con el moetodo attemp
        auth()->attempt($request->only('usuario','password'));
     
        //redireccionamiento
        return redirect()->route('home');

        
    }
}
