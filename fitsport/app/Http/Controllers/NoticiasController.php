<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Models\Noticia;

class NoticiasController extends Controller
{
    public function __construct(){
        //protegemos la url
        //al metodo index con el constructor le pasamos el parametro de autenticacion
        $this->middleware('auth');
    }
    public function index(){
        $noticias = Noticia::all();
        return view('admin.noticias.mostrar')->with(['noticias' => $noticias]);
    }
    public function create(){
        return view('admin.noticias.crear');
    }

    public function store(Request $request)
{
    // Reglas de validación
    $this->validate($request, [
        'nombre' => 'required',
        'fecha' => 'required',
        'descripcion' => 'required',
        'texto' => 'required',
   ]);

    // Obtener el archivo de imagen subido
    //$imagen = $request->file('imagen');

    // Generar un ID único para el nombre del archivo
    //$imagenNombre = uniqid() . '.' . $imagen->getClientOriginalExtension();

    // Guardar la imagen en la carpeta "uploads" con el nombre único
    //$imagen->move('uploads', $imagenNombre);

    // Crear el registro en la base de datos y almacenar el ID único de la imagen
    Noticia::create([
        'nombre' => $request->nombre,
        'fecha' => $request->fecha,
        'descripcion' => $request->descripcion,
        'texto' => $request->texto,
    ]);

    // Redireccionar a la vista de listado de noticias
    return redirect()->route('noticias.index')->with('agregada', 'Noticia agregada correctamente');
}


}
