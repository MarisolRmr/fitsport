<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rutina;

class RutinaController extends Controller
{
    //
    public function index(){
        // Obteniendo todas las metas del usuario autenticado.
        $rutina = Rutina::where('user_id', Auth::id())->get();

        // Pasando las metas a la vista.
        return view('user.rutinas.mostrar', ['rutina' => $rutina]);
    }
    public function create()
    {
        return view('user.rutinas.crear');
    }

    public function store(Request $request)
    {
        //Validamos los datos del formulario
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        //Creamos la meta
        Rutina::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'user_id' => Auth::id(),
        ]);

        //Redireccionamos al index
        return redirect()->route('rutina.index')->with('success', 'Rutina registrada correctamente');
    }
    public function edit($id_rutina){
        //Buscamos el gimnasio por el ID
        $rutina= Rutina::find($id_rutina);
        //Devolvemos la vista con los datos del gimnasio
        return view('user.rutinas.editar',["rutina"=>$rutina]);
    }

    //Método para actualizar una meta
    public function update(Request $request)
    {

        //Validamos los datos del formulario
        $this->validate($request, [
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        //Actualizamos la meta
        Rutina::where('id', $request->id)->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion
            
        ]);

        //Redireccionamos al index
        return redirect()->route('rutina.index')->with('success', 'Rutina actualizada correctamente');
    }





    public function delete($id_rutina)
    {
        // Buscamos la meta por su ID
        $rutina = Rutina::find($id_rutina);

        // Eliminamos la rutina
        $rutina->delete();

        //Redireccionamos al index con mensaje de éxito
        return redirect()->route('rutina.index')->with('success', 'Rutina eliminada correctamente');
    }

    public function buscar(Request $request) {
        $query = $request->input('query');
        $ejercicios = Ejercicio::where('nombre', 'LIKE', '%' . $query . '%')->get();
        
        return response()->json($ejercicios);
    }
}
