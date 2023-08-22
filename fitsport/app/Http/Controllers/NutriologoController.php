<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Nutriologo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class NutriologoController extends Controller
{
    //Constructor del controlador
    public function __construct()
    {
        // Middleware para proteger las rutas con autenticación
        $this->middleware('auth');
        // Middleware para verificar si el usuario es administrador
        $this->middleware(function ($request, $next) {
            if (auth()->user()->tipo_id !== 1) {
                abort(403, 'Acceso no autorizado.');
            }
            return $next($request);
        })->only([
            'index', 'create', 'store', 'edit', 'update', 'delete'
        ]);
    }

     // Método para mostrar todos los nutricionistas
     public function index() {
        // Obtenemos todos los nutricionistas con tipo de usuario 4 (nutricionista)
        $nutriologo = User::where('tipo_id', 4)->get();
        
        // Retornamos la vista 'mostrar' y pasamos los nutricionistas como variable 'nutriologo'
        return view('admin.nutriologo.mostrar')->with('nutriologo', $nutriologo);
    }
    // Método para mostrar el formulario de creación de un nuevo nutricionista
    public function create()
    {
        return view('admin.nutriologo.crear');
    }

    //Método para guardar un nuevo nutriologo
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
            'apellido' => 'required',
            'telefono' => 'required|max:10',
            'hora' => 'required',
            'horaCierre' => 'required',
            'cedula' => 'required|max:15|unique:users',
            'imagen' => [
                function ($attribute, $value, $fail) use ($request) {
                    // Verificar si no hay una imagen en la sesión flash ('cachedImage')
                    if (!$request->session()->has('cachedImage') && !$request->hasFile('imagen')) {
                        $fail('La imagen es obligatoria si no hay imagen en la sesión.');
                    }
                },
            ],
            'longitud' => 'required',
            'latitud' => 'required',
        ]);

        $nombreImagenUnico='';
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            //Generamos un nombre único para la imagen
            $nombreImagenUnico = Str::uuid() . "." . $imagen->getClientOriginalExtension();
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000); // Redimensionamos la imagen
            $imagenPath = public_path('ImgNutriologo') . '/' . $nombreImagenUnico;
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
            $imagenPath = public_path('ImgNutriologo') . '/' . $nombreImagenUnico;
        
            // Crear una instancia de Image a partir de los datos decodificados
            $imagenServidor = Image::make($imagenDecodificada);
        
            // Redimensionar la imagen (ajustar esto según tus necesidades)
            $imagenServidor->fit(1000, 1000);
        
            // Guardar la imagen redimensionada en el disco
            $imagenServidor->save($imagenPath);
        }


        //Creamos el nutriologo
        Nutriologo::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'horaEntrada' => $request->hora,
            'horaSalida'=> $request->horaCierre,
            'longitud' => $request->longitud,
            'latitud' => $request->latitud,
            'cedula' => $request->cedula,
            'fotografia' =>$nombreImagenUnico,
            'tipo_id' => 4,
        ]);
        // Eliminar la imagen de la sesión flash después de haberla guardado
        $request->session()->forget('cachedImage');

        //Redireccionamos al index
        return redirect()->route('admNutriologo.index')->with('success', 'Nutriologo registrado correctamente');
    }
    //Método para editar un nutriologo
    public function edit($id_nutriologo){
        //Buscamos el nutriologo por el ID
        $nutriologo = User::find($id_nutriologo);
        //Devolvemos la vista con los datos del nutriologo
        return view('admin.nutriologo.editar',["nutriologo"=>$nutriologo]);
    }

    //Método para actualizar un nutriologo
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
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required|max:10',
            'cedula' => 'required|max:15|unique:users,cedula,' . $request->id,
            'hora' => 'required',
            'horaCierre' => 'required',
            'imagen' => [
                function ($attribute, $value, $fail) use ($request) {
                    // Verificar si no hay una imagen en la sesión flash ('cachedImage')
                    if (!$request->session()->has('cachedImage') && !$request->hasFile('imagen')) {
                        $fail('La imagen es obligatoria si no hay imagen en la sesión.');
                    }
                },
            ],
        ]);

        //Busca el nutriologo y lo guarda en gym
        $nutriologo = User::findOrFail($request->id);
        $nombreImagenUnico = $nutriologo->fotografia;

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            //Generamos un nombre único para la imagen
            $nombreImagenUnico = Str::uuid() . "." . $imagen->getClientOriginalExtension();
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000); // Redimensionamos la imagen
            $imagenPath = public_path('ImgNutriologo') . '/' . $nombreImagenUnico;
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



        
        //Actualizamos el nutriologo
        Nutriologo::where('id', $request->id)->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'horaEntrada' => $request->hora,
            'horaSalida'=> $request->horaCierre,
            'longitud' => $request->longitud,
            'latitud' => $request->latitud,
            'fotografia' =>$nombreImagenUnico,
            'tipo_id' => 4,
        ]);

        // Eliminar la imagen de la sesión flash después de haberla guardado
        $request->session()->forget('cachedImage');

        //Redireccionamos al index
        return redirect()->route('admNutriologo.index')->with('success', 'Nutiologo actualizado correctamente');
    }

    public function delete($id_nutriologo)
    {
        // Buscamos el nutriologo por su ID
        $nutriologo = User::find($id_nutriologo);

        // Comprobamos si el nutriologo tiene imagen asociada
        if ($nutriologo->imagen) {
            $imagenPath = public_path('ImgNutriologo') . '/' . $nutriologo->imagen;
            //Si existe la imagen en el servidor, la eliminamos
            if (file_exists($imagenPath)) {
                unlink($imagenPath); 
            }
        }
        $nutriologo->delete();

        //Redireccionamos al index con mensaje de éxito
        return redirect()->route('admNutriologo.index')->with('success', 'Nutriologo eliminado correctamente');
    }
    public function view($id_nutriologo){
        $nutriologo= User::find($id_nutriologo);
        //Se retorna a la vista
        return view('admin.nutriologo.vernutriologo',["nutriologo"=>$nutriologo]);
    }
    ///////////////////////////////////////////////////////////////
    // LADO USUARIO 
    //////////////////////////////////////////////////////
    // Método para mostrar la lista de nutricionistas en la vista de usuario
    public function nutriologos(){
        // Obtenemos todos los nutricionistas con tipo de usuario 4 (nutricionista)
        $nutriologo = User::where('tipo_id', 4)->get();
        
        // Retornamos la vista 'vernutriologos' y pasamos los nutricionistas como variable 'nutriologo'
        return view('user.nutriologos.vernutriologos', ["nutriologo" => $nutriologo]);
    }

    // Método para realizar una búsqueda de nutricionistas en la vista de usuario
    public function buscar(Request $request) {
        // Obtener el término de búsqueda de la solicitud
        $query = $request->input('query');
        
        // Realizar una consulta para obtener los nutricionistas que coinciden con el término de búsqueda
        $nutriologos = User::where('nombre', 'LIKE', '%' . $query . '%')->where('tipo_id', 4)->get();
        
        // Devolver una respuesta JSON con los nutricionistas encontrados
        return response()->json($nutriologos);
    }

    // Método para ver los detalles de un nutricionista en la vista de usuario
    public function viewN($id_nutriologo){
        // Buscamos el nutricionista por el ID
        $nutriologo = User::find($id_nutriologo);
        
        // Retornamos la vista 'vernutriologo' y pasamos los detalles del nutricionista como variable 'nutriologo'
        return view('user.nutriologos.vernutriologo', ["nutriologo" => $nutriologo]);
    }

}
