<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Agrega esta línea al inicio del archivo
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct(){
        //protegemos la url
        //al metodo index con el constructor le pasamos el parametro de autenticacion
        $this->middleware('auth');
    }
    public function index()
    {
        return view('layouts.perfil');
    }

    //Ruta para retornar la vista de editar perfil
    public function edit($id_perfil){
        //Se busca el usuario mediante el ID
        $perfil= User::find($id_perfil);
        //Se retorna a la vista
        return view('layouts.editarPerfil',["perfil"=>$perfil]);
    }
    

    //Función para actualizar los datos del noticia en la base de datos
    public function update(Request $request, $id)
    {
        
        //Cargar la imagen
        $nombreImagenUnico='';
        if ($request->password || $request->password_confirmation) {
            //Validaciones de formulario
            $this->validate($request, [
                'nombre' => 'required|regex:/^[a-zA-Z\s]+$/',
                'apellido' => 'required|regex:/^[a-zA-Z\s]+$/',
                'telefono' => 'required|regex:/^[0-9]+$/|max:10',
                'fecha_nac' => 'required|date',
                'usuario' => 'required|min:3|max:20|regex:/^\S*$/u', // No se permiten espacios en el usuario
                'correo' => 'required|email|max:60',
                'password' => 'required|confirmed|min:6',
                'password_confirmation' => 'required',
                'fotografia' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
            ]);
            if ($request->hasFile('fotografia')) {
                $fotografia = $request->file('fotografia');
                $nombreImagenUnico = Str::uuid() . "." . $imagen->getClientOriginalExtension();
                $imagenServidor = Image::make($imagen);
                $imagenServidor->fit(800, 200); // Redimensionar la imagen
                $imagenPath = public_path('uploads') . '/' . $nombreImagenUnico;
                $imagenServidor->save($imagenPath); // Guardar la imagen redimensionada en la carpeta "public/uploads"
                //Actualizacion de datos

                User::where('id', $id)->update([
                    'nombre' => $request->nombre,
                    'apellido' => $request->apellido,
                    'correo' => $request->correo,
                    'telefono' => $request->telefono,
                    'fecha_nac' => $request->fecha_nac,
                    'usuario' => $request->usuario,
                    'password' => Hash::make($request->password),
                    'fotografia' => $nombreImagenUnico,
                ]);
            }else{
                //Actualizacion de datos
                
                User::where('id', $id)->update([
                    'nombre' => $request->nombre,
                    'apellido' => $request->apellido,
                    'correo' => $request->correo,
                    'telefono' => $request->telefono,
                    'fecha_nac' => $request->fecha_nac,
                    'usuario' => $request->usuario,
                    'password' => Hash::make($request->password)
                ]);

            }
            auth()->attempt($request->only('usuario','password'));
        }else{
            //Validaciones de formulario
            $this->validate($request, [
                'nombre' => 'required|regex:/^[a-zA-Z\s]+$/',
                'apellido' => 'required|regex:/^[a-zA-Z\s]+$/',
                'telefono' => 'required|regex:/^[0-9]+$/|max:10',
                'fecha_nac' => 'required|date',
                'usuario' => 'required|min:3|max:20|regex:/^\S*$/u', // No se permiten espacios en el usuario
                'correo' => 'required|email|max:60',
                'fotografia' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
            ]);
            if ($request->hasFile('fotografia')) {
                $fotografia = $request->file('fotografia');
                $nombreImagenUnico = Str::uuid() . "." . $imagen->getClientOriginalExtension();
                $imagenServidor = Image::make($imagen);
                $imagenServidor->fit(800, 200); // Redimensionar la imagen
                $imagenPath = public_path('uploads') . '/' . $nombreImagenUnico;
                $imagenServidor->save($imagenPath); // Guardar la imagen redimensionada en la carpeta "public/uploads"
                //Actualizacion de datos

                User::where('id', $id)->update([
                    'nombre' => $request->nombre,
                    'apellido' => $request->apellido,
                    'correo' => $request->correo,
                    'telefono' => $request->telefono,
                    'fecha_nac' => $request->fecha_nac,
                    'usuario' => $request->usuario,
                    'fotografia' => $nombreImagenUnico,
                ]);
            }else{
                //Actualizacion de datos
                
                User::where('id', $id)->update([
                    'nombre' => $request->nombre,
                    'apellido' => $request->apellido,
                    'correo' => $request->correo,
                    'telefono' => $request->telefono,
                    'fecha_nac' => $request->fecha_nac,
                    'usuario' => $request->usuario,
                ]);

            }
        }
        
        //Se retorna a la vista de usuario
        return redirect()->route('perfil.index')->with('actualizada', 'Su perfil se ha actualizado correctamente');
    }
}
