<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class LoginController extends Controller
{
    
    public function index(){
        return view('auth.login');
    }
    //validar formulario de login
    public function store(Request $request) {
   
        //reglas de validacion
        $this->validate($request,[
            'usuario'=>'required',
            'password'=>'required'
        ]);
        // Comprobar si el usuario existe como correo electrónico o nombre de usuario
        $user = User::where('correo', $request->usuario)
        ->orWhere('usuario', $request->usuario)
        ->first();

        if (!$user) {
        return back()->with('mensaje', 'El usuario o correo electrónico no fue encontrado.');
        }

        // Verificar las credenciales
        if (!auth()->attempt(['password' => $request->password, 'usuario' => $user->usuario], $request->remember) &&
        !auth()->attempt(['password' => $request->password, 'correo' => $user->correo], $request->remember)) {
        return back()->with('mensaje', 'Contraseña incorrecta, vuelva a intentarlo.');
        }
        //credenciales correctas
        return redirect()->route('home');
        
    }
}
