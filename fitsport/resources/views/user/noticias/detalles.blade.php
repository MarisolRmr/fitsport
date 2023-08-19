@extends('layouts.appUser')

@section('titulo')
    Ejercitate
@endsection

@section('css')
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


</style>
@endsection

@section('contenido_top')
    <div class="absolute bg-y-50 w-full top-0 bg-[url('{{asset ('img/admin.png')}}')] min-h-75">
        <span class="absolute top-0 left-0 w-full h-full bg-black opacity-60"></span>
    </div>
@endsection

@section('contenido')
    <div style="font-family: 'Poppins';" class=" w-full h-screen flex  flex-col items-center justify-center overflow-auto ">
        @auth
            @if(auth()->user()->tipo_id === 2)
            <a href="{{ route('noticias.index_atleta') }}" class="flex items-start text-white justify-start mb-4 font-bold w-4/5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Volver
            </a>
            @endif
        @endauth
       
        <div class="rounded-xl flex text-white items-center w-4/5 mb-1" style="background-color:rgba(53, 58, 80, 0.67); padding: 15px">
            <img src="{{asset('img/cuadro.png')}}" alt="Imagen pequeña" class="h-8 w-8">
            <p id="titulo" class="ml-4 mb-0 font-bold">{{$noticia->nombre}}</p>
        </div>
        <div class=" rounded-xl  text-white w-4/5 mb-2" >
        @if($noticia->imagen)
            <img class="w-full" src="{{ asset('noticias_img/' . $noticia->imagen)}}" alt="Imagen de la noticia" style="border-radius: 0.75rem;">
        
        @endif
        </div>
        
        <div class=" rounded-xl  text-white w-4/5 mb-8" style="background-color:rgba(53, 58, 80, 0.67); padding: 40px">
            
            <div class="w-full flex">
                <div class="w-full mr-2">
                    <p class="text-lg font-bold mb-1" style="text-align: justify; font-style: italic;">{{$noticia->descripcion}} </p>
              
                    <a href="#"><p class="text-lg  text-center" style="text-align: end;"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                    </svg>
                    {{$noticia->fecha}}</p><a>
                    <br>
                    
                    <p class="text-lg "style="text-align: justify;">{{$noticia->texto}}</p>
                </div>
                
                
            </div>
        
            @auth
                @if(auth()->user()->tipo_id === 1)
                <div class="flex text-end justify-end">
                    <a href="{{route('noticias.index')}}" type="submit" class="mt-4 px-4 py-2 bg-white text-black font-semibold rounded-2xl hover:bg-blue-600">Regresar</a>   
                </div>
                @endif
            @endauth
        </div>
        
    </div>
@endsection

@section('js')


@endsection