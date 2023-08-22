@extends(auth()->user()->tipo_id === 1 ? 'layouts.app' : 'layouts.appUser')


@section('titulo')
    Mi Perfil
@endsection
@section('css')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap');
    #titulo{
        font-family: 'Poppins';
        font-size: 120%;
    }
    input::placeholder,
    textarea::placeholder {
        color: gray; 
    }
    #fecha:focus{
        color:black !important;
    }
    .circle-container {
        position: absolute;
        width: 250px;
        height: 250px;
        margin-left: 8%;
        z-index:10;
        margin-top:-10%;
        border-radius: 50%;
        background-color: rgba(53, 58, 80, 0.67); 
        padding: 1.5em;
        display: flex;
    }

    .image-overlay-container {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .image-input-container label {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 200px;
    }
    .image-input-container label .selected-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background-size: cover;
        background-position: center;
    }
    .image-input-container input[type="file"] {
        display: none;
    }

    /* Estilo para el icono de lápiz */
    .edit-icon {
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        justify-content: center;
        align-items: center;
        color: white;
        font-size: 24px;
    }

    /* Estilo para el fondo gris o borroso en hover */
    .selected-image:hover::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); 
        border-radius: 50%;
    }
    

    /* Muestra el icono de lápiz solo en hover y si hay una imagen seleccionada */
    .selected-image:hover .edit-icon {
        display: flex;
    }

    #name{ 
        font-size: 20px; 
        font-family: 'Poppins', sans-serif; 
        background-color:rgba(53, 58, 80, 0.67); 
        padding: 10px; 
        width: 300px; 
        height: auto; 
        border-radius: 20px; 
        margin-left: 60px;
        margin-right: 75px; 
        margin-top: 120px;
    }
    #datos{
        font-size: 20px;
        font-family: 'Poppins', sans-serif;
    }
</style>
@endsection
@section('contenido_top')
    <div class="absolute bg-y-50 w-full top-0 bg-[url('{{asset ('img/admin.png')}}')] min-h-75">
        <span class="absolute top-0 left-0 w-full h-full bg-black opacity-60"></span>
    </div>
@endsection

