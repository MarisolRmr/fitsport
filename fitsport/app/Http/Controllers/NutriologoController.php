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
    public function __construct(){
        //Middleware para proteger las rutas con autenticación
        $this->middleware('auth');
    }

    //Método para mostrar todos los gimnasios
    public function index() {
        //Obtenemos todos los gimnasios
        $nutriologo = User::where('tipo_id', 4)->get();
    
        // Retornamos la vista 'verProductos' y pasamos los productos como una variable llamada 'productos'
        return view('admin.nutriologo.mostrar')->with('nutriologo', $nutriologo);
    }

    public function create()
    {
        return view('admin.nutriologo.crear');
    }

    //Método para guardar un nuevo gimnasio
    public function store(Request $request)
    {
        //Validamos los datos del formulario
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required|max:10',
            'hora' => 'required',
            'horaCierre' => 'required',
            'cedula' => 'required|max:15|unique:users',
            'imagen' => 'required',
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
        }

        //Creamos el gimnasio
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

        //Redireccionamos al index
        return redirect()->route('admNutriologo.index')->with('success', 'Nutriologo registrado correctamente');
    }
    //Método para editar un gimnasio
    public function edit($id_nutriologo){
        //Buscamos el gimnasio por el ID
        $nutriologo = User::find($id_nutriologo);
        //Devolvemos la vista con los datos del gimnasio
        return view('admin.nutriologo.editar',["nutriologo"=>$nutriologo]);
    }

    //Método para actualizar un gimnasio
    public function update(Request $request)
    {
        //Validamos los datos del formulario
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required|max:10',
            'hora' => 'required',
            'horaCierre' => 'required',
        ]);

        //Busca el gimnasio y lo guarda en gym
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
        }



        
        //Actualizamos el gimnasio
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

        //Redireccionamos al index
        return redirect()->route('admNutriologo.index')->with('success', 'Nutiologo actualizado correctamente');
    }

    public function delete($id_nutriologo)
    {
        // Buscamos el gimnasio por su ID
        $nutriologo = User::find($id_nutriologo);

        // Comprobamos si el gimnasio tiene imagen asociada
        if ($nutriologo->imagen) {
            $imagenPath = public_path('ImgNutriologo') . '/' . $nutriologo->imagen;
            //Si existe la imagen en el servidor, la eliminamos
            if (file_exists($imagenPath)) {
                unlink($imagenPath); 
            }
        }
        // Eliminamos el gimnasio
        $nutriologo->delete();
        //Redireccionamos al index con mensaje de éxito
        return redirect()->route('admNutriologo.index')->with('success', 'Nutriologo eliminado correctamente');
    }
    public function view($id_nutriologo){
        //Se busca el ejercicio mediante el ID
        //dd($id_ejercicio);
        $nutriologo= User::find($id_nutriologo);
        //Se retorna a la vista
        return view('admin.nutriologo.vernutriologo',["nutriologo"=>$nutriologo]);
    }
    ///////////////////////////////////////////////////////////////
    // LADO USUARIO 
    //////////////////////////////////////////////////////
    public function nutriologos(){
        $nutriologo = User::where('tipo_id', 4)->get();
        return view('user.nutriologos.vernutriologos',["nutriologo"=>$nutriologo]);
    }
    public function buscar(Request $request) {
        $query = $request->input('query');
        $nutriologos = User::where('nombre', 'LIKE', '%' . $query . '%')->where('tipo_id', 4)->get();
        
        return response()->json($nutriologos);
    }
    
    public function viewN($id_nutriologo){
        //Se busca el ejercicio mediante el ID
        //dd($id_ejercicio);
        $nutriologo= User::find($id_nutriologo);
        //Se retorna a la vista
        return view('user.nutriologos.vernutriologo',["nutriologo"=>$nutriologo]);
    }
}
