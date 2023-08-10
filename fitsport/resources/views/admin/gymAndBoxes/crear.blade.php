@extends('layouts.app')

@section('titulo')
    Administrador Gym And Boxes
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
        <p id="titulo" class="ml-4 mb-0">Agregar Gym And Boxes</p>
    </div>

    <!-- Formulario -->
    <div class="rounded-xl text-white w-4/5 mb-8" style="background-color:rgba(53, 58, 80, 0.67); padding: 40px">
        <!-- Formulario para agregar Gym And Boxes -->
        <form action="{{route('addgymBoxes.store')}}" class="text-white rounded-lg p-4" enctype="multipart/form-data" method="POST" novalidate>
            @csrf

            <!-- Mensaje de sesión -->
            @if(session('mensaje'))
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    {{session('mensaje')}}
                </p>
            @endif

            <!-- Información del Gym And Boxes -->
            <div class="flex">
                <!-- Campo Nombre -->
                <div class="w-1/2 mr-2 mb-0">
                    <label for="nombre" class="text-lg font-bold">Nombre:</label>
                    <input style="color:black" name="nombre" value="{{old('nombre')}}" type="text" id="nombre" class="w-full mt-1 p-2 border border-white rounded-lg focus:outline-none focus:border-blue-300 @error ('nombre') border-red-500 @enderror" placeholder="Ingresa tu nombre">
                    @error('nombre')
                        <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>    
                    @enderror
                </div>

                <!-- Campo Teléfono -->
                <div class="w-1/2 mr-2 mb-0">
                    <label for="telefono" class="text-lg font-bold">Teléfono:</label>
                    <input type="number" style="color:black" id="telefono" name="telefono" class="w-full mt-1 p-2 border border-white rounded-lg focus:outline-none focus:border-blue-300 @error ('telefono') border-red-500 @enderror" value="{{old('telefono')}}" placeholder="Ingresa tu teléfono">
                    @error('telefono')
                        <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>    
                    @enderror
                </div>

                <!-- Campo Hora -->
                <div class="w-1/2 ml-2 mb-0">
                    <label for="hora" class="text-lg font-bold">Hora de apertura:</label>
                    <input type="time" name="hora" style="color:black" id="hora" class="w-full mt-1 p-2 border border-white rounded-lg focus:outline-none focus:border-blue-300 @error('hora') border-red-500 @enderror" value="{{old('hora')}}" placeholder="Ingresa la hora de apertura">
                    @error('hora')
                        <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>    
                    @enderror
                </div>
                <div class="w-1/2 ml-2 mb-0">
                    <label for="horaCierre" class="text-lg font-bold">Hora de cierre:</label>
                    <input type="time" name="horaCierre" style="color:black" id="horaCierre" class="w-full mt-1 p-2 border border-white rounded-lg focus:outline-none focus:border-blue-300 @error('horaCierre') border-red-500 @enderror" value="{{old('horaCierre')}}" placeholder="Ingresa la hora de cierre">
                    @error('horaCierre')
                        <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>    
                    @enderror
                </div>

                <!-- Campo Imagen -->
                <div class="w-1/2 ml-2">
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

            <!-- Descripción -->
            <div class="flex" >
                <div class="w-3/4 mr-2" style="width: 80%;">
                    <label for="descripcion" class="text-lg font-bold mt-0">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" style="color:black;" class="w-full mt-1 p-2 border border-white rounded-lg focus:outline-none focus:border-blue-300 @error('descripcion') border-red-500 @enderror" value="{{old('descripcion')}}" placeholder="Ingresa una descripción"></textarea>
                    @error('descripcion')
                        <p style="background-color: #f56565; color: #fff;margin-top: 0.5rem;border-radius: 0.5rem;font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>    
                    @enderror
                </div>
            </div>

            <!-- Código para el mapa -->
            <div id="map" style="height: 400px;">
            </div>
            <input type="hidden" id="latitud" name="latitud">
            <input type="hidden" id="longitud" name="longitud">

            <!-- Botones de acción -->
            <div class="flex justify-end mt-4">
                <button style="background-color: #FFDE59; width: 150px; text-align: center;" type="submit" class="px-4 py-2 mr-4 text-black font-semibold rounded-2xl hover:bg-blue-600">Agregar</button>
                <a href="{{route('gymBoxes.index')}}" type="submit" class="px-4 py-2 bg-white text-black font-semibold rounded-2xl hover:bg-blue-600" style="width: 150px; text-align: center;">Cancelar</a>
            </div>
        </form>
        <!-- Campo de búsqueda de dirección -->
        <div id="direccion-container">
            <input type="text" id="direccion" style="color:black"  class="w-full mt-1 p-2 rounded"  placeholder="Buscar dirección">
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

