@extends('layouts.appUser')

@section('titulo')
    Atleta Gimnasios
@endsection

@section('css')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDnW7dhpeqNoNOHeoQw6oLYHIXqk9W5YA&libraries=places&callback=initMap" async defer></script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap');
    
    #titulo {
        font-family: 'Poppins';
        font-size: 120%;
    }

    .swiper-container {
      width: 100%;
      height: 100%;
    }

    .swiper-slide {
      position: relative; /* Needed for the absolute positioned content */
      text-align: center;
      font-size: 18px;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden; /* Hide any overflowing content */
    }

    .swiper-slide img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
      filter: blur(10px); /* Apply blur effect to the image */
    }

    .slide-content {
      position: absolute;
      top: 90%; /* Center the content vertically */
      left: 50%; /* Center the content horizontally */
      transform: translate(-50%, -50%); /* Adjust for centering */
      background: linear-gradient(rgb(225 216 216 / 0%), #080808b5);
      padding: 10px;
      backdrop-filter: blur(1px); /* Apply blur to the background */
      width:100%;
      display:flex;
      justify-content:center;
      align-items:center;
    }
    .buscar:focus {
      outline: none; 
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
    .rating {
          font-size: 24px;
          color: white;
          cursor: pointer;
      }

    .starred {
        color: yellow;
    }

</style>
@endsection

@section('contenido_top')
<div class="absolute w-full top-0 h-75">
  <img src="{{ asset('img/admin.png') }}" alt="Background Image" class="w-full h-full object-cover opacity-60">
</div>
@endsection

@section('contenido')
<div style="font-family: 'Poppins';" class="w-full h-screen flex flex-col items-center justify-center overflow-auto">
  <div class="rounded-xl flex text-white items-center w-4/5 mb-4" style="background-color:rgba(53, 58, 80, 0.67); padding: 15px">
    <img src="{{ asset('img/cuadro.png') }}" alt="Imagen pequeña" class="h-8 w-8">
    <p id="titulo" class="ml-4 mb-0">Gimnasios and Boxes</p>
  </div>
</div>
<div style="font-family: 'Poppins';" class=" w-full h-screen flex  flex-col items-center justify-center overflow-auto ">
  <div class="rounded-xl text-white w-4/5 mb-8">
    
    <!-- Código para el mapa -->
    <div id="map" style="height: 400px;">
    </div>
    <input type="hidden" id="latitud" name="latitud">
    <input type="hidden" id="longitud" name="longitud">
    <!-- Campo de búsqueda de dirección -->
    <div id="direccion-container">
        <input type="text" id="direccion" style="color:black"  class="w-full mt-1 p-2 rounded"  placeholder="Buscar dirección">
    </div>
  </div>
</div>
<div style="font-family: 'Poppins';" class=" w-full h-screen flex  flex-col items-center justify-center overflow-auto ">
  <div class="flex w-4/5 justify-center"> 
    <div class="rounded-xl flex text-white items-center justify-center w-full mb-4 mr-4" style="background-color:rgba(53, 58, 80, 0.67); padding: 15px">
        <p id="titulo1" class="mb-0" >La motivación es lo que te pone en marcha, y el hábito es lo que hace que sigas</p> 
    </div>
    <div class="rounded-xl flex items-center w-1/2 mb-4" style="padding: 15px">
        <div class="bg-white p-2 rounded-xl w-full flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
            <input type="text" placeholder="Buscar Gimnasio" class="buscar sflex-grow p-2 rounded-xl" id="searchInput">
            
        </div>
    </div>
  </div>
  <br>
  <div class="rounded-xl text-white w-4/5 mb-8">
  <div id="cardsContainer" class="flex flex-wrap"> 
        @if (count($gimnasios) > 0)
            @foreach ($gimnasios as $gimnasio => $data)
                <div class="card text-white mb-8">
                    <div class="flex flex-col items-center">
                    <div class="flex text-white items-center justify-center w-full mb-2" >
                      <img src="{{ asset('img/cuadro.png') }}" alt="Imagen pequeña" class="h-8 w-8">
                      <p id="titulo" class="ml-4 mb-0">{{$data->nombre}}</p>
                    </div>
                        @if($data->fotografia)
                            <img src="{{ asset('ImgGymBoxes/' . $data->fotografia)}}" alt="fotografia de la noticia" class="max-w-full h-auto"  style="width: 180px; height: 180px; object-fit: cover; border-radius: 50%;">
                        @else
                            <img src="{{asset('img/SinImagen.jpg')}}" alt="Imagen de la marca" class="max-w-full h-auto" style="border-radius:50%; height:180px; fit:content; ">
                        @endif
                        @php
                            $totalCalificaciones = count($data->opiniones);
                            $sumaCalificaciones = 0;
                            
                            foreach ($data->opiniones as $opinion) {
                                $sumaCalificaciones += $opinion->calificacion;
                            }
                            
                            $promedioCalificaciones = ($totalCalificaciones > 0) ? $sumaCalificaciones / $totalCalificaciones : 0;
                            $promedioCalificaciones = number_format($promedioCalificaciones, 1);
                            $promedioTruncado = floor($promedioCalificaciones);
                        @endphp
                        
                        <div class="flex justify-center w-full ml-4" style="font-size: 25px">
                            <span class="mr-2">{{ $promedioCalificaciones }}</span>
                            @for ($i = 0; $i < $promedioTruncado; $i++)
                                <span class="star starred">★</span>
                            @endfor
                            @for ($i = $promedioTruncado; $i < 5; $i++)
                                <span class="star">★</span>
                            @endfor
                        </div>
                        <a href="{{route('gymBoxes.detalles',$data->id)}}" class="mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                    
                </div>
            @endforeach
        @endif
    </div>
    

    
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

        // Obtener la ubicación del usuario y centrar el mapa en ella
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var userLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                document.getElementById('latitud').value = position.coords.latitude;
                document.getElementById('longitud').value = position.coords.longitude;

                // Ícono personalizado para el marcador de tu ubicación actual
                var userIcon = {
                    url: 'https://www.iconpacks.net/icons/2/free-location-icon-2955-thumb.png',
                    scaledSize: new google.maps.Size(60, 60),
                };

                // Crear marcador para la ubicación del usuario
                userMarker = new google.maps.Marker({
                    position: userLocation,
                    map: map,
                    title: "Tu ubicación actual",
                    icon: userIcon, // Aplicar el ícono personalizado
                    draggable: true // Hacer el marcador arrastrable
                });
                var userInfoWindow = new google.maps.InfoWindow({
                    content: '<strong class="s">Tu ubicación actual</strong>'
                });
                // Escuchar el evento de clic en el marcador de usuario
                userMarker.addListener('click', function() {
                    userInfoWindow.open(map, userMarker);
                });
                // Escuchar el evento de arrastre del marcador de usuario
                userMarker.addListener('dragend', function(event) {
                    userLocation.lat = event.latLng.lat();
                    userLocation.lng = event.latLng.lng();
                    document.getElementById('latitud').value = event.latLng.lat();
                    document.getElementById('longitud').value = event.latLng.lng();
                });

                // Centrar el mapa en la ubicación del usuario
                map.setCenter(userLocation);
                searchNearbyGyms(userLocation);

                
            });
        }

        // Obtener el elemento de entrada para la dirección
        const input = document.getElementById('direccion');
        // Crear una caja de búsqueda de lugares de Google Maps
        const searchBox = new google.maps.places.SearchBox(input);

        // Escuchar el evento 'places_changed' cuando se seleccionen lugares en la caja de búsqueda
        searchBox.addListener('places_changed', function () {
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

            // Mover el marcador de usuario a la ubicación del lugar seleccionado
            userMarker.setPosition(ubicacion);
            document.getElementById('latitud').value = ubicacion.lat();
            document.getElementById('longitud').value = ubicacion.lng();
            // Realizar una búsqueda de gimnasios cercanos en la nueva ubicación
            searchNearbyGyms(ubicacion);
        });
    }

    function searchNearbyGyms(location) {
        // Borrar marcadores de gimnasios anteriores
        clearGymMarkers();

        // Realizar búsqueda de gimnasios cercanos
        var service = new google.maps.places.PlacesService(map);
        service.nearbySearch({
            location: location,
            radius: 5000,
            type: 'gym'
        }, function (results, status) {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                // Crear marcadores para los gimnasios encontrados
                results.forEach(function (place) {
                    var marker = new google.maps.Marker({
                        position: place.geometry.location,
                        map: map,
                        title: place.name
                    });

                    // Agregar el marcador a la lista de marcadores de gimnasios
                    gymMarkers.push(marker);

                    // Crear ventana de información para los gimnasios
                    var infoWindow = new google.maps.InfoWindow({
                        content: '<strong class="s">' + place.name + '</strong><br>' + '<strong>' + place.vicinity +'</strong><br>' 
                    });

                    // Escuchar el evento de clic en el marcador de gimnasio
                    marker.addListener('click', function () {
                        infoWindow.open(map, marker);
                    });
                });
            }
        });
    }

    function clearGymMarkers() {
        // Eliminar marcadores de gimnasios anteriores
        gymMarkers.forEach(function (marker) {
            marker.setMap(null);
        });
        gymMarkers = [];
    }

    // Inicializar el mapa cuando se cargue la página
    initMap();



