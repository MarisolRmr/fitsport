@extends('layouts.app')

@section('titulo')
    Administrador Nutriologo
@endsection

@section('css')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDnW7dhpeqNoNOHeoQw6oLYHIXqk9W5YA&libraries=places&callback=initMap" async defer></script>


<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap');

    input::placeholder,
    textarea::placeholder {
        color: gray!important; 
    }
    #hora:focus{
        color:black !important;
    }
   
    #titulo{
        font-family: 'Poppins'!important;
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
        background-color: rgba(0, 0, 0, 0.5); /* Puedes ajustar la opacidad según tus preferencias */
        border-radius: 50%;
    }
    

    /* Muestra el icono de lápiz solo en hover y si hay una imagen seleccionada */
    .selected-image:hover .edit-icon {
        display: flex;
    }
    #map {
        height: 400px;
        border: 1px solid;
        border-radius: 20px;
        margin-top: 20px;
    }
    #direccion-container {
        position: absolute;
        top: 510px; 
        left: 650px;
        z-index: 1;
    }

    #direccion {
        position: sticky;
        color: black;
        padding: 8px;
        border-radius: 5px;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        width: calc(200px);
    }
    #busqueda {
        position: sticky;
        top: 0;
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
        <p id="titulo" class="ml-4 mb-0">Agregar Nutriologo</p>
    </div>

    <!-- Formulario -->
    <div class="rounded-xl text-white w-4/5 mb-8" style="background-color:rgba(53, 58, 80, 0.67); padding: 40px">
        <!-- Formulario para agregar Gym And Boxes -->
        <form action="{{route('admNutriologo.store')}}" class="text-white rounded-lg p-4" enctype="multipart/form-data" method="POST" novalidate>
            @csrf

            <!-- Mensaje de sesión -->
            @if(session('mensaje'))
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    {{session('mensaje')}}
                </p>
            @endif

            <!-- Información del Gym And Boxes -->
            <div class="flex">
                <div class=" flex flex-col mb-2" style="width:80% !important">
                    <div class="mb-0 flex">
                        <!-- Campo Nombre -->
                        <div class="w-1/2 mr-2 mb-2">
                            <label for="nombre" class="text-lg font-bold">Nombre:</label>
                            <input style="color:black" name="nombre" value="{{$nutriologo->nombre ?? old('nombre')}}" type="text" id="nombre" class="w-full mt-1 p-2 border border-white rounded-lg focus:outline-none focus:border-blue-300 @error ('nombre') border-red-500 @enderror" placeholder="Ingresa tu nombre">
                            @error('nombre')
                                <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                    {{$message}}
                                </p>    
                            @enderror
                        </div>

                        <!-- Campo Apellido -->
                        <div class="w-1/2 mr-2 mb-0">
                            <label for="nombre" class="text-lg font-bold">Apellido:</label>
                            <input style="color:black" name="apellido" value="{{$nutriologo->apellido ?? old('apellido')}}" type="text" id="apellido" class="w-full mt-1 p-2 border border-white rounded-lg focus:outline-none focus:border-blue-300 @error ('apellido') border-red-500 @enderror" placeholder="Ingresa tu apellido">
                            @error('apellido')
                                <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                    {{$message}}
                                </p>    
                            @enderror
                        </div>
                    </div>
                    <div class="mb-0 flex">
                        <!-- Campo Teléfono -->
                        <div class="w-1/3 mr-2 mb-0">
                            <label for="telefono" class="text-lg font-bold">Teléfono:</label>
                            <input type="number" style="color:black" id="telefono" name="telefono" class="w-full mt-1 p-2 border border-white rounded-lg focus:outline-none focus:border-blue-300 @error ('telefono') border-red-500 @enderror" value="{{$nutriologo->telefono}}" placeholder="Ingresa tu teléfono">
                            @error('telefono')
                                <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                    {{$message}}
                                </p>    
                            @enderror
                        </div>

                        <!-- Campo Hora -->
                        <div class="w-1/3 ml-2 mb-0">
                            <label for="hora" class="text-lg font-bold">Hora de apertura:</label>
                            <input type="time" name="hora" style="color:black" id="hora" class="w-full mt-1 p-2 border border-white rounded-lg focus:outline-none focus:border-blue-300 @error('hora') border-red-500 @enderror" value="{{$nutriologo->horaEntrada}}" placeholder="Ingresa la hora de apertura">
                            @error('hora')
                                <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                    {{$message}}
                                </p>    
                            @enderror
                        </div>
                        <div class="w-1/3 ml-2 mb-0">
                            <label for="horaCierre" class="text-lg font-bold">Hora de cierre:</label>
                            <input type="time" name="horaCierre" style="color:black" id="horaCierre" class="w-full mt-1 p-2 border border-white rounded-lg focus:outline-none focus:border-blue-300 @error('horaCierre') border-red-500 @enderror" value="{{$nutriologo->horaSalida}}" placeholder="Ingresa la hora de cierre">
                            @error('horaCierre')
                                <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                    {{$message}}
                                </p>    
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Campo Imagen -->
                <div class=" ml-2"  style="width:20% !important">
                    <!-- Contenedor de carga de imagen -->
                    <div class="image-input-container">
                        <label for="imagen">
                            <i class="fas fa-camera" style="color: lightgray"></i>
                            <!-- Imagen seleccionada -->
                            <span class="selected-image" style="background-image: url('{{ asset('ImgGymBoxes/' . $gym->fotografia) }}');">
                                <!-- Icono para editar la imagen -->
                                <span class="edit-icon">
                                    <i class="fas fa-pencil-alt"></i>
                                </span>
                            </span>
                            <!-- Input para cargar la imagen -->
                            <input type="file" class="@error('imagen') border-red-500 @enderror" id="imagen" name="imagen" accept="image/*" onchange="handleImageUpload(event)" />
                            @error('imagen')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
                                    {{$message}}
                                </p>
                            @enderror
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex" >
                <div class="w-3/4 mr-2" style="width: 80%;">
                    <label for="cedula" class="text-lg font-bold mt-0">Cédula Profesional:</label>
                    <input type="number" style="color:black" id="cedula" name = "cedula" class="w-full mt-1 p-2 border border-white rounded-lg focus:outline-none focus:border-blue-300 @error('cedula') border-red-500 @enderror" value="{{$nutriologo->cedula}}" placeholder="Ingresa tu cedula">
                    @error('cedula')
                        <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>    
                    @enderror
                </div>
            </div>

            <!-- Código para el mapa -->
            <div id="map" style="height: 400px;">
            </div>
            <input type="hidden" id="latitud" name="latitud" value="{{ $nutriologo->latitud }}">
            <input type="hidden" id="longitud" name="longitud" value="{{ $nutriologo->longitud }}">

            <!-- Botones de acción -->
            <div class="flex justify-end mt-4">
                <button style="background-color: #FFDE59; width: 150px; text-align: center;" type="submit" class="px-4 py-2 mr-4 text-black font-semibold rounded-2xl hover:bg-blue-600">Agregar</button>
                <a href="{{route('admNutriologo.index')}}" type="submit" class="px-4 py-2 bg-white text-black font-semibold rounded-2xl hover:bg-blue-600" style="width: 150px; text-align: center;">Cancelar</a>
            </div>
        </form>
        <!-- Campo de búsqueda de dirección -->
        <div id="direccion-container">
            <input type="text" id="direccion" style="color:black"  class="w-full mt-6 p-2 rounded"  placeholder="Buscar dirección">
        </div>

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
        const editIcon = imageContainer.querySelector('.edit-icon'); // Elemento que contiene el ícono de edición

        const file = input.files[0];
        const reader = new FileReader();

        // Cuando la imagen se carga, se asigna la URL de la imagen como fondo del contenedor de la imagen seleccionada
        reader.onload = function (e) {
            selectedImage.style.backgroundImage = `url('${e.target.result}')`; // Agregar la URL aquí
            // Si hay una imagen cargada, se muestra el ícono de edición (ícono de lápiz), de lo contrario, se oculta
            if (e.target.result) {
                editIcon.style.display = 'flex'; // Mostrar el ícono de lápiz si hay imagen
            } else {
                editIcon.style.display = 'none'; // Ocultar el ícono de lápiz si no hay imagen
            }
        };

        // Lee el archivo de imagen como una URL de datos y lo carga en el contenedor de imagen seleccionada
        reader.readAsDataURL(file);
    }
