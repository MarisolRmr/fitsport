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
<div class=" w-full h-screen flex  flex-col items-center justify-center overflow-auto ">
    <div class="rounded-xl flex text-white items-center w-4/5 mb-4" style="background-color:rgba(53, 58, 80, 0.67); padding: 15px">
        <img src="{{asset('img/cuadro.png')}}" alt="Imagen pequeña" class="h-8 w-8">
        <p id="titulo" class="ml-4 mb-0">Agregar Gym And Boxes</p>
    </div>
    

    <div class=" rounded-xl  text-white w-4/5 mb-8" style="background-color:rgba(53, 58, 80, 0.67); padding: 40px">
    <form action="{{route('addgymBoxes.store')}}" method="POST" novalidate>
        @csrf

        @if(session('mensaje'))
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                {{session('mensaje')}}
            </p>
        @endif
    <div class="flex">
        <div class="w-1/2 mr-2 mb-0">
            <label for="nombre" class="text-lg font-bold">Nombre:</label>
            <input type="text" id="nombre" style="color:black" name="nombre" class="w-full mt-1 p-2 rounded @error('nombre') border-red-500 @enderror" value="{{old('nombre')}}" placeholder="Ingresa tu nombre">
            @error('nombre')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
            @enderror  
        </div>
        <div class="w-1/2 mr-2 mb-0">
            <label for="telefono" class="text-lg font-bold">Teléfono:</label>
            <input type="number" style="color:black" id="telefono" name = "telefono"class="w-full mt-1 p-2 rounded  @error('telefono') border-red-500 @enderror" value="{{old('telefono')}}" placeholder="Ingresa tu teléfono">
            @error('nombre')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
            @enderror  
        </div>
        <div class="w-1/2 ml-2 mb-0">
            <label for="hora" class="text-lg font-bold">Hora:</label>
            <input type="time" name="hora" style="color:black" id="hora" class="w-full mt-1 p-2 rounded @error('hora') border-red-500 @enderror" value="{{old('hora')}}" placeholder="Ingresa la hora">
            @error('hora')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
            @enderror 
        </div>
        <div class="w-1/2 ml-2">
            <div class="image-input-container mb-5 w-full">
                <label for="fotografia">
                <i class="fas fa-camera" style="color: lightgray; font-size:40px"></i>
                <span class="selected-image"></span>
                <input type="file" class="rounded-2xl border border-white @error ('fotografia') border-red-500 @enderror" id="fotografia" name="fotografia" value="{{old('fotografia')}}" accept="image/*" onchange="handleImageUpload(event)" />
                @error ('fotografia')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
                    {{$message}}
                </p>
                @enderror
                </label>
            </div> 
        </div>
    </div>
    <div class="flex">
        <div class="w-3/4 mr-2">
            <label for="descripcion" class="text-lg font-bold mt-0">Descripción:</label>
            <textarea id="descripcion" name="descripcion" style="color:black" class="w-full mt-0 p-2 rounded @error('descripcion') border-red-500 @enderror" value="{{old('descripcion')}}" placeholder="Ingresa una descripción"></textarea>
            @error('descripcion')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
            @enderror 
        </div>
    </div>
    <div class="flex justify-end mt-4">
        <button style="background-color: #FFDE59;" type="submit" class="px-4 py-2 mr-4 text-black font-semibold rounded-2xl hover:bg-blue-600">Agregar</button>
        <a href="{{route('gymBoxes.index')}}" type="submit" class="px-4 py-2 bg-white text-black font-semibold rounded-2xl hover:bg-blue-600">Cancelar</a>
    </div>
</form>



    </div>
</div>

	<!-- Importar el archivo JavaScript de Bootstrap -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	<!-- Función para manejar la carga de imágenes -->
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