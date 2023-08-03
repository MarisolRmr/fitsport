<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log; // Agrega esta línea al inicio del archivo

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\User;
use Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }
    
    public function store(Request $request) {
    
        //validaciones del formulario de registros
        $this->validate($request,[
            'nombre' => 'required|alpha',
            'apellido' => 'required|alpha',
            'telefono' => 'required|regex:/^[0-9]+$/|max:10',
            'fecha_nac' => 'required|date',
            'usuario' => 'required|unique:users|min:3|max:20|regex:/^\S*$/u', // No se permiten espacios en el usuario
            'correo' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
            'fotografia' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
        ]);
        $nombreImagenUnico='';
        if ($request->hasFile('fotografia')) {
            $fotografia = $request->file('fotografia');
            $nombreImagenUnico = Str::uuid() . "." . $fotografia->getClientOriginalExtension();
            $imagenServidor = Image::make($fotografia);
            $imagenServidor->fit(1000, 1000); // Redimensionar la imagen
            $imagenPath = public_path('uploads') . '/' . $nombreImagenUnico;
            $imagenServidor->save($imagenPath); // Guardar la imagen redimensionada en la carpeta "public/uploads"
        }

        //Invocar el modelo User para crear el registro
        

        User::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'fecha_nac' => $request->fecha_nac,
            'usuario' => $request->usuario,
            'correo' => $request->correo,
            'password' => Hash::make($request->password),
            'tipo_id' => 2,
            'fotografia' => $nombreImagenUnico, // Asignamos directamente el nombre de la imagen
        ]);

        //autenticar un usuario con el moetodo attemp
        auth()->attempt($request->only('usuario','password'));

        //redireccionamiento
        return redirect()->route('home');

        
    }
}
