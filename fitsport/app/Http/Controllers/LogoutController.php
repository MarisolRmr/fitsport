<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function store() {
        //cerrar sesion con el helper out implementando elmetodo logout
        auth()->logout();
        //enviar la vista del login
        return redirect()->route('login');
    }
}
