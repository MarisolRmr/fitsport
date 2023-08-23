<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Evento;
use App\Models\Rutina;

class HomeController extends Controller{
    public function __construct(){
        //protegemos la url
        //al metodo index con el constructor le pasamos el parametro de autenticacion
        $this->middleware('auth')->except('index', 'home');
    }
    
    public function index(){
        return view('principal');
    }

    public function home() {
        if (Auth::check()) {
            $user = Auth::user(); // Obtener el usuario autenticado
            $tipoUsuarioId = $user->tipo_id; // Obtener el tipo de usuario del campo 'tipo_id'
            $usuario = $user->usuario;
            $meta =Evento::where('users_id', Auth::id())->get();
            $rutina =Rutina::where('user_id', Auth::id())->get();

            // Redirigir según el tipo de usuario
            switch ($tipoUsuarioId) {
                case 1: //Admin
                    // Si el tipo de usuario es 1, redirigir a la vista para el primer tipo de usuario
                    return view('dashboard', [
                        'usuario' => $usuario
                    ]);
                    break;
                case 2: // Atleta
                    // Si el tipo de usuario es 2, redirigir a la vista para el segundo tipo de usuario
                    return view('user.dashboard', [
                        'usuario' => $usuario,
                        'metas'=> $meta,
                        'rutina'=> $rutina
                    ]);
                    break;
            }

        } else {
            return view('principal');
        }
    }

}
