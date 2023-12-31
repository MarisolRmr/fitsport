@extends(auth()->user()->tipo_id === 1 ? 'layouts.app' : 'layouts.appUser')


@section('titulo')
    Mi Perfil
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

    }
    #datos{
        font-size: 20px;
        font-family: 'Poppins', sans-serif;
    }
    #editar-icono{
        color:gray;
    }
    #editar-icono:hover{
        color:white;
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
            @if(auth()->user()->fotografia)
                <img class="mx-0 my-0" src="{{ asset('uploads/' . auth()->user()->fotografia) }}" alt="Foto de perfil">
            @else
                <img class="mx-0 my-0" src="{{ asset('img/user.png')}}"></img>
            @endif
        </div>
    </div>
    @if(session('actualizada'))
        <script>
            Swal.fire({
                title: 'Éxito',
                text: '{{ session('actualizada') }}',
                icon: 'success',
                timer: 4000, 
                timerProgressBar: true,
                showConfirmButton: false,
                
            });
        </script>
    @endif
    
    <div class="flex w-full justify-center items-center  px-6">
        <div id="nombre" class="rounded-xl flex text-white justify-center items-center mb-4 " >
            <img src="{{asset('img/cuadro.png')}}" alt="Imagen pequeña" class="h-6 w-6 ml-2 ">
            <p class="ml-4 mb-0">{{auth()->user()->usuario}}</p>
        </div>

        <div class="rounded-xl text-white mb-8 ml-2 mt-6" style="width: 55%; margin-left: 50px; background-color:rgba(53, 58, 80, 0.67); padding: 10px; font-size: 20px; margin-right: 35px; border-radius: 20px">
            <div class="w-full flex justify-end items-start">
                <a id="editar-icono" href="{{route('perfil.editar',auth()->user()->id)}}" class="text-end mr-2"  ><i class="fas fa-pencil-alt" ></i></a>
            </div>
            <div id="datos" class="flex py-0 px-5 mb-4 ">
                <table>
                    <tbody>
                        <tr>
                            <td>Nombre:</td>
                            <td>{{auth()->user()->nombre}} {{auth()->user()->apellido}}</td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td>{{auth()->user()->correo}}</td>
                        </tr>
                        <tr>
                            <td class="pr-3">Fecha de Nacimiento:</td>
                            <td>{{ \Carbon\Carbon::parse(auth()->user()->fecha_nac)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <td>Teléfono:</td>
                            <td>{{auth()->user()->telefono}}</td>
                        </tr>
                        <tr>
                            <td>Usuario:</td>
                            <td>{{auth()->user()->usuario}}</td>
                        </tr>
                        <tr>
                            <td>Contraseña:</td>
                            <td>●●●●●●</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>

@endsection

@section('js')

<script>
    

</script>
@endsection