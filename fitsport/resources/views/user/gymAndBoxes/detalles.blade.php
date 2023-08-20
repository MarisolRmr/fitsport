@extends('layouts.appUser')

@section('titulo')
    Ejercitate
@endsection

@section('css')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDnW7dhpeqNoNOHeoQw6oLYHIXqk9W5YA&libraries=places&callback=initMap" async defer></script>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

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
    /* Si no quieres un margen en el último card de cada fila */
    .card:nth-child(4n) {
        margin-right: 0;
    }
    .buscar:focus {
      outline: none; 
    }

    #map {
        height: 400px;
        border: 1px solid;
        border-radius: 20px;
    }
    strong{
      color:black;
    }
    .s{
      font-weight: 700;
    }
    #direccion-container {
        position: absolute;
        top: 177px;  
        left: 550px;
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
        outline:none;
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
<div style="font-family: 'Poppins';" class="w-full h-screen flex items-center justify-center overflow-auto ">
    <div class="flex items-start justify-center w-4/5">
        <div class="flex items-center justify-center w-1/3 p-4">
            <div class="text-white mb-2 p-2" style="border-radius: 50%; background-color:rgba(53, 58, 80, 0.67); padding: 27px; width: 100%">
                @if($gimnasio->fotografia)
                    <img class="w-full" src="{{ asset('ImgGymBoxes/' . $gimnasio->fotografia)}}" alt="Imagen de la gimnasio" style="border-radius: 50%; height: 200px">
                @else
                    <img src="{{ asset('img/SinImagen.jpg')}}" alt="Imagen de la gimnasio" style="border-radius: 50%; width: 180px; height: 180px;">
                @endif
            </div>
        </div>
        <div class="w-2/3 p-4 ">
            <div class="rounded-xl flex text-white items-center mb-1" style="background-color:rgba(53, 58, 80, 0.67); padding: 15px">
                <img src="{{asset('img/cuadro.png')}}" alt="Imagen pequeña" class="h-8 w-8">
                <p id="titulo" class="ml-4 mb-0 font-bold">{{$gimnasio->nombre}}</p>
            </div>
            <div class="rounded-xl text-white mb-8" style="background-color:rgba(53, 58, 80, 0.67); padding: 40px">
                <div class="w-full flex">
                    <div class="mr-2">
                        <p class="text-lg font-bold mb-1">Horario:</p>
                        <p class="text-lg ml-6 mb-2" style="text-align: justify; ">{{ date('g:i a', strtotime($gimnasio->horario)) }} - {{ date('g:i a', strtotime($gimnasio->horarioCierre)) }}</p>

                        @if($gimnasio->telefono)
                            <p class="text-lg font-bold mb-1">Teléfono:</p>
                            <p class="text-lg ml-6 mb-2" style="text-align: justify; ">{{ $gimnasio->telefono }}</p>
                        @endif

                        <p class="text-lg font-bold mb-1">Descripción:</p>
                        <p class="text-lg ml-6 mb-2" style="text-align: justify; ">{{ $gimnasio->descripcion }}</p>

                        <p class="text-lg" style="text-align: justify;">{{$gimnasio->texto}}</p>
                    </div>
                </div>
                @auth
                    @if(auth()->user()->tipo_id === 1)
                        <div class="flex text-end justify-end">
                            <a href="{{route('gymBoxes.index')}}" type="submit" class="mt-4 px-4 py-2 bg-white text-black font-semibold rounded-2xl hover:bg-blue-600">Regresar</a>
                        </div>
                    @endif
                @endauth
            </div>
            @if($gimnasio->latitud)
                <div id="map" style="height: 400px;"></div>
            @endif
        </div>
    </div>
</div>

    <div style="font-family: 'Poppins';" class=" w-full h-screen flex flex-col items-center justify-center overflow-auto ">
        <div class="rounded-xl w-4/5 flex text-white items-center mb-1" style="background-color:rgba(53, 58, 80, 0.67); padding: 15px">
            <img src="{{asset('img/cuadro.png')}}" alt="Imagen pequeña" class="h-8 w-8">
            <p id="titulo" class="ml-4 mb-0 font-bold">Entrenadores</p>
        </div> 
    </div>
@endsection

@section('js')
<script>
    var map;
    var userMarker;
    var gymMarkers = [];

    function initMap() {
        // Opciones del mapa
        var mapOptions = {
            zoom: 15,
            mapId: "c984a1c2512b6347",
        };

        // Crear el mapa en el elemento con id "map"
        map = new google.maps.Map(document.getElementById('map'), mapOptions);

        // Inicializar el servicio de búsqueda de lugares
        var service = new google.maps.places.PlacesService(map);

        // Obtener las coordenadas del gimnasio
        var latitud = {{$gimnasio->latitud}};
        var longitud = {{$gimnasio->longitud}};

        // Crear un marcador para el gimnasio
        var gymMarker = new google.maps.Marker({
            position: { lat: latitud, lng: longitud },
            map: map,
            title: "Ubicación del gimnasio",
        });

        // Agregar el marcador del gimnasio a la lista de marcadores
        gymMarkers.push(gymMarker);

        // Centrar el mapa en la ubicación del gimnasio
        map.setCenter({ lat: latitud, lng: longitud });
    }

    // Inicializar el mapa cuando se cargue la página
    initMap();
</script>
@endsection