@section('contenido')
<div class="w-full h-screen flex flex-col items-center justify-center overflow-auto">
    <form enctype="multipart/form-data" class="p-0 w-full" action="{{route('perfil.update', auth()->user()->id)}}"  method="POST" novalidate>
    @csrf
            
    <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="w-full h-1/2 max-w-full px-6 mt-0 lg:w-6/12 lg:flex-none">
            <img style="border-radius: 18px;" src="{{asset ('img/portada_perfil.png')}}" class="h-full w-full" alt="admin_dashboard" />   
            </div>
        </div>
        <div class="circle-container">
            <div class="image-overlay-container">
                <div class="image-input-container">
                    <label for="fotografia">
                    @if(auth()->user()->fotografia)
                    <span class="selected-image" style="background-image: url('{{ asset('uploads/' . auth()->user()->fotografia) }}');">
                        <span class="edit-icon">
                            <i class="fas fa-pencil-alt" ></i>
                        </span>
                    </span>
                    @else
                    <span class="selected-image" style="background-image: url('{{ asset('img/user.png') }}');">
                        <span class="edit-icon">
                            <i class="fas fa-pencil-alt" ></i>
                        </span>
                    </span>
                    @endif
                    <input type="file" class="@error('fotografia') border-red-500 @enderror" id="fotografia" name="fotografia" accept="image/*" onchange="handleImageUpload(event)" />
                    </label>
                </div>
            </div>
        </div>

    </div>
    <div class="flex w-full justify-center items-start  px-6">       
            <div id="name" class="rounded-xl flex text-white justify-center items-center mb-4 " >
                <img src="{{asset('img/cuadro.png')}}" alt="Imagen pequeña" class="h-6 w-6 ml-2 ">
                <p class="ml-4 mb-0">{{auth()->user()->usuario}}</p>
            </div>

            <div class="rounded-xl text-white mb-8 ml-2 mt-6" style="width: 55%; margin-left: 50px; background-color:rgba(53, 58, 80, 0.67); padding: 10px; font-size: 20px; margin-right: 35px; border-radius: 20px">

            <div id="datos" class="flex py-0 px-8 mb-2">
                <div>
                    <label class="mb-1" for="nombre">Nombre:</label><br>
                    <input style="color:black; width: 48%" class=" px-2 py-1 mb-2 mr-2 border border-white rounded-lg focus:outline-none focus:border-blue-300 @error ('nombre') border-red-500 @enderror" placeholder="Ingrese un nuevo nombre" type="text" id="nombre" name="nombre" value="{{auth()->user()->nombre}}">
                    <input style="color:black; width: 48%" class=" px-2 py-1 mb-2 border border-white rounded-lg focus:outline-none focus:border-blue-300 @error ('apellido') border-red-500 @enderror" placeholder="Ingrese un nuevo apellido"  type="text" id="apellido" name="apellido" value="{{auth()->user()->apellido}}" ><br>
                    @error('nombre')
                        <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>    
                    @enderror
                    @error('apellido')
                        <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>    
                    @enderror

                    <label class="mb-1" for="correo">Email:</label>
                    <input style="color:black" class="w-full px-2 py-1 mb-2 border border-white rounded-lg focus:outline-none focus:border-blue-300 @error ('correo') border-red-500 @enderror" placeholder="Ingrese un nuevo correo" type="email" id="correo" name="correo" value="{{auth()->user()->correo}}" ><br>
                    @error('correo')
                        <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>    
                    @enderror

                    <label class="mb-1" for="fecha_nac">Fecha de Nacimiento:</label>
                    <input style="color:black" class="w-full px-2 py-1 mb-2 border border-white rounded-lg focus:outline-none focus:border-blue-300 @error ('fecha_nac') border-red-500 @enderror" placeholder="Ingrese una nueva fecha de nacimiento" type="date" id="fecha" name="fecha_nac" value="{{ \Carbon\Carbon::parse(auth()->user()->fecha_nac)->format('Y-m-d') }}"  ><br>
                    @error('fecha_nac')
                        <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>    
                    @enderror

                    <label class="mb-1" for="telefono">Teléfono:</label>
                    <input style="color:black" class="w-full px-2 py-1 mb-2 border border-white rounded-lg focus:outline-none focus:border-blue-300 @error ('telefono') border-red-500 @enderror" placeholder="Ingrese un nuevo teléfono" type="text" id="telefono" name="telefono" value="{{auth()->user()->telefono}}" ><br>
                    @error('telefono')
                        <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>    
                    @enderror

                    <label class="mb-1" for="usuario">Usuario:</label>
                    <input style="color:black" class="w-full px-2 py-1 mb-2 border border-white rounded-lg focus:outline-none focus:border-blue-300 @error ('usuario') border-red-500 @enderror" placeholder="Ingrese un nuevo usuario" type="text" id="usuario" name="usuario" value="{{auth()->user()->usuario}}" ><br>
                    @error('usuario')
                        <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>    
                    @enderror

                    <label class="mb-1" for="password">Nueva contraseña:</label>
                    
                    <div class="w-full" style="position: relative; display: inline-block;">
                        <input style="color:black; padding-right:30px;" class="w-full px-2 py-1 mb-2 border border-white rounded-lg focus:outline-none focus:border-blue-300 @error ('password') border-red-500 @enderror" placeholder="Ingrese una nueva contraseña" type="password" id="password" name="password" oninput="toggleEyeIcon()">
                        <a onclick="show_hide_password()" id="eye-icon" style="cursor:pointer; display: none;"><i id="eye" class="fas fa-eye" style="color:black; position: absolute; top: 45%; right: 10px; transform: translateY(-50%);"></i></a>
                    </div><br>
                    @error('password')
                        <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>    
                    @enderror

                    
                    <label class="mb-1" for="password">Confirmar contraseña:</label>
                    <div class="w-full" style="position: relative; display: inline-block;">
                        <input style="color:black; padding-right:30px;" class="w-full px-2 py-1 mb-2 border border-white rounded-lg focus:outline-none focus:border-blue-300 @error ('password_confirmation') border-red-500 @enderror" placeholder="Ingrese un la contraseña otra vez" type="password" id="password_confirmation" name="password_confirmation" oninput="toggleEyeIcon()">
                        <a onclick="show_hide_password_conf()" id="eye-icon-conf" style="cursor:pointer; display: none;"><i id="eye-conf" class="fas fa-eye" style="color:black; position: absolute; top: 45%; right: 10px; transform: translateY(-50%);"></i></a>
                    </div><br>
                    @error('password_confirmation')
                        <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>    
                    @enderror

                </div>
            </div>
            <div class="flex text-end justify-end px-8 mb-4 w-full">
                <button style=" background-color:#FFDE59; " type="submit" class="mt-4 px-4 py-2 mr-4 text-black font-semibold rounded-2xl hover:bg-blue-600">Guardar</button>
                <a href="{{route('perfil.index')}}" class="mt-4 px-4 py-2 bg-white text-black font-semibold rounded-2xl hover:bg-blue-600">Cancelar</a>   
            </div>
            </div>
            
        </div>
        
    </form>
</div>

@endsection

@section('js')

<script>
    function show_hide_password() {
        var x = document.getElementById("password");
        
        var eye = document.getElementById("eye");
    
        if (x.type === "password") {
            x.type = "text";
            eye.classList.remove("fa-eye");
            eye.classList.add("fa-eye-slash");
        } else {
            x.type = "password";
            eye.classList.remove("fa-eye-slash");
            eye.classList.add("fa-eye");
        }
        
    }
    function show_hide_password_conf() {
        var y = document.getElementById("password_confirmation");
        
        var eye2 = document.getElementById("eye-conf");

        if (y.type === "password") {
            y.type = "text";
            eye2.classList.remove("fa-eye");
            eye2.classList.add("fa-eye-slash");
        } else {
            y.type = "password";
            eye2.classList.remove("fa-eye-slash");
            eye2.classList.add("fa-eye");
        }
    }
    function toggleEyeIcon() {
        var input = document.getElementById('password');
        var input2 = document.getElementById('password_confirmation');
        var icon = document.getElementById('eye-icon');
        var icon2 = document.getElementById('eye-icon-conf');

        if (input.value !== '') {
            icon.style.display = 'inline';
        } else {
            icon.style.display = 'none';
        }
        if (input2.value !== '') {
            icon2.style.display = 'inline';
        } else {
            icon2.style.display = 'none';
        }
    }
    function handleImageUpload(event) {
        const input = event.target;
        const imageContainer = input.parentElement;
        const selectedImage = imageContainer.querySelector('.selected-image');

        const file = input.files[0];
        const reader = new FileReader();

        reader.onload = function (e) {
        selectedImage.style.backgroundImage = `url(${e.target.result})`;
        };

        reader.readAsDataURL(file);
    }

</script>
@endsection