@extends('layouts.app')

@section('titulo')
    Administrador Ejercitate
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
    .image-input-container {
    display: inline-block;
    position: relative;
    margin-left: 38%;
}
    .image-input-container label {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 2px solid #ccc;
        cursor: pointer;
        background: #FFFFFF;
    }
    .image-input-container label i {
        font-size: 50px;
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
</style>
@endsection

@section('contenido_top')
    <div class="absolute bg-y-50 w-full top-0 bg-[url('{{asset ('img/admin.png')}}')] min-h-75">
        <span class="absolute top-0 left-0 w-full h-full bg-black opacity-60"></span>
    </div>
@endsection

@section('contenido')
    <div style="font-family: 'Poppins';" class=" w-full h-screen flex  flex-col items-center justify-center overflow-auto ">
        <div class="rounded-xl flex text-white items-center w-4/5 mb-4" style="background-color:rgba(53, 58, 80, 0.67); padding: 15px">
            <img src="{{asset('img/cuadro.png')}}" alt="Imagen pequeña" class="h-8 w-8">
            <p id="titulo" class="ml-4 mb-0">Agregar Ejercicio</p>
        </div>
        
        <div class=" rounded-xl  text-white w-4/5 mb-8" style="background-color:rgba(53, 58, 80, 0.67); padding: 40px">
            <form action="{{route ('ejercicio.create.store')}}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="flex">
                    <div class="w-full mr-2">
                        <label for="nombre" class="text-lg font-bold">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" value="{{old('nombre')}}" class=" text-black w-full mt-1 p-2 rounded" placeholder="Ingresa tu nombre">
                        @error('nombre')
                            <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                {{$message}}
                            </p>    
                        @enderror
                    </div>
                    <div class="w-1/2 ml-2">
                        <div class="image-input-container">
                            <label for="imagen">
                            <i class="fas fa-camera" style="color: lightgray"></i>
                            <span class="selected-image"></span>
                            <input type="file" class="@error('imagen') border-red-500 @enderror" id="imagen" name="imagen" value="{{old('imagen')}}" accept="image/*" onchange="handleImageUpload(event)" />
                            @error('imagen')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
                                {{$message}}
                                </p>
                            @enderror
                            </label>
                        </div>
                    </div> 
                </div>
                <div class=" mb-4">
                    <label for="descripcion" class="block text-white font-semibold">Descripción</label>
                    <textarea style="color:black" name="descripcion" id="descripcion" value="{{old('descripcion')}}" class="w-full text-black p-2 border border-white rounded-lg focus:outline-none focus:border-blue-500" placeholder="Ingresa una descripción"></textarea>
                    @error('descripcion')
                        <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>    
                    @enderror
                </div>
                <div class=" mb-4">
                    <label for="explicacion" class="block text-white font-semibold">Explicación</label>
                    <textarea style="color:black" name="explicacion" id="explicacion" value="{{old('explicacion')}}"class="w-full p-2 text-black border border-white rounded-lg focus:outline-none focus:border-blue-500" placeholder="Ingresa una descripción"></textarea>
                    @error('explicacion')
                        <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>    
                    @enderror
                </div>
                
                <div class="flex text-end justify-end">
                    <button style=" background-color:#FFDE59; " type="submit" class="mt-4 px-4 py-2 mr-4 text-black font-semibold rounded-2xl hover:bg-blue-600">Agregar</button>
                    <a href="{{route('ejercicio.index')}}" type="submit" class="mt-4 px-4 py-2 bg-white text-black font-semibold rounded-2xl hover:bg-blue-600">Cancelar</a>   
                </div>
            </form>
            
        </div>
    </div>
@endsection

@section('js')
    <script>
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