</script>

<!-- Script para el mapa -->
<script>
    let map;
    let marker;

    // Función para inicializar el mapa con la ubicación del gimnasio actual
    function initMap() {
        const initialLat = parseFloat(document.getElementById('latitud').value);
        const initialLng = parseFloat(document.getElementById('longitud').value);
        
        const mapOptions = {
            center: { lat: initialLat, lng: initialLng },
            zoom: 14,
            mapId: "c984a1c2512b6347",
        };
        
        // Crea un nuevo mapa con las opciones especificadas y lo muestra en el elemento con el ID 'map'
        map = new google.maps.Map(document.getElementById('map'), mapOptions);

        // Crea un nuevo marcador en la ubicación del gimnasio actual y lo hace arrastrable
        marker = new google.maps.Marker({
            position: { lat: initialLat, lng: initialLng },
            map: map,
            draggable: true
        });

        // Cuando el marcador se arrastra, actualiza los campos de latitud y longitud en el formulario con las nuevas coordenadas
        marker.addListener('dragend', function(event) {
            document.getElementById('latitud').value = event.latLng.lat();
            document.getElementById('longitud').value = event.latLng.lng();
        });

        // Obtiene el elemento de entrada de dirección y crea una caja de búsqueda de lugares de Google Maps
        const input = document.getElementById('direccion');
        const searchBox = new google.maps.places.SearchBox(input);

        // Cuando se selecciona un lugar de la búsqueda, centra el mapa en esa ubicación y mueve el marcador allí
        searchBox.addListener('places_changed', function() {
            const places = searchBox.getPlaces();

            if (places.length === 0) {
                return;
            }

            const ubicacion = places[0].geometry.location;
            map.setCenter(ubicacion);
            marker.setPosition(ubicacion);

            // Actualiza los campos de latitud y longitud en el formulario con las coordenadas del lugar seleccionado
            document.getElementById('latitud').value = ubicacion.lat();
            document.getElementById('longitud').value = ubicacion.lng();
        });
    }

    // Cuando se carga el contenido del DOM, se llama a la función initMap para inicializar el mapa
    document.addEventListener('DOMContentLoaded', function() {
        initMap();
    });
</script>

@endsection