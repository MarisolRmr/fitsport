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
    .rating {
          font-size: 24px;
          color: white;
          cursor: pointer;
      }

    .starred {
        color: #FFDE59;
    }

</style>
@endsection

@section('contenido_top')
    <div class="absolute bg-y-50 w-full top-0 bg-[url('{{asset ('img/admin.png')}}')] min-h-75">
        <span class="absolute top-0 left-0 w-full h-full bg-black opacity-60"></span>
    </div>
@endsection

@section('contenido')
<div style="font-family: 'Poppins';" class=" w-full h-screen flex flex-col items-center justify-center overflow-auto ">
    <div class="rounded-xl w-4/5 flex text-white items-center mb-1" style=" padding: 15px">
    @auth
        @if(auth()->user()->tipo_id === 2)
        <a href="{{ route('gymBoxes.index_atleta') }}" class="flex items-start text-white justify-start mb-4 font-bold w-4/5">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Volver
        </a>
        @endif
    @endauth
    </div> 
</div>
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
    <div style="font-family: 'Poppins';" class=" w-full h-screen flex flex-col items-center justify-center overflow-auto ">
    <div class="rounded-xl w-4/5 flex text-white items-center mb-1" style=" padding: 15px">
        
    @if (count($gimnasio->entrenadores) > 0)
    <div class="rounded-xl text-white w-4/5 mb-8">
        <div id="cardsContainer" class="flex flex-wrap"> 
        @foreach ($gimnasio->entrenadores as $entrenador => $data )
            <div class="card text-white mb-8">
                <div class="flex flex-col items-center">
                <div class="flex text-white items-center justify-center w-full mb-2" >
                    <img src="{{ asset('img/cuadro.png') }}" alt="Imagen pequeña" class="h-8 w-8">
                    <p id="titulo" class="ml-4 mb-0">{{$data->nombre}}</p>
                </div>
                    @if($data->fotografia)
                        <img src="{{ asset('ImgEntrenador/' . $data->fotografia)}}" alt="fotografia del entrenaodor" class="max-w-full h-auto"  style="width: 120px; height: 120px; object-fit: cover; border-radius: 50%;">
                    @else
                        <img src="{{asset('img/SinImagen.jpg')}}" alt="Imagen de la marca" class="max-w-full h-auto" style="border-radius:50%; height:180px; fit:content; ">
                    @endif
                    <a href="{{route('gymBoxes.detalles',$data->id)}}" class="mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
                
            </div>
        @endforeach
        </div>
    </div>
    @else
    <div style="font-family: 'Poppins';" class=" mb-4 w-full h-screen flex flex-col items-center justify-center overflow-auto ">
        <div class="rounded-xl w-4/5 flex text-white items-center mb-1" style="background-color:rgba(53, 58, 80, 0.67); padding: 15px">
            <p id="titulo" class="ml-4 mb-0 font-bold">No hay entrenadores en este gimnasio.</p>
        </div> 
    </div>
    @endif
    </div> 
    </div>
    
</div>
<!-- Mensaje de éxito con alerta SweetAlert -->
@if(session('success'))
    <script>
        Swal.fire({
            title: 'Éxito',
            text: '{{ session('success') }}',
            icon: 'success',
            timer: 4000, 
            timerProgressBar: true,
            showConfirmButton: false,
        });
    </script>
@endif
<div style="font-family: 'Poppins';" class=" w-full h-screen flex flex-col items-center justify-center overflow-auto ">
    <div class="rounded-xl w-4/5 flex text-white items-center mb-1" style="background-color:rgba(53, 58, 80, 0.67); padding: 15px">
        <img src="{{asset('img/cuadro.png')}}" alt="Imagen pequeña" class="h-8 w-8">
        <p id="titulo" class="ml-4 mb-0 font-bold">Opiniones</p>
    </div> 
