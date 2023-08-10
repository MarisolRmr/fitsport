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
use Illuminate\Validation\Rule;
use Carbon\Carbon;
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
        //Cargar la fotografia
        $nombrefotografiaUnico='';
        if ($request->password || $request->password_confirmation) {
            //Validaciones de formulario
            $this->validate($request, [
                'nombre' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]+$/',
                'apellido' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚÑñ\s]+$/',
                'telefono' => 'required|regex:/^[0-9]+$/|max:10',
                'fecha_nac' => [
                    'required',
                    'date',
                    function ($attribute, $value, $fail) {
                        $fechaNacimiento = Carbon::createFromFormat('Y-m-d', $value);
                        $edadMinima = Carbon::now()->subYears(3);
            
                        if ($fechaNacimiento->greaterThan($edadMinima)) {
                            $fail('La fecha de nacimiento debe ser al menos 3 años anterior a la fecha actual.');
                        }
                    },
                ],
                'usuario' => [
                    'required',
                    'min:3',
                    'max:20',
                    'regex:/^\S*$/u',
                    Rule::unique('users')->ignore(auth()->user()->id ?? null),
                ],
                'correo' => [
                    'required',
                    'email',
                    'max:60',
                    Rule::unique('users')->ignore(auth()->user()->id ?? null),
                ],
                'password' => 'required|confirmed|min:6',
                'password_confirmation' => 'required',
                'fotografia' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
            ]);
            if ($request->hasFile('fotografia')) {
                // Obtener la imagen anterior
                $fotografiaAnterior = auth()->user()->fotografia;

                // Si la imagen anterior existe, borrarla
                if ($fotografiaAnterior) {
                    unlink(public_path('uploads') . '/' . $fotografiaAnterior);
                }

                // Guardar la nueva imagen
                $fotografia = $request->file('fotografia');
                $nombrefotografiaUnico = Str::uuid() . "." . $fotografia->getClientOriginalExtension();
                $fotografiaServidor = Image::make($fotografia);
                $fotografiaServidor->fit(1000, 1000); // Redimensionar la fotografia
                $fotografiaPath = public_path('uploads') . '/' . $nombrefotografiaUnico;
                $fotografiaServidor->save($fotografiaPath); // Guardar la fotografia redimensionada en la carpeta "public/uploads"

                // Actualizar los datos del usuario
                auth()->user()->fotografia = $nombrefotografiaUnico;
                auth()->user()->save();
                //Actualizacion de datos

                User::where('id', $id)->update([
                    'nombre' => $request->nombre,
                    'apellido' => $request->apellido,
                    'telefono' => $request->telefono,
                    'fecha_nac' => $request->fecha_nac,
                    'usuario' => $request->usuario,
                    'password' => Hash::make($request->password),
                    'fotografia' => $nombrefotografiaUnico,
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
                'nombre' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÑñÚ\s]+$/',
                'apellido' => 'required|regex:/^[a-zA-ZáéíóúÁÉÑñÍÓÚ\s]+$/',
                'telefono' => 'required|regex:/^[0-9]+$/|max:10',
                'fecha_nac' => [
                    'required',
                    'date',
                    function ($attribute, $value, $fail) {
                        $fechaNacimiento = Carbon::createFromFormat('Y-m-d', $value);
                        $edadMinima = Carbon::now()->subYears(3);
            
                        if ($fechaNacimiento->greaterThan($edadMinima)) {
                            $fail('La fecha de nacimiento debe ser al menos 3 años anterior a la fecha actual.');
                        }
                    },
                ],
                'usuario' => [
                    'required',
                    'min:3',
                    'max:20',
                    'regex:/^\S*$/u',
                    Rule::unique('users')->ignore(auth()->user()->id ?? null),
                ],
                'correo' => [
                    'required',
                    'email',
                    'max:60',
                    Rule::unique('users')->ignore(auth()->user()->id ?? null),
                ],
                'fotografia' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
            ]);
            if ($request->hasFile('fotografia')) {
                // Obtener la imagen anterior
                $fotografiaAnterior = auth()->user()->fotografia;

                // Si la imagen anterior existe, borrarla
                if ($fotografiaAnterior) {
                    unlink(public_path('uploads') . '/' . $fotografiaAnterior);
                }

                // Guardar la nueva imagen
                $fotografia = $request->file('fotografia');
                $nombrefotografiaUnico = Str::uuid() . "." . $fotografia->getClientOriginalExtension();
                $fotografiaServidor = Image::make($fotografia);
                $fotografiaServidor->fit(1000, 1000); // Redimensionar la fotografia
                $fotografiaPath = public_path('uploads') . '/' . $nombrefotografiaUnico;
                $fotografiaServidor->save($fotografiaPath); // Guardar la fotografia redimensionada en la carpeta "public/uploads"

                // Actualizar los datos del usuario
                auth()->user()->fotografia = $nombrefotografiaUnico;
                auth()->user()->save();
                //Actualizacion de datos

                User::where('id', $id)->update([
                    'nombre' => $request->nombre,
                    'apellido' => $request->apellido,
                    'correo' => $request->correo,
                    'telefono' => $request->telefono,
                    'fecha_nac' => $request->fecha_nac,
                    'usuario' => $request->usuario,
                    'fotografia' => $nombrefotografiaUnico,
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
