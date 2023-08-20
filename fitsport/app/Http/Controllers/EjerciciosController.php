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
        // Guardar la imagen temporalmente en el sistema de archivos si la validación falla
        if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
            $imagenTemporal = file_get_contents($request->file('imagen')->getRealPath());
            $request->session()->flash('cachedImage', base64_encode($imagenTemporal));
        }elseif ($request->has('cachedImage')) {
            // Si la solicitud incluye un campo "cachedImage", reutiliza el valor existente
            $request->session()->flash('cachedImage', $request->cachedImage);
        }
        
        //Validaciones de formulario
        $this->validate($request, [
            'nombre' => 'required',
            'descripcion' => 'required',
            'explicacion' => 'required',
            'imagen' => [
                function ($attribute, $value, $fail) use ($request) {
                    // Verificar si no hay una imagen en la sesión flash ('cachedImage')
                    if (!$request->session()->has('cachedImage') && !$request->hasFile('imagen')) {
                        $fail('La imagen es obligatoria si no hay imagen en la sesión.');
                    }
                },
            ]
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
        }elseif (session()->has('cachedImage')) {
            // Obtener la imagen codificada en base64 de la sesión flash
            $imagenCodificada = session('cachedImage');
        
            // Decodificar la imagen base64 y crear un objeto de imagen desde los datos decodificados
            $imagenDecodificada = base64_decode($imagenCodificada);
        
            // Asumir que la extensión es jpg si no podemos determinarla
            $extensionOriginal = 'jpg';
        
            // Crear un nombre único para la imagen con la extensión original
            $nombreImagenUnico = Str::uuid() . "." . $extensionOriginal;
        
            // Obtener la ubicación completa para guardar la imagen en el disco
            $imagenPath = public_path('ImgEjercicios') . '/' . $nombreImagenUnico;
        
            // Crear una instancia de Image a partir de los datos decodificados
            $imagenServidor = Image::make($imagenDecodificada);
        
            // Redimensionar la imagen (ajustar esto según tus necesidades)
            $imagenServidor->fit(1000, 1000);
        
            // Guardar la imagen redimensionada en el disco
            $imagenServidor->save($imagenPath);
        }
        //Se hace el registro en la tabla de entrenador
        Ejercicio::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'explicacion' => $request->explicacion,
            'imagen' =>$nombreImagenUnico,
        ]);

        // Eliminar la imagen de la sesión flash después de haberla guardado
        $request->session()->forget('cachedImage');

        //Se retorna a la vista de clientes
        return redirect()->route('ejercicio.index')->with('success', 'Ejercicio agregado correctamente');
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
        // Guardar la imagen temporalmente en el sistema de archivos si la validación falla
        if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
            $imagenTemporal = file_get_contents($request->file('imagen')->getRealPath());
            $request->session()->flash('cachedImage', base64_encode($imagenTemporal));
        }elseif ($request->has('cachedImage')) {
            // Si la solicitud incluye un campo "cachedImage", reutiliza el valor existente
            $request->session()->flash('cachedImage', $request->cachedImage);
        }
        //Validaciones de formulario
        $this->validate($request, [
            'nombre' => 'required',
            'descripcion' => 'required',
            'explicacion' => 'required',
            'imagen' => [
                function ($attribute, $value, $fail) use ($request) {
                    // Verificar si no hay una imagen en la sesión flash ('cachedImage')
                    if (!$request->session()->has('cachedImage') && !$request->hasFile('imagen')) {
                        $fail('La imagen es obligatoria si no hay imagen en la sesión.');
                    }
                },
            ]
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
        }elseif (session()->has('cachedImage')) {
            // Obtener la imagen codificada en base64 de la sesión flash
            $imagenCodificada = session('cachedImage');
        
            // Decodificar la imagen base64 y crear un objeto de imagen desde los datos decodificados
            $imagenDecodificada = base64_decode($imagenCodificada);
        
            // Asumir que la extensión es jpg si no podemos determinarla
            $extensionOriginal = 'jpg';
        
            // Crear un nombre único para la imagen con la extensión original
            $nombreImagenUnico = Str::uuid() . "." . $extensionOriginal;
        
            // Obtener la ubicación completa para guardar la imagen en el disco
            $imagenPath = public_path('ImgEjercicios') . '/' . $nombreImagenUnico;
        
            // Crear una instancia de Image a partir de los datos decodificados
            $imagenServidor = Image::make($imagenDecodificada);
        
            // Redimensionar la imagen (ajustar esto según tus necesidades)
            $imagenServidor->fit(1000, 1000);
        
            // Guardar la imagen redimensionada en el disco
            $imagenServidor->save($imagenPath);
        }
        
        //Actualizacion de datos
        Ejercicio::where('id', $request->id)->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'explicacion' => $request->explicacion,
            'imagen' => $nombreImagenUnico,
        ]);
        // Eliminar la imagen de la sesión flash después de haberla guardado
        $request->session()->forget('cachedImage');
        //Se retorna a la vista de ejercicio
        return redirect()->route('ejercicio.index')->with('success', 'Ejercicio actualizado correctamente');
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

    public function view($id_ejercicio){

        //Se busca el ejercicio mediante el ID
        $ejercicio= Ejercicio::find($id_ejercicio);
        //Se retorna a la vista
        return view('admin.ejercicios.verEjercicio',["ejercicio"=>$ejercicio]);
    }


    ////////////////USUARIO//////////////7

    public function ejercitate(){
        $ejercicio=Ejercicio::all();
        return view('user.ejercitate.verEjercicios',["ejercicio"=>$ejercicio]);
    }
    public function buscar(Request $request) {
        $query = $request->input('query');
        $ejercicios = Ejercicio::where('nombre', 'LIKE', '%' . $query . '%')->get();
        
        return response()->json($ejercicios);
    }
    
    public function viewE($id_ejercicio){
        //Se busca el ejercicio mediante el ID
        $ejercicio= Ejercicio::find($id_ejercicio);
        //Se retorna a la vista
        return view('user.ejercitate.verEjercicio',["ejercicio"=>$ejercicio]);
    }

}
