<?php

namespace App\Http\Controllers;
use App\Models\Gimnasios;
use App\Models\Entrenador;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class GimnasiosController extends Controller
{
    //Constructor del controlador
    public function __construct(){
        //Middleware para proteger las rutas con autenticación
        $this->middleware('auth');
    }

    //Método para mostrar todos los gimnasios
    public function index() {
        //Obtenemos todos los gimnasios
        $gimnasios = Gimnasios::all();
    
        // Retornamos la vista 'verProductos' y pasamos los productos como una variable llamada 'productos'
        return view('admin.gymAndBoxes.mostrar')->with('gimnasios', $gimnasios);
    }

    //Método para mostrar el formulario de creación
    public function create()
    {
        return view('admin.gymAndBoxes.crear');
    }

    //Método para guardar un nuevo gimnasio
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
            'telefono' => 'required|max:10',
            'hora' => 'required',
            'horaCierre' => 'required',
            'descripcion' => 'required',
            'longitud' => 'required',
            'latitud' => 'required',
            'imagen' => [
                function ($attribute, $value, $fail) use ($request) {
                    // Verificar si no hay una imagen en la sesión flash ('cachedImage')
                    if (!$request->session()->has('cachedImage') && !$request->hasFile('imagen')) {
                        $fail('La imagen es obligatoria si no hay imagen en la sesión.');
                    }
                },
            ],
        ]);

        $nombreImagenUnico='';
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            //Generamos un nombre único para la imagen
            $nombreImagenUnico = Str::uuid() . "." . $imagen->getClientOriginalExtension();
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000); // Redimensionamos la imagen
            $imagenPath = public_path('ImgGymBoxes') . '/' . $nombreImagenUnico;
            //Guardamos la imagen en el servidor
            $imagenServidor->save($imagenPath);
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
            $imagenPath = public_path('ImgGymBoxes') . '/' . $nombreImagenUnico;
        
            // Crear una instancia de Image a partir de los datos decodificados
            $imagenServidor = Image::make($imagenDecodificada);
        
            // Redimensionar la imagen (ajustar esto según tus necesidades)
            $imagenServidor->fit(1000, 1000);
        
            // Guardar la imagen redimensionada en el disco
            $imagenServidor->save($imagenPath);
        }

        //Creamos el gimnasio
        Gimnasios::create([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'horario' => $request->hora,
            'horarioCierre'=> $request->horaCierre,
            'longitud' => $request->longitud,
            'latitud' => $request->latitud,
            'descripcion' => $request->descripcion,
            'fotografia' =>$nombreImagenUnico,
        ]);
        // Eliminar la imagen de la sesión flash después de haberla guardado
         $request->session()->forget('cachedImage');

        //Redireccionamos al index
        return redirect()->route('gymBoxes.index')->with('success', 'Gym/Box registrado correctamente');
    }

    //Método para editar un gimnasio
    public function edit($id_gym){
        //Buscamos el gimnasio por el ID
        $gym= Gimnasios::find($id_gym);
        //Devolvemos la vista con los datos del gimnasio
        return view('admin.gymAndBoxes.editar',["gym"=>$gym]);
    }

    //Método para actualizar un gimnasio
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

        //Validamos los datos del formulario
        $this->validate($request, [
            'nombre' => 'required',
            'telefono' => 'required',
            'hora' => 'required',
            'horaCierre' => 'required',
            'descripcion' => 'required',
            'imagen' => [
                function ($attribute, $value, $fail) use ($request) {
                    // Verificar si no hay una imagen en la sesión flash ('cachedImage')
                    if (!$request->session()->has('cachedImage') && !$request->hasFile('imagen')) {
                        $fail('La imagen es obligatoria si no hay imagen en la sesión.');
                    }
                },
            ],
        ]);

        //Busca el gimnasio y lo guarda en gym
        $gym = Gimnasios::findOrFail($request->id);
        $nombreImagenUnico = $gym->fotografia;

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            //Generamos un nombre único para la imagen
            $nombreImagenUnico = Str::uuid() . "." . $imagen->getClientOriginalExtension();
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000); // Redimensionamos la imagen
            $imagenPath = public_path('ImgGymBoxes') . '/' . $nombreImagenUnico;
            //Guardamos la imagen en el servidor
            $imagenServidor->save($imagenPath);
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
            $imagenPath = public_path('ImgGymBoxes') . '/' . $nombreImagenUnico;
        
            // Crear una instancia de Image a partir de los datos decodificados
            $imagenServidor = Image::make($imagenDecodificada);
        
            // Redimensionar la imagen (ajustar esto según tus necesidades)
            $imagenServidor->fit(1000, 1000);
        
            // Guardar la imagen redimensionada en el disco
            $imagenServidor->save($imagenPath);
        }
        
        //Actualizamos el gimnasio
        Gimnasios::where('id', $request->id)->update([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'horario' => $request->hora,
            'horarioCierre'=> $request->horaCierre,
            'longitud' => $request->longitud,
            'latitud' => $request->latitud,
            'descripcion' => $request->descripcion,
            'fotografia' =>$nombreImagenUnico,
        ]);
        // Eliminar la imagen de la sesión flash después de haberla guardado
        $request->session()->forget('cachedImage');

        //Redireccionamos al index
        return redirect()->route('gymBoxes.index')->with('success', 'Gym/Box actualizado correctamente');
    }

    //Método para eliminar un gimnasio
    public function delete($id_gym)
    {
        // Buscamos el gimnasio por su ID
        $gymBoxes = Gimnasios::find($id_gym);
        // Elimina todos los entrenadores asociados al gimnasio
        foreach ($gymBoxes->entrenadores as $entrenador) {
            // Si el entrenador tiene una imagen asociada, elimínala
            if ($entrenador->fotografia) {
                $imagenPathEntrenador = public_path('ImgEntrenador') . '/' . $entrenador->fotografia;
                //Si existe la imagen en el servidor, la eliminamos
                if (file_exists($imagenPathEntrenador)) {
                    unlink($imagenPathEntrenador);
                }
            }

            // Elimina el entrenador
            $entrenador->delete();
        }

        // Comprobamos si el gimnasio tiene imagen asociada
        if ($gymBoxes->fotografia) {
            $imagenPath = public_path('ImgGymBoxes') . '/' . $gymBoxes->fotografia;
            //Si existe la imagen en el servidor, la eliminamos
            if (file_exists($imagenPath)) {
                unlink($imagenPath); 
            }
        }

        // Eliminamos el gimnasio
        $gymBoxes->delete();

        //Redireccionamos al index con mensaje de éxito
        return redirect()->route('gymBoxes.index')->with('success', 'Gym/Box eliminado correctamente');
    }

    //Método para mostrar todos los gimnasios
    public function index_atleta() {
        //Obtenemos todos los gimnasios
        $gimnasios = Gimnasios::all();
    
        // Retornamos la vista 'verProductos' y pasamos los productos como una variable llamada 'productos'
        return view('user.gymAndBoxes.mostrar')->with('gimnasios', $gimnasios);
    }
    public function buscar(Request $request) {
        $query = $request->input('query');
        $noticias = Gimnasios::where('nombre', 'LIKE', '%' . $query . '%')->get();
        
        return response()->json($noticias);
    }

    //vista de detalles de noticia
    public function detalles_index($id){
        // Busca la noticia por ID 
        $gimnasio = Gimnasios::with('entrenadores')->find($id);
        return view('user.gymAndBoxes.detalles')->with(['gimnasio' => $gimnasio ]);
    }
}
