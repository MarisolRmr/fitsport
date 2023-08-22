<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Evento;

class MetasController extends Controller
{
    public function __construct(){
        //protegemos la url
        //al metodo index con el constructor le pasamos el parametro de autenticacion
        $this->middleware('auth');
    }
    public function index(){
        // Obteniendo todas las metas del usuario autenticado.
        $metas = Evento::where('users_id', Auth::id())->get();

        // Pasando las metas a la vista.
        return view('user.metas.mostrar', ['metas' => $metas]);
    }
    public function create()
    {
        return view('user.metas.agregar');
    }

    public function store(Request $request)
    {
        //Validamos los datos del formulario
        $request->validate([
            'nombre' => 'required',
            'fecha' => 'required|date|after_or_equal:today',
            'descripcion' => 'required',
        ]);

        //Creamos la meta
        Evento::create([
            'nombre' => $request->nombre,
            'fecha' => $request->fecha,
            'descripcion' => $request->descripcion,
            'estado'=> 'inicio',
            'tipo_evento' => 1,
            'users_id' => Auth::id(),
        ]);

        //Redireccionamos al index
        return redirect()->route('metas.index')->with('success', 'Meta registrada correctamente');
    }
     // Cambia el estado de una meta (Proceso o Finalizada)
    public function cambiarEstado(Request $request) {
        $metaId = $request->input('meta_id');
        $estado = $request->input('estado');
        
        $meta = Evento::find($metaId);
        if ($meta) {
            $meta->estado = $estado;
            $meta->save();
            
            // Obtén nuevamente las metas en proceso
            $metasProceso = Evento::where('estado', 'proceso')->get();
    
            return response()->json([
                'success' => true,
                'metasProceso' => $metasProceso,
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'Meta no encontrada']);
        }
    }
    // Muestra el formulario de edición de una meta
    public function edit($id_metas){
        //Buscamos el gimnasio por el ID
        $meta= Evento::find($id_metas);
        //Devolvemos la vista con los datos del gimnasio
        return view('user.metas.editar',["meta"=>$meta]);
    }

    //Método para actualizar una meta
    public function update(Request $request)
    {

        //Validamos los datos del formulario
        $this->validate($request, [
            'nombre' => 'required',
            'fecha' => 'required',
            'descripcion' => 'required',
        ]);

        //Actualizamos la meta
        Evento::where('id', $request->id)->update([
            'nombre' => $request->nombre,
            'fecha' => $request->fecha,
            'descripcion' => $request->descripcion,
            
        ]);

        //Redireccionamos al index
        return redirect()->route('metas.index')->with('success', 'Meta actualizada correctamente');
    }





    public function delete($id_meta)
    {
        // Buscamos la meta por su ID
        $meta = Evento::find($id_meta);

        // Eliminamos la meta
        $meta->delete();

        //Redireccionamos al index con mensaje de éxito
        return redirect()->route('metas.index')->with('success', 'Meta eliminada correctamente');
    }
}
