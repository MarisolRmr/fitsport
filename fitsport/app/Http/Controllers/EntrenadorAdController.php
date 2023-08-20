<?php

namespace App\Http\Controllers;

use App\Models\Entrenador;
use App\Models\Gimnasios;
use Illuminate\Http\Request;
use App\Models\Ejercicio;
use App\Models\User;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class EntrenadorAdController extends Controller
{
    //Constructor del controlador
    public function __construct(){
        //Middleware para proteger las rutas con autenticación
        $this->middleware('auth');
    }
    public function index(){
        $entrenadores = Entrenador::where('tipo_id', 3)->with('gimnasio')->get();
        return view('admin.entrenador.mostrar')->with('entrenador', $entrenadores);
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
            'apellido' => 'required',
            'hora' => 'required',
            'horaCierre' => 'required',
            'gym' => 'required',
            'email' => 'required|email|min:3|max:20|unique:users,correo',
            'telefono' => 'required|max:10',
            'imagen' => 'required'
        ]);
        $nombreImagenUnico='';
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            //Generamos un nombre único para la imagen
            $nombreImagenUnico = Str::uuid() . "." . $imagen->getClientOriginalExtension();
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000); // Redimensionamos la imagen
            $imagenPath = public_path('ImgEntrenador') . '/' . $nombreImagenUnico;
            //Guardamos la imagen en el servidor
            $imagenServidor->save($imagenPath);
        }
        //Se hace el registro en la tabla de entrenador
        Entrenador::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'horaEntrada' => $request->hora,
            'horaSalida' => $request->horaCierre,
            'correo' => $request->email,
            'telefono' => $request->telefono,
            'fotografia' => $nombreImagenUnico,
            'tipo_id' => 3,
            'gimnasio_id'=> $request->gym,
            // Si hay más campos, continúa agregándolos aquí
        ]);
        //Se retorna a la vista de entrenador 
        return redirect()->route('entrenador.index')->with('success', 'Entrenador registrado correctamente');
    }
    public function edit($id_entrenador){
        //Buscamos el gimnasio por el ID
        $entrenador= Entrenador::find($id_entrenador);
        $gimnasios = Gimnasios::all();
        //Devolvemos la vista con los datos del gimnasio
        return view('admin.entrenador.edit', ["entrenador" => $entrenador, "gimnasios" => $gimnasios]);
    }

    //Método para actualizar un gimnasio
    public function update(Request $request)
    {
        //Validamos los datos del formulario
        $this->validate($request, [
            'nombre' => 'required',
            'apellido' => 'required',
            'hora' => 'required',
            'horaCierre' => 'required',
            'gym' => 'required',
            'email' => 'required|email|min:3|max:20|unique:users,correo,' . $request->id,
            'telefono' => 'required|max:10'
        ]);

        //Busca el gimnasio y lo guarda en gym
        $entrenador = Entrenador::findOrFail($request->id);
        $nombreImagenUnico = $entrenador->fotografia;

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            //Generamos un nombre único para la imagen
            $nombreImagenUnico = Str::uuid() . "." . $imagen->getClientOriginalExtension();
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000); // Redimensionamos la imagen
            $imagenPath = public_path('ImgEntrenador') . '/' . $nombreImagenUnico;
            //Guardamos la imagen en el servidor
            $imagenServidor->save($imagenPath);
        }
        
        //Actualizamos el gimnasio
        Entrenador::where('id', $request->id)->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'horaEntrada' => $request->hora,
            'horaSalida' => $request->horaCierre,
            'correo' => $request->email,
            'telefono' => $request->telefono,
            'fotografia' => $nombreImagenUnico,
            'tipo_id' => 3,
            'gimnasio_id'=> $request->gym,
            // Si hay más campos, continúa agregándolos aquí
        ]);

        //Redireccionamos al index
        return redirect()->route('entrenador.index')->with('success', 'Entrenador actualizado correctamente');
    }
    public function delete($id_entrenador)
    {
        // Buscamos el gimnasio por su ID
        $entrenador = Entrenador::find($id_entrenador);

        // Comprobamos si el gimnasio tiene imagen asociada
        if ($entrenador->fotografia) {
            $imagenPath = public_path('ImgEntrenador') . '/' . $entrenador->fotografia;
            //Si existe la imagen en el servidor, la eliminamos
            if (file_exists($imagenPath)) {
                unlink($imagenPath); 
            }
        }

        // Eliminamos el gimnasio
        $entrenador->delete();

        //Redireccionamos al index con mensaje de éxito
        return redirect()->route('entrenador.index')->with('success', 'Entrenador eliminado correctamente');
    }
}
