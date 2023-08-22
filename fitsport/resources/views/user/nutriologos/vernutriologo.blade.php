@extends('layouts.app')

@section('titulo')
    Nutriologo {{$nutriologo->nombre}} {{$nutriologo->apellido}}
@endsection
@section('css')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDnW7dhpeqNoNOHeoQw6oLYHIXqk9W5YA&libraries=places&callback=initMap" async defer></script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap');
    #titulo{
        font-family: 'Poppins';
        font-size: 120%;
    }
    .circle-container {
        position: absolute;
        width: 250px;
        height: 250px;
        margin-left: 8%;
        z-index:10;
        margin-top:-10%;
        border-radius: 50%;
        background-color: rgba(53, 58, 80, 0.67); /* Establece el color de fondo del círculo con opacidad */
        padding: 1.5em;
        display: flex;
    }
    .circle-container img {
        max-width: 100%;
        max-height: 100%;
        border-radius: 50%;
        
    }
    #nombre{ 
        font-size: 20px; 
        font-family: 'Poppins', sans-serif; 
        background-color:rgba(53, 58, 80, 0.67); 
        padding: 10px; 
        width: 300px; 
        height: auto; 
        border-radius: 20px; 
        margin-left: 60px;
        margin-right: 75px; 
        position: absolute; /* Posiciona el elemento de manera absoluta */
        top: 80%;  /* Desplaza el elemento 10px hacia arriba respecto a su posición original */
        left: 60px; Ajusta la posición horizontal si es necesario
        
    }
    #datos{
        font-size: 20px;
        font-family: 'Poppins', sans-serif;
        
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
<div class="w-full h-screen flex flex-col items-center justify-center overflow-auto">
    <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="w-full h-1/2 max-w-full px-6 mt-0 lg:w-6/12 lg:flex-none">
            <img style="border-radius: 18px;" src="{{asset ('img/portada_perfil.png')}}" class="h-full w-full" alt="admin_dashboard" />   
            </div>
        </div>
        <div class="circle-container" >
            @if($nutriologo->fotografia)
                <img class="mx-0 my-0" src="{{ asset('ImgNutriologo/' . $nutriologo->fotografia) }}" alt="Foto de perfil">
            @else
                <img class="mx-0 my-0" src="{{ asset('img/user.png')}}"></img>
            @endif
        </div>
    </div>
    
    <div class="flex w-full justify-center   px-6">
        <div id="nombre" class="rounded-xl flex text-white justify-center items-center mb-4 " >
            <img src="{{asset('img/cuadro.png')}}" alt="Imagen pequeña" class="h-6 w-6 ml-2 ">
            <p class="ml-4 mb-0">{{$nutriologo->nombre}} {{$nutriologo->apellido}}</p>
        </div>

        <div id="cardDatos" class="rounded-xl text-white mb-8 ml-2 mt-6" style="width: 55%; margin-left: 35%; background-color:rgba(53, 58, 80, 0.67); padding: 10px; font-size: 20px; margin-right: 35px; border-radius: 20px">
            {{-- <div class="w-full flex justify-end items-start">
                <a id="editar-icono" href="{{route('perfil.editar',auth()->user()->id)}}" class="text-end mr-2"  ><i class="fas fa-pencil-alt" ></i></a>
            </div> --}}
            <div id="datos" class="flex py-0 px-5 mb-4 ">
                <table>
                    <tbody>
                        
                        <tr>
                            <td>Teléfono:</td>
                            <td>{{$nutriologo->telefono}}</td>
                        </tr>
                        <tr>
                            <td>Cedula Profesional: </td>
                            <td>{{$nutriologo->cedula}}</td>
                        </tr>
                        <tr>
                            <td>Horario: </td>
                            <td>{{$nutriologo->horaEntrada}} - {{$nutriologo->horaSalida}}</td>
                        </tr>
                    </tbody>

                </table>
                

            </div>
            <p id="datos" class="ml-4 mb-0">Ubicación:</p>
            <input type="text" id="latitud" value="{{ $nutriologo->latitud }}" hidden>
            <input type="text" id="longitud" value="{{$nutriologo->longitud }}" hidden>

            <div id="map" clas="w-full"style="height: 400px;">
            </div>
        </div>
    </div>

</div>

@endsection

@section('js')

<script>
    
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

    // Crea un nuevo marcador en la ubicación del gimnasio actual sin permitir que sea arrastrable
    marker = new google.maps.Marker({
        position: { lat: initialLat, lng: initialLng },
        map: map
    });
}

// Cuando se carga el contenido del DOM, se llama a la función initMap para inicializar el mapa
document.addEventListener('DOMContentLoaded', function() {
    initMap();
});

</script>
@endsection