@extends('layouts.app')

@section('titulo')
    Administrador Dashboard
@endsection

@section('css')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap');

    .dataTables_wrapper .dataTables_filter input {
        color: gray;
        border-radius: 20px;
        margin-left: 10px;
        outline-offset: 0px;
    }
    .dataTables_wrapper .dataTables_filter input:focus{
        border-radius: 20px;
        margin-left: 15px;
        color:white;
        outline-offset: 0px;
        border: 1px solid gray;
        outline: none;
        padding: 5px 15px;
    }
    .dataTables_wrapper .dataTables_length select option {
        color:black;
        border-radius: 20px;
        margin-top: 7px;
    }
    .dataTables_wrapper .dataTables_length select {
        border-radius: 17px;
        outline-offset: 0px;
        outline: none;
    }
  
    input[type="search"]::-webkit-search-cancel-button {
    display: none;

    } 
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled{
        color:gray !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover{
        color:gray !important;
    }
    .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_paginate{
        margin-top:10px;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current{
        border:none;
        background-color: gray;
        color: white !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover{
        border:none;
        background-color: gray;
        color: white !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 50px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        border: 1px solid transparent;
        background: #9BF1A0;
        color:black !important;
    }
    table.dataTable {
        border-radius: 20px;
    }
    #example {
        background-color: transparent;
        color: white;
        border-collapse: collapse;
        
    }
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 20px !important;
    }
    #example th,
    #example td,
    #example tr {
        border: 1px solid white;
        background-color: transparent;
    }
    .edit-button,
    .delete-button {
        display: inline-block;
        padding: 8px 12px;
        color: #ffffff;
        border-radius: 10px;
        text-decoration: none;
        margin-right: 5px;
        text-align: center;
    }

    .edit-button:hover,
    .delete-button:hover {
        color: white;
        background-color: #959697;
    }
    .actions-cell {
        text-align: center;
    }
    #titulo{
        font-family: 'Poppins';
        font-size: 120%;
    }
    .image-input-container {
        display: inline-block;
        position: relative;
        margin-left: 10%;
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
<div class=" w-full h-screen flex  flex-col items-center justify-center overflow-auto ">
    <div class="rounded-xl flex text-white items-center w-4/5 mb-4" style="background-color:rgba(53, 58, 80, 0.67); padding: 15px">
        <img src="{{asset('img/cuadro.png')}}" alt="Imagen pequeña" class="h-8 w-8">
        <p id="titulo" class="ml-4 mb-0">Agregar Entrenador</p>
    </div>
    

    <div class=" rounded-xl  text-white w-4/5 mb-8" style="background-color:rgba(53, 58, 80, 0.67); padding: 40px">
        <form action="{{'entrenador.create'}}">
        <div class="flex">
                <div class=" flex flex-col mb-2" style="width:80% !important">
                    <div class="mb-0 flex">
                        <!-- Campo Nombre -->
                        <div class="w-1/2 mr-2 mb-2">
                            <label for="nombre" class="text-lg font-bold">Nombre:</label>
                            <input style="color:black" name="nombre" value="{{old('nombre')}}" type="text" id="nombre" class="w-full mt-1 p-2 border border-white rounded-lg focus:outline-none focus:border-blue-300 @error ('nombre') border-red-500 @enderror" placeholder="Ingresa tu nombre">
                            @error('nombre')
                                <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                    {{$message}}
                                </p>    
                            @enderror
                        </div>

                        <!-- Campo Apellido -->
                        <div class="w-1/2 mr-2 mb-0">
                            <label for="telefono" class="text-lg font-bold">Telefono:</label>
                            <input style="color:black" name="telefono" value="{{old('telefono')}}" type="number" id="telefono" class="w-full mt-1 p-2 border border-white rounded-lg focus:outline-none focus:border-blue-300 @error ('telefono') border-red-500 @enderror" placeholder="Ingresa tu telefono">
                            @error('telefono')
                                <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                    {{$message}}
                                </p>    
                            @enderror
                        </div>
                        <div class="w-1/2 mr-2 mb-0">
                            <label for="hora" class="text-lg font-bold">Hora de entrada:</label>
                            <input style="color:black" name="hora" value="{{old('hora')}}" type="time" id="hora" class="w-full mt-1 p-2 border border-white rounded-lg focus:outline-none focus:border-blue-300 @error ('hora') border-red-500 @enderror" placeholder="Ingresa la hora de apertura">
                            @error('hora')
                                <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                    {{$message}}
                                </p>    
                            @enderror
                        </div>
                        <div class="w-1/2 mr-2 mb-0">
                            <label for="horaCierre" class="text-lg font-bold">Hora de salida:</label>
                            <input style="color:black" name="horaCierre" value="{{old('horaCierre')}}" type="time" id="horaCierre" class="w-full mt-1 p-2 border border-white rounded-lg focus:outline-none focus:border-blue-300 @error ('horaCierre') border-red-500 @enderror" placeholder="Ingresa la hora de cierre">
                            @error('horaCierre')
                                <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                    {{$message}}
                                </p>    
                            @enderror
                        </div>
                    </div>
                    <div class="mb-0 flex">
                        <!-- Descripción -->
                        <div class="flex" >
                            <div class="w-3/4 mr-2" style="width: 100%;">
                                <label for="gym" class="text-lg font-bold mt-0">Selecciona un Gym:</label>
                                <select id="gym" name="gym" style="color:black;width: 234%;" class="select2 w-full mt-1 p-2 border border-white rounded-lg focus:outline-none focus:border-blue-300 @error('gym') border-red-500 @enderror">
                                    <option value="">-- Selecciona un Gym --</option>
                                    @foreach ($gimnasios as $gimnasio)
                                        <option value="{{ $gimnasio->id }}">{{ $gimnasio->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('gym')
                                    <p style="background-color: #f56565; color: #fff;width: 265%; margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Campo Imagen -->
                <div class=" ml-2"  style="width:20% !important">
                    <div class="image-input-container">
                        <label for="imagen">
                            <i class="fas fa-camera" style="color: lightgray; font-size:40px"></i>
                            <span class="selected-image"></span>
                            <input type="file" class="@error('imagen') border-red-500 @enderror" id="imagen" name="imagen" value="{{old('imagen')}}" accept="image/*" onchange="handleImageUpload(event)" />
                            @error('imagen')
                                <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                    {{$message}}
                                </p>    
                            @enderror
                        </label>
                    </div> 
                </div>
            </div>
            
            <div class="flex text-end justify-end">
                <button style=" background-color:#FFDE59; " type="submit" class="mt-4 px-4 py-2 mr-4 text-black font-semibold rounded-2xl hover:bg-blue-600">Agregar</button>
                <a href="{{route('entrenador.index')}}" type="submit" class="mt-4 px-4 py-2 bg-white text-black font-semibold rounded-2xl hover:bg-blue-600">Cancelar</a>   
            </div>
        </form>
    </div>
</div>

@endsection

@section('js')
<!-- Función para manejar la carga de imágenes -->
<script>
    function handleImageUpload(event) {
        const input = event.target;
        const imageContainer = input.parentElement;
        const selectedImage = imageContainer.querySelector('.selected-image');

        // Obtener el archivo seleccionado
        const file = input.files[0];

        // Crear un objeto FileReader para leer el contenido del archivo
        const reader = new FileReader();

        // Cuando se termine de leer el archivo, se ejecutará esta función
        reader.onload = function (e) {
            // Establecer el fondo del elemento con la imagen seleccionada
            selectedImage.style.backgroundImage = `url(${e.target.result})`;
        };

        // Leer el contenido del archivo como una URL de datos
        reader.readAsDataURL(file);
    }
</script>

@endsection