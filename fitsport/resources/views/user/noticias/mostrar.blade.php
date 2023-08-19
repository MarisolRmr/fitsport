@extends('layouts.appUser')

@section('titulo')
    Atleta Noticias
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

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
    <p id="titulo" class="ml-4 mb-0">Noticias</p>
  </div>

  <div class="rounded-xl text-white w-4/5 mb-8" style="background-color:rgba(53, 58, 80, 0.67); padding: 40px">
    <swiper-container class="mySwiper" pagination="true" pagination-clickable="true" navigation="true" space-between="30"
      centered-slides="true" autoplay-delay="2500" autoplay-disable-on-interaction="false">
      @foreach($noticiasCercanas as $noticia)
        <swiper-slide>
          <img src="{{ asset('noticias_img/' . $noticia->imagen) }}" alt="Noticia {{ $noticia->id }}" class="w-full h-full object-cover">
          <div class="slide-content" >
            <p>{{$noticia->nombre}}</p>
          </div>
        </swiper-slide>
      @endforeach
    </swiper-container>
  </div>
</div>
<div style="font-family: 'Poppins';" class=" w-full h-screen flex  flex-col items-center justify-center overflow-auto ">
  <div class="flex w-4/5 justify-center"> 
    <div class="rounded-xl flex text-white items-center justify-center w-full mb-4 mr-4" style="background-color:rgba(53, 58, 80, 0.67); padding: 15px">
        <p id="titulo1" class="mb-0" >Para tener éxito, en primer lugar debemos creer que podemos</p> 
    </div>
    <div class="rounded-xl flex items-center w-1/2 mb-4" style="padding: 15px">
        <div class="bg-white p-2 rounded-xl w-full flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
            <input type="text" placeholder="Buscar Noticia" class="buscar sflex-grow p-2 rounded-xl" id="searchInput">
            
        </div>
    </div>
  </div>
  <br>
  <div class="rounded-xl text-white w-4/5 mb-8">
    <div id="cardsContainer" class="flex flex-wrap"> 
        @if (count($noticias) > 0)
            @foreach ($noticias as $noticia => $data)
                <div class="card text-white mb-8">
                    <div class="flex flex-col items-center">
                        <p class="text-lg font-bold">{{$data->nombre}}</p>
                        @if($data->imagen)
                            <img src="{{ asset('noticias_img/' . $data->imagen)}}" alt="Imagen de la noticia" class="max-w-full h-auto"  style="width: 180px; height: 180px; object-fit: cover; border-radius: 10px;">
                        @else
                            <img src="{{asset('img/SinImagen.jpg')}}" alt="Imagen de la marca" class="max-w-full h-auto" style="border-radius:10px">
                        @endif
                        <a href="{{route('noticias.detalles',$data->id)}}" class="mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    
    
    @auth
      @if(auth()->user()->tipo_id === 1)
          <div class="flex text-end justify-end">
              <a href="{{route('noticias.index')}}" class="mt-4 px-4 py-2 bg-white text-black font-semibold rounded-2xl hover:bg-blue-600">Regresar</a>   
          </div>
      @endif
  @endauth
  </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
document.getElementById('searchInput').addEventListener('input', function(e) {
    const query = e.target.value;
    axios.get('/noticias/buscando', {
        params: {
            query: query
        }
    })
    .then(function(response) {
        const cardsContainer = document.getElementById('cardsContainer');
        cardsContainer.innerHTML = ''; // Limpiar contenedor

        response.data.forEach(data => {
            let imgSrc = data.imagen ? `/noticias_img/${data.imagen}` : '/img/SinImagen.jpg';

            // Crear tarjeta y agregarla al contenedor
            let card = `
            <div class="card text-white mb-8">
                <div class="flex flex-col items-center">
                    <p class="text-lg font-bold">${data.nombre}</p>
                    <img src="${imgSrc}" alt="Imagen de la noticia" class="max-w-full h-auto" style="border-radius:10px">
                    <a href="" class="mt-2">
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

</script>
@endsection
