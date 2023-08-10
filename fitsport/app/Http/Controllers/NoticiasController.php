<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Models\Noticia;
use Carbon\Carbon;

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
    public function index_atleta(){
        $noticias = Noticia::all();
        // Ordenar las noticias por fecha (asumiendo que la columna de fecha se llama "fecha")
        $noticiasOrdenadas = $noticias->sortBy('fecha');

        // Obtener las 3 noticias más cercanas a la fecha actual
        $noticiasCercanas = $noticiasOrdenadas->take(3);
        return view('atleta.noticias.mostrar')->with(['noticias' => $noticias, 'noticiasCercanas' => $noticiasCercanas]);
    }
    public function create(){
        return view('admin.noticias.crear');
    }

    public function store(Request $request)
    {
        
    // Obtener la fecha actual en la zona horaria por defecto del servidor
    $fechaActual = Carbon::now();

    // Cambiar la zona horaria a la zona especificada en $request->zona_horaria
    $fechaActual->setTimezone($request->zona_horaria);

        // Reglas de validación
        $this->validate($request, [
            'nombre' => 'required',
            'fecha' => ['required', 'date', 'after_or_equal:' . $fechaActual->toDateTimeString()],
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

    //Ruta para retornar la vista de editar ejercicio
    public function edit($id_noticias){
        //Se busca el ejercicio mediante el ID
        $noticia= Noticia::find($id_noticias);
        //Se retorna a la vista
        return view('admin.noticias.editar',["noticia"=>$noticia]);
    }
    

    //Función para actualizar los datos del noticia en la base de datos
    public function update(Request $request, $id)
    {
        // Obtener la fecha actual en la zona horaria por defecto del servidor
        $fechaActual = Carbon::now();

        // Cambiar la zona horaria a la zona especificada en $request->zona_horaria
        $fechaActual->setTimezone($request->zona_horaria);
        //Validaciones de formulario
        $this->validate($request, [
            'nombre' => 'required',
            'fecha' => ['required', 'date', 'after_or_equal:' . $fechaActual->toDateTimeString()],
            'descripcion' => 'required',
            'texto' => 'required'
        ]);
        //Cargar la imagen
        $nombreImagenUnico='';
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagenUnico = Str::uuid() . "." . $imagen->getClientOriginalExtension();
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(800, 200); // Redimensionar la imagen
            $imagenPath = public_path('noticias_img') . '/' . $nombreImagenUnico;
            $imagenServidor->save($imagenPath); // Guardar la imagen redimensionada en la carpeta "public/uploads"
            //Actualizacion de datos

            Noticia::where('id', $id)->update([
                'nombre' => $request->nombre,
                'fecha' => $request->fecha,
                'descripcion' => $request->descripcion,
                'texto' => $request->texto,
                'imagen' => $nombreImagenUnico,
            ]);
        }else{
            //Actualizacion de datos
            
            Noticia::where('id', $id)->update([
                'nombre' => $request->nombre,
                'fecha' => $request->fecha,
                'descripcion' => $request->descripcion,
                'texto' => $request->texto,
            ]);

        }
        
        
        //Se retorna a la vista de noticias
        return redirect()->route('noticias.index')->with('actualizada', 'Noticia actualizada correctamente');
    }

    //Funcion para eliminar el noticia
    public function delete($id_noticia)
    {
        // Buscar el noticia por su ID
        $noticia = Noticia::find($id_noticia);

        // Verificar si existe la imagen asociada al noticia y borrarla si es el caso
        if ($noticia->imagen) {
            $imagenPath = public_path('noticias_img') . '/' . $noticia->imagen;
            if (file_exists($imagenPath)) {
                unlink($imagenPath); // Eliminar la imagen del servidor
            }
        }

        // Eliminar el noticia de la base de datos
        $noticia->delete();

        return redirect()->route('noticias.index')->with('eliminada', 'Noticia eliminada correctamente');
    }



}