</div>
<form action="{{route('opinion.store')}}"  method="POST" novalidate>
    @csrf
    <div style="font-family: 'Poppins';" class=" w-full h-screen flex flex-col items-center justify-center overflow-auto">
        <div class="flex w-full w-4/5">
            <div class="rounded-xl w-full mb-1 text-white items-center" style="background-color: rgba(53, 58, 80, 0.67); padding: 15px">
                <div class="flex items-center">
                    <label for="descripcion" class="text-lg text-white font-bold">Puedes calificar a {{$gimnasio->nombre}}</label>
                    <div class="rating flex justify-start ml-4" style="font-size: 35px"> 
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                    </div>
                    <input type="hidden" name="calificacion" class="starren" value="0">
                    @error('calificacion')
                    <p style="background-color: #f56565; color: #fff; margin-top: 0.5rem; border-radius: 0.5rem; font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{$message}}
                    </p>
                    @enderror
                    <input type="hidden" name="user_id"  value="{{ auth()->user()->id }}">
                    @error('user_id')
                    <p style="background-color: #f56565; color: #fff; margin-top: 0.5rem; border-radius: 0.5rem; font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{$message}}
                    </p>
                    @enderror
                    <input type="hidden" name="gimnasio_id"  value="{{$gimnasio->id}}">
                    @error('gimnasio_id')
                    <p style="background-color: #f56565; color: #fff; margin-top: 0.5rem; border-radius: 0.5rem; font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{$message}}
                    </p>
                    @enderror
                </div>
                <textarea style="color: black" name="descripcion" value="{{old('descripcion')}}" type="text" id="descripcion" class="w-full mt-1 p-2 border border-white rounded-lg focus:outline-none focus:border-blue-300 @error ('descripcion') border-red-500 @enderror" placeholder="Agrega un comentario"></textarea>
                @error('nombre')
                    <p style="background-color: #f56565; color: #fff; margin-top: 0.5rem; border-radius: 0.5rem; font-size: 0.875rem; padding: 0.5rem; text-align: center;" class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{$message}}
                    </p>
                @enderror
                <div class="flex justify-end mt-1">
                    <button style="background-color: #FFDE59; width: 280px; text-align: center;" type="submit" class="px-4 py-2 text-black font-semibold rounded-2xl hover:bg-blue-600">Agregar Comentario</button>
                </div>
                
            </div>
        </div>
    </div>
</form>
    
    @if (count($opiniones) > 0)

    <div style="font-family: 'Poppins';" class="w-full h-screen flex items-center justify-center overflow-auto">
    <div class="rounded-xl w-4/5 flex flex-col text-white items-start mb-1" style="background-color: rgba(53, 58, 80, 0.67); padding: 15px">
        @php
            $totalCalificaciones = count($opiniones);
            $sumaCalificaciones = 0;
            
            foreach ($opiniones as $opinion) {
                $sumaCalificaciones += $opinion->calificacion;
            }
            
            $promedioCalificaciones = ($totalCalificaciones > 0) ? $sumaCalificaciones / $totalCalificaciones : 0;
            $promedioCalificaciones = number_format($promedioCalificaciones, 1);
            $promedioTruncado = floor($promedioCalificaciones);
        @endphp
        
        <div class="flex justify-center w-full ml-4" style="font-size: 40px">
            <span class="mr-2">{{ $promedioCalificaciones }}</span>
            @for ($i = 0; $i < $promedioTruncado; $i++)
                <span class="star starred">★</span>
            @endfor
            @for ($i = $promedioTruncado; $i < 5; $i++)
                <span class="star">★</span>
            @endfor
        </div>

        @foreach ($opiniones as $opinion)
            <div class="flex items-center">
                @if ($opinion->user->fotografia)
                    <img src="{{ asset('uploads/' . $opinion->user->fotografia) }}" alt="Imagen pequeña" class="h-12 w-12" style="border-radius: 50%">
                @else
                    <img src="{{ asset('img/user.png') }}" alt="Imagen pequeña" class="h-12 w-12">
                @endif
                <div>
                    <p id="titulo" class="ml-4 m-0 font-bold">{{ $opinion->user->usuario }}</p>
                    <div class="flex justify-start ml-4" style="font-size: 20px">
                        @for ($i = 0; $i < $opinion->calificacion; $i++)
                            <span class="star starred">★</span>
                        @endfor
                        @for ($i = $opinion->calificacion; $i < 5; $i++)
                            <span class="star">★</span>
                        @endfor
                    </div>
                </div>
            </div>
            <p class="mb-2">{{ $opinion->descripcion }}</p>
            <div style=" width: 100%; border-radius: 5px;height: 2px; background-color: #dde2e782;" class="mb-2" ></div> 
        @endforeach
        </div>
    </div>


    @else
    <div style="font-family: 'Poppins';" class=" mb-4 w-full h-screen flex flex-col items-center justify-center overflow-auto ">
        <div class="rounded-xl w-4/5 flex text-white items-center mb-1" style="background-color:rgba(53, 58, 80, 0.67); padding: 15px">
            <p id="titulo" class="ml-4 mb-0 font-bold">Aún no hay opiniones.</p>
        </div> 
    </div>
    @endif
    
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

<script>
    const ratings = document.querySelectorAll(".rating");

    ratings.forEach(rating => {
        const stars = rating.querySelectorAll(".star");
        const calificacionInput = rating.closest(".rounded-xl").querySelector(".starren"); // Encuentra el campo oculto para la calificación

        stars.forEach(star => {
            star.addEventListener("click", () => {
                stars.forEach((s, index) => {
                    if (index <= Array.from(stars).indexOf(star)) {
                        s.classList.add("starred");
                    } else {
                        s.classList.remove("starred");
                    }
                });

                const starredStars = rating.querySelectorAll(".star.starred").length;
                calificacionInput.value = starredStars; // Actualiza el valor del campo oculto con la cantidad de estrellas seleccionadas
            });
        });
    });
</script>

@endsection
