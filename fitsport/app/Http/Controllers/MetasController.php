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
        // Guardar la imagen temporalmente en el sistema de archivos si la validación falla
        if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
            $imagenTemporal = file_get_contents($request->file('imagen')->getRealPath());
            $request->session()->flash('cachedImage', base64_encode($imagenTemporal));
        }elseif ($request->has('cachedImage')) {
            // Si la solicitud incluye un campo "cachedImage", reutiliza el valor existente
            $request->session()->flash('cachedImage', $request->cachedImage);
        }
        //Validamos los datos del formulario
        $request->validate([
            'nombre' => 'required',
            'fecha' => 'required',
            'descripcion' => 'required',
        ]);

        //Creamos el gimnasio
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

    public function cambiarEstado(Request $request) {
        \Log::info('Método cambiarEstado llamado con datos:', $request->all());
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

    public function edit($id_metas){
        //Buscamos el gimnasio por el ID
        $meta= Evento::find($id_metas);
        //Devolvemos la vista con los datos del gimnasio
        return view('user.metas.editar',["meta"=>$meta]);
    }

    


    public function delete($id_meta)
    {
        // Buscamos el gimnasio por su ID
        $meta = Evento::find($id_meta);

        // Eliminamos el gimnasio
        $meta->delete();

        //Redireccionamos al index con mensaje de éxito
        return redirect()->route('metas.index')->with('success', 'Nutriologo eliminado correctamente');
    }
}
