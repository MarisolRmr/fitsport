<?php

namespace App\Http\Controllers;

use App\Models\Ejercicio;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class EjerciciosController extends Controller
{
    //Constructor del controlador
    public function __construct(){
        //Middleware para proteger las rutas con autenticación
        $this->middleware('auth');
    }
    
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
            'imagen' => 'required'
        ]);
        //Cargar la imagen
        $nombreImagenUnico='';
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagenUnico = Str::uuid() . "." . $imagen->getClientOriginalExtension();
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000); // Redimensionar la imagen
            $imagenPath = public_path('ImgEjercicios') . '/' . $nombreImagenUnico;
            $imagenServidor->save($imagenPath); // Guardar la imagen redimensionada en la carpeta "public/uploads"
        }
        //Se hace el registro en la tabla de entrenador
        Ejercicio::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'explicacion' => $request->explicacion,
            'imagen' =>$nombreImagenUnico,
        ]);
        //Se retorna a la vista de clientes
        return redirect()->route('ejercicio.index')->with('agregada', 'Ejercicio agregado correctamente');
    }

    //Ruta para retornar la vista de editar ejercicio
    public function edit($id_ejercicio){
        //Se busca el ejercicio mediante el ID
        $ejercicio= Ejercicio::find($id_ejercicio);
        //Se retorna a la vista
        return view('admin.ejercicios.edit',["ejercicio"=>$ejercicio]);
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
        //Cargar la imagen
        $ejercicio = Ejercicio::findOrFail($request->id);
        $nombreImagenUnico = $ejercicio->imagen;
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagenUnico = Str::uuid() . "." . $imagen->getClientOriginalExtension();
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000); // Redimensionar la imagen
            $imagenPath = public_path('ImgEjercicios') . '/' . $nombreImagenUnico;
            $imagenServidor->save($imagenPath); // Guardar la imagen redimensionada en la carpeta "public/uploads"
        }
        
        //Actualizacion de datos
        Ejercicio::where('id', $request->id)->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'explicacion' => $request->explicacion,
            'imagen' => $nombreImagenUnico,
        ]);
        //Se retorna a la vista de ejercicio
        return redirect()->route('ejercicio.index');
    }

    //Funcion para eliminar el ejercicio
    public function delete($id_ejercicio)
    {
        // Buscar el ejercicio por su ID
        $ejercicio = Ejercicio::find($id_ejercicio);

        // Verificar si existe la imagen asociada al ejercicio y borrarla si es el caso
        if ($ejercicio->imagen) {
            $imagenPath = public_path('ImgEjercicios') . '/' . $ejercicio->imagen;
            if (file_exists($imagenPath)) {
                unlink($imagenPath); // Eliminar la imagen del servidor
            }
        }

        // Eliminar el ejercicio de la base de datos
        $ejercicio->delete();

        return redirect()->route('ejercicio.index')->with('success', 'Ejercicio eliminado correctamente');
    }

}