</script>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
document.getElementById('searchInput').addEventListener('input', function(e) {
    const query = e.target.value;
    axios.get('/gimnasios/buscando', {
        params: {
            query: query
        }
    })
    .then(function(response) {
        const cardsContainer = document.getElementById('cardsContainer');
        cardsContainer.innerHTML = ''; // Limpiar contenedor

        response.data.forEach(data => {
            let imgSrc = data.fotografia ? `/ImgGymBoxes/${data.fotografia}` : '/img/SinImagen.jpg';
            // Calcular promedio de calificaciones
            let totalCalificaciones = data.opiniones.length;
            let sumaCalificaciones = 0;
            data.opiniones.forEach(opinion => {
                sumaCalificaciones += opinion.calificacion;
            });
            let promedioCalificaciones = totalCalificaciones > 0 ? sumaCalificaciones / totalCalificaciones : 0;
            promedioCalificaciones = promedioCalificaciones.toFixed(1); // Limitar a 1 decimal

            let promedioTruncado = Math.floor(promedioCalificaciones);

            // Crear tarjeta y agregarla al contenedor
            let card = `
            <div class="card text-white mb-8">
                <div class="flex flex-col items-center">
                    <div class="flex text-white items-center justify-center w-full mb-2" >
                      <img src="{{ asset('img/cuadro.png') }}" alt="Imagen pequeña" class="h-8 w-8">
                      <p id="titulo" class="ml-4 mb-0">${data.nombre}</p>
                    </div>
                    <img src="${imgSrc}" alt="Imagen del gimnasio" class="max-w-full h-auto" style="border-radius:50%; height:180px; fit:content">
                    <div class="rating flex justify-center" style="font-size:25px">
                    <span class="mr-2">${promedioCalificaciones }</span>
                        `;
            for (let i = 0; i < 5; i++) {
                if (i < promedioTruncado) {
                    card += '<span class="star starred">★</span>';
                } else {
                    card += '<span class="star">★</span>';
                }
            }
            card += `
                    </div>
                    <a href="${getDetallesUrl(data.id)}" class="mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>`;

            cardsContainer.innerHTML += card;
        });
    })
    .catch(function(error) {
        console.log(error);
    });
});

function getDetallesUrl(id) {
    return `/GymAndBoxes/${id}/detalle`;
}


</script>
@endsection
