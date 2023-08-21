@extends('layouts.appUser')

@section('titulo')
    Ejercitate
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
    .card {
        width: 24%;  /* 10% dividido entre 4 cards es 25%. Si descuentas un margen del 1% a la derecha de cada card, obtienes un ancho de 23% */
        margin-right: 1.3%; /* margen a la derecha */
        background-color: rgba(53, 58, 80, 0.67);
        padding: 40px;
        border-radius: 10px;
        box-sizing: border-box; /* Asegurarse de que el padding no afecte el ancho total */
    }
    /* Sin margen en el último card de cada fila */
    .card:nth-child(4n) {
        margin-right: 0;
    }
    .buscar:focus {
      outline: none; 
    }


</style>
@endsection

@section('contenido_top')
    <div class="absolute bg-y-50 w-full top-0 bg-[url('{{asset ('img/admin.png')}}')] min-h-75">
        <span class="absolute top-0 left-0 w-full h-full bg-black opacity-60"></span>
    </div>
@endsection

@section('contenido')
<!-- Contenedor principal -->
<div style="font-family: 'Poppins';" class="w-full h-screen flex flex-col items-center justify-center overflow-auto">
    <!-- Encabezado -->
    <div class="rounded-xl flex text-white items-center w-4/5 mb-4" style="background-color:rgba(53, 58, 80, 0.67); padding: 15px">
        <img src="{{asset('img/cuadro.png')}}" alt="Imagen pequeña" class="h-8 w-8">
        <p id="titulo" class="ml-4 mb-0">Editar metas</p>
    </div>

    <!-- Formulario -->
    <div class="rounded-xl text-white w-4/5 mb-8" style="background-color:rgba(53, 58, 80, 0.67); padding: 40px">
        <!-- Formulario para agregar Gym And Boxes -->
        <form action="{{route('metas.store')}}" class="text-white rounded-lg p-4" enctype="multipart/form-data" method="POST" novalidate>
            @csrf

            <!-- Mensaje de sesión -->
            @if(session('mensaje'))
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    {{session('mensaje')}}
                </p>
            @endif

            <!-- Información del Gym And Boxes -->
            <div class="flex">
                <div class="flex flex-col" style="width:60% !important">
                    
                    <!-- Campo Nombre -->
                    <div class="mb-8">
                        <label for="nombre" class="text-lg font-bold">Nombre:</label>
                        <input style="color:black;" name="nombre" value="{{$meta->nombre}}" type="text" id="nombre" class="w-full mt-1 p-2 border border-white rounded-lg focus:outline-none focus:border-blue-300 @error ('nombre') border-red-500 @enderror" placeholder="Ingresa tu nombre">
                        @error('nombre')
                            <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                {{$message}}
                            </p>    
                        @enderror
                    </div>

                    <!-- Campo Fecha -->
                    <div class="mb-8">
                        <label for="fecha" class="text-lg font-bold">Fecha:</label>
                        <input style="color:black;" name="fecha" value="{{$meta->fecha}}" type="date" id="fecha" class="w-full mt-1 p-2 border border-white rounded-lg focus:outline-none focus:border-blue-300 @error ('fecha') border-red-500 @enderror">
                        @error('fecha')
                            <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                {{$message}}
                            </p>    
                        @enderror
                    </div>
                    
                    <!-- Descripción -->
                    <div>
                        <label for="descripcion" class="text-lg font-bold mt-0">Descripción:</label>
                        <textarea id="descripcion" name="descripcion" style="color:black;" class="w-full mt-1 p-2 border border-white rounded-lg focus:outline-none focus:border-blue-300 @error('descripcion') border-red-500 @enderror" placeholder="Ingresa una descripción">{{$meta->descripcion}}</textarea>
                        @error('descripcion')
                            <p style="background-color: #f56565; color: #fff; margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                {{$message}}
                            </p>    
                        @enderror
                    </div>

                </div>

                <!-- Campo Imagen -->
                <div class="ml-2" style="width:40% !important">
                    <img src="{{asset('img/user/metas2.png')}}" alt="Descripción de la imagen" style="max-width:100%; height:auto;">
                </div>
            </div>
            <!-- Botones de acción -->
            <div class="flex justify-end mt-4">
                <button style="background-color: #FFDE59; width: 150px; text-align: center;" type="submit" class="px-4 py-2 mr-4 text-black font-semibold rounded-2xl hover:bg-blue-600">Agregar</button>
                <a href="{{route('gymBoxes.index')}}" type="submit" class="px-4 py-2 bg-white text-black font-semibold rounded-2xl hover:bg-blue-600" style="width: 150px; text-align: center;">Cancelar</a>
            </div>
        </form>
        

    </div>
</div>
@endsection

@section('js')


@endsection