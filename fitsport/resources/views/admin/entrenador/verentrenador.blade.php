@extends(auth()->user()->tipo_id === 1 ? 'layouts.app' : 'layouts.appUser')

@section('titulo')
    Entrenador {{$entrenador->nombre}} {{$entrenador->apellido}}
@endsection
@section('css')

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
        top: 72%;  /* Desplaza el elemento 10px hacia arriba respecto a su posición original */
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
    .gimnasio-circle-container {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    overflow: hidden; /* Esto hará que la imagen se recorte para que se ajuste al contenedor circular */
    margin: 20px auto; /* Centra el contenedor en el elemento padre */
}

.gimnasio-circle-container img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ajusta la imagen para que cubra todo el contenedor */
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
            @if($entrenador->fotografia)
                <img class="mx-0 my-0" src="{{ asset('ImgEntrenador/' . $entrenador->fotografia) }}" alt="Foto de perfil">
            @else
                <img class="mx-0 my-0" src="{{ asset('img/user.png')}}"></img>
            @endif
        </div>
    </div>
    
    <div class="flex w-full justify-center   px-6">
        <div id="nombre" class="rounded-xl flex text-white justify-center items-center mb-4 " >
            <img src="{{asset('img/cuadro.png')}}" alt="Imagen pequeña" class="h-6 w-6 ml-2 ">
            <p class="ml-4 mb-0">{{$entrenador->nombre}} {{$entrenador->apellido}}</p>
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
                        </tr>
                        <tr>
                            <td></td>
                            <td>{{$entrenador->telefono}}</td>
                        </tr>
                        <tr>
                            <td>Horario: </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>{{$entrenador->horaEntrada}} - {{$entrenador->horaSalida}}</td>
                        </tr>
                        <tr>
                            <td>Gym y Boxes</td>
                        </tr>
                    </tbody>
                </table>
                

            </div>
            <div class="gimnasio-circle-container" style="text-align: center">
            @if($entrenador->gimnasio->fotografia)
                <img src="{{ asset('ImgGymBoxes/' . $entrenador->gimnasio->fotografia) }}" alt="Foto del gimnasio">
            @else
                <img src="{{asset('img/SinImagen.jpg')}}" alt="Foto del gimnasio">
            @endif
                
            </div>
            <p id="datos" class="text-white text-center mt-2">{{ $entrenador->gimnasio->nombre }}</p>
            
        </div>
    </div>

</div>

@endsection

@section('js')

@endsection