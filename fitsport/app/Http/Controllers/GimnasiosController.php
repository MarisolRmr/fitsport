<?php

namespace App\Http\Controllers;
use App\Models\Gimnasios;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class GimnasiosController extends Controller
{
    public function index() {
        $gimnasios = Gimnasios::all();
    
        // Retornamos la vista 'verProductos' y pasamos los productos como una variable llamada 'productos'
        return view('admin.gymAndBoxes.mostrar')->with('gimnasios', $gimnasios);
    }

    public function create()
    {
        // Lógica para mostrar el formulario de creación de una nueva empresa
        return view('admin.gymAndBoxes.crear');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'telefono' => 'required',
            'hora' => 'required',
            'descripcion' => 'required',
            'imagen' => 'required',
            'longitud' => 'required',
            'latitud' => 'required',
        ]);
        //Cargar la imagen
        $nombreImagenUnico='';
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagenUnico = Str::uuid() . "." . $imagen->getClientOriginalExtension();
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000); // Redimensionar la imagen
            $imagenPath = public_path('ImgGymBoxes') . '/' . $nombreImagenUnico;
            $imagenServidor->save($imagenPath); // Guardar la imagen redimensionada en la carpeta "public/uploads"
        }

        Gimnasios::create([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'horario' => $request->hora,
            'longitud' => $request->longitud,
            'latitud' => $request->latitud,
            'descripcion' => $request->descripcion,
            'fotografia' =>$nombreImagenUnico,
        ]);
        // Lógica para mostrar el formulario de creación de una nueva empresa

        //Se retorna a la vista de ejercicio
        return redirect()->route('gymBoxes.index');
    }
    public function edit($id_gym){
        //Se busca el ejercicio mediante el ID
        $gym= Gimnasios::find($id_gym);
        //Se retorna a la vista
        return view('admin.gymAndBoxes.editar',["gym"=>$gym]);
    }
    public function update(Request $request)
    {
        //Validaciones de formulario
        $this->validate($request, [
            'nombre' => 'required',
            'telefono' => 'required',
            'hora' => 'required',
            'descripcion' => 'required',
        ]);
        //Cargar la imagen
        $gym = Gimnasios::findOrFail($request->id);
        $nombreImagenUnico = $gym->fotografia;
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagenUnico = Str::uuid() . "." . $imagen->getClientOriginalExtension();
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000); // Redimensionar la imagen
            $imagenPath = public_path('ImgGymBoxes') . '/' . $nombreImagenUnico;
            $imagenServidor->save($imagenPath); // Guardar la imagen redimensionada en la carpeta "public/uploads"
        }
        
        //Actualizacion de datos
        Gimnasios::where('id', $request->id)->update([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'horario' => $request->hora,
            'longitud' => $request->longitud,
            'latitud' => $request->latitud,
            'descripcion' => $request->descripcion,
            'fotografia' =>$nombreImagenUnico,
        ]);
        //Se retorna a la vista de ejercicio
        return redirect()->route('gymBoxes.index');
    }

    //Funcion para eliminar el ejercicio
    public function delete($id_gym)
    {
        // Buscar el ejercicio por su ID
        $gymBoxes = Gimnasios::find($id_gym);

        // Verificar si existe la imagen asociada al ejercicio y borrarla si es el caso
        if ($gymBoxes->fotografia) {
            $imagenPath = public_path('ImgGymBoxes') . '/' . $gymBoxes->fotografia;
            if (file_exists($imagenPath)) {
                unlink($imagenPath); // Eliminar la imagen del servidor
            }
        }

        // Eliminar el ejercicio de la base de datos
        $gymBoxes->delete();

        return redirect()->route('gymBoxes.index')->with('success', 'Ejercicio eliminado correctamente');
    }

}