<!-- Script para el mapa -->
<script>
    let map;
    let marker;

    function initMap() {
        // Opciones del mapa
        const mapOptions = {
            center: { lat: 0, lng: 0 },
            zoom: 14,
            mapId: "c984a1c2512b6347",
        };
        // Crear el mapa con las opciones dadas
        map = new google.maps.Map(document.getElementById('map'), mapOptions);

        // Crear un marcador inicial con posición en latitud 0 y longitud 0
        marker = new google.maps.Marker({
            position: { lat: 0, lng: 0 },
            map: map,
            draggable: true
        });

        // Escuchar el evento 'dragend' para el marcador
        marker.addListener('dragend', function(event) {
            // Cuando el marcador cambie de posición, actualizar las coordenadas en el formulario
            document.getElementById('latitud').value = event.latLng.lat();
            document.getElementById('longitud').value = event.latLng.lng();
        });

        // Obtener el elemento de entrada para la dirección
        const input = document.getElementById('direccion');
        // Crear una caja de búsqueda de lugares de Google Maps
        const searchBox = new google.maps.places.SearchBox(input);

        // Escuchar el evento 'places_changed' cuando se seleccionen lugares en la caja de búsqueda
        searchBox.addListener('places_changed', function() {
            // Obtener los lugares seleccionados
            const places = searchBox.getPlaces();

            // Si no se seleccionó ningún lugar, salir de la función
            if (places.length === 0) {
                return;
            }

            // Obtener la ubicación del primer lugar seleccionado
            const ubicacion = places[0].geometry.location;
            // Centrar el mapa en la ubicación del lugar seleccionado
            map.setCenter(ubicacion);
            // Mover el marcador a la ubicación del lugar seleccionado
            marker.setPosition(ubicacion);

            // Actualizar los campos de latitud y longitud en el formulario con las coordenadas del lugar seleccionado
            document.getElementById('latitud').value = ubicacion.lat();
            document.getElementById('longitud').value = ubicacion.lng();
        });

        // Obtener la ubicación del usuario y centrar el mapa en ella al cargar la página
        obtenerUbicacionUsuario();
    }

    function obtenerUbicacionUsuario() {
        // Verificar si el navegador del usuario admite geolocalización
        if ("geolocation" in navigator) {
            // Obtener la posición del usuario
            navigator.geolocation.getCurrentPosition(function (position) {
                // Obtener las coordenadas de latitud y longitud
                const latitud = position.coords.latitude;
                const longitud = position.coords.longitude;
                // Crear una nueva ubicación con las coordenadas del usuario
                const ubicacionUsuario = new google.maps.LatLng(latitud, longitud);

                // Centrar el mapa en la ubicación del usuario
                map.setCenter(ubicacionUsuario);
                // Mover el marcador a la ubicación del usuario
                marker.setPosition(ubicacionUsuario);

                // Actualizar los campos de latitud y longitud en el formulario con las coordenadas del usuario
                document.getElementById('latitud').value = latitud;
                document.getElementById('longitud').value = longitud;
            });
        } else {
            // Mostrar un mensaje de alerta si el navegador no admite la geolocalización
            alert("Tu navegador no admite la geolocalización.");
        }
    }

    // Cuando se cargue el contenido del DOM, inicializar el mapa
    document.addEventListener('DOMContentLoaded', function() {
        initMap();
    });
</script>
@endsection
