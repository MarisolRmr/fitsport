<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
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
        'imagen' => 'required'
   ]);

 
   $nombreImagenUnico='';
    if ($request->hasFile('imagen')) {
        $imagen = $request->file('imagen');
        $nombreImagenUnico = Str::uuid() . "." . $imagen->getClientOriginalExtension();
        $imagenServidor = Image::make($imagen);
        $imagenServidor->fit(800, 200); // Redimensionar la imagen
        $imagenPath = public_path('noticias_img') . '/' . $nombreImagenUnico;
        $imagenServidor->save($imagenPath); // Guardar la imagen redimensionada en la carpeta "public/uploads"
    }


    
    Noticia::create([
        'nombre' => $request->nombre,
        'fecha' => $request->fecha,
        'descripcion' => $request->descripcion,
        'texto' => $request->texto,
        'imagen' =>$nombreImagenUnico,
    ]);

    // Redireccionar a la vista de listado de noticias
    return redirect()->route('noticias.index')->with('agregada', 'Noticia agregada correctamente');
}



}
