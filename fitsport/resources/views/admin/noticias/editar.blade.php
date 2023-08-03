@extends('layouts.app')

@section('titulo')
    Administrador Noticias
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
    border-radius: 0.5rem;
    }
    .image-input-container label {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 200px;
    border: 2px solid white;
    cursor: pointer;
    background: #FFFFFF;
    border-radius: 0.5rem;
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
    border-radius: 0.5rem;
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
        border-radius: 0.5rem;
    }
    

    /* Muestra el icono de lápiz solo en hover y si hay una imagen seleccionada */
    .selected-image:hover .edit-icon {
        display: flex;
    }
    
</style>
@endsection
@section('contenido_top')
<div class="absolute bg-y-50 w-full top-0 bg-[url('{{asset ('img/admin.png')}}')] min-h-75">
  <span class="absolute top-0 left-0 w-full h-full bg-black opacity-60"></span>
</div>
@endsection

@section('contenido')
<div style="font-family: 'Poppins';" class="w-full h-screen flex flex-col items-center justify-center overflow-auto">
  <div class="rounded-xl flex text-white items-center w-4/5 mb-4" style="background-color:rgba(53, 58, 80, 0.67); padding: 15px">
    <img src="{{asset('img/cuadro.png')}}" alt="Imagen pequeña" class="h-8 w-8">
    <p id="titulo" class="ml-4 mb-0">Editar Noticia</p>
  </div>


  <div class=" rounded-xl  text-white w-4/5 mb-8" style="background-color:rgba(53, 58, 80, 0.67); padding: 40px">
    <form enctype="multipart/form-data"  class="text-white rounded-lg p-4" action="{{route('noticia.update', $noticia->id)}}"  method="POST" novalidate>
    @csrf
    <div class="flex flex-wrap mb-4 text-white">
        <div class="w-full md:w-1/2 md:pr-4 mb-4 md:mb-0">
        <label for="nombre" class="block text-white font-semibold">Nombre</label>
        <input style="color:black" name="nombre" value="{{$noticia->nombre}}" type="text" id="nombre" class="w-full p-2 border border-white rounded-lg focus:outline-none focus:border-blue-300 @error ('nombre') border-red-500 @enderror" placeholder="Ingrese el nombre de la noticia">
        @error('nombre')
        <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                {{$message}}
            </p>    
        @enderror
        </div>
        <div class="w-full md:w-1/2 md:pl-2">
        <label for="fecha" class="block text-white font-semibold">Fecha del evento</label>
        <input style="color:gray" name="fecha" value="{{$noticia->fecha}}" type="datetime-local" id="fecha" class="w-full p-2 border border-white rounded-lg focus:outline-none focus:border-blue-500 @error ('fecha') border-red-500 @enderror" placeholder="Ingrese la fecha de la noticia">
        @error('fecha')
        <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                {{$message}}
            </p>    
        @enderror
        </div>
    </div>
    <div class="mb-4">
        <label for="descripcion" class="block text-white font-semibold">Descripción</label>
        <textarea style="color:black" name="descripcion"  id="descripcion" class="w-full p-2 border border-white rounded-lg focus:outline-none focus:border-blue-500  @error ('descripcion') border-red-500 @enderror" placeholder="Ingrese una descripción para la noticia" value="{{$noticia->descripcion}}">{{$noticia->descripcion}}</textarea>
        @error('descripcion')
        <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                {{$message}}
            </p>    
        @enderror
    </div>
    <div class="mb-4">
        <label for="texto" class="block text-white font-semibold">Texto</label>
        <textarea style="color:black" name="texto"  id="texto" class="w-full p-2 border border-white rounded-lg focus:outline-none focus:border-blue-500 @error ('texto') border-red-500 @enderror" placeholder="Ingresa el contenido de la noticia" value="{{$noticia->texto}}">{{$noticia->texto}}</textarea>
        @error('texto')
        <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                {{$message}}
            </p>    
        @enderror
    </div>
    <!-- Sección para cargar una imagen -->
    <div class="image-input-container mb-5 w-full">
    <label for="imagen">
        <i class="fas fa-camera" style="color: lightgray; font-size:35px"></i>
        <span class="selected-image" style="background-image: url('{{ asset('noticias_img/' . $noticia->imagen) }}');">
            <span class="edit-icon">
                <i class="fas fa-pencil-alt" ></i>
            </span>
        </span>
        <input type="file" class=" @error ('imagen') border-red-500 @enderror" id="imagen" name="imagen"  value="{{ $noticia->imagen }}" accept="image/*" onchange="handleImageUpload(event)" />
        @error ('imagen')
        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
            {{$message}}
        </p>
        @enderror
    </label>
    </div>
    <div class="flex text-end justify-end">
        <button style=" background-color:#FFDE59; " type="submit" class="mt-4 px-4 py-2 mr-4 text-black font-semibold rounded-2xl hover:bg-blue-600">Guardar</button>
        <a href="{{route('noticias.index')}}" class="mt-4 px-4 py-2 bg-white text-black font-semibold rounded-2xl hover:bg-blue-600">Cancelar</a>   
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