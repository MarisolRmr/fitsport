<?php

namespace App\Http\Controllers;

use App\Models\Ejercicio;
use Illuminate\Http\Request;

class EjerciciosController extends Controller
{
    //
    public function index(){
        $ejercicio=Ejercicio::all();
        return view('admin.ejercicios.mostrar',["ejercicio"=>$ejercicio]);
    }
    public function create(){
        return view('admin.ejercicios.crear');
    }

    //Funcion para registrar los entrenador en la tabla
    public function store(Request $request)
    {
        
        //Validaciones de formulario
        $this->validate($request, [
            'nombre' => 'required',
            'descripcion' => 'required',
            'explicacion' => 'required',
        ]);
        //Se hace el registro en la tabla de entrenador
        Ejercicio::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'explicacion' => $request->explicacion,
        ]);
        //Se retorna a la vista de clientes
        return redirect()->route('ejercicio.index');
    }

    //Ruta para retornar la vista de editar ejercicio
    public function edit($id_ejercicio){
        //Se busca el ejercicio mediante el ID
        $ejercicio= Ejercicio::where('id',$id_ejercicio)->get();
        //dd($ejercicio);
        //Se retorna a la vista
        return view('admin.ejercicios.mostrar',["ejercicio"=>$ejercicio]);
    }

    //Función para actualizar los datos del ejercicio en la base de datos
    public function update(Request $request)
    {
        //Validaciones de formulario
        $this->validate($request, [
            'nombre' => 'required',
            'descripcion' => 'required',
            'explicacion' => 'required',
        ]);
        //Actualizacion de datos
        Ejercicio::where('id', $request->id)->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'explicacion' => $request->explicacion,
        ]);
        //Se retorna a la vista de ejercicio
        return redirect()->route('ejercicio.index');
    }

    //Funcion para eliminar el ejercicio
    public function delete($id_ejercicio)
    {
        //Se busca el ejercicio en el modelo y se elimina
        Ejercicio::find($id_ejercicio)->delete();
        return redirect()->route('ejercicio.index');
    }
}
