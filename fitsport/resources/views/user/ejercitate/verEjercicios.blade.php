@extends('layouts.appUser')

@section('titulo')
    Ejercitate
@endsection

@section('css')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap');
    
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
        <div class="rounded-xl flex text-white items-center w-4/5 mb-4" style="background-color:rgba(53, 58, 80, 0.67); padding: 15px">
            <img src="{{asset('img/cuadro.png')}}" alt="Imagen pequeña" class="h-8 w-8">
            <p id="titulo" class="ml-4 mb-0">Ejercitate</p>
        </div>
        <br>
        <div class="flex w-4/5 justify-center"> 
            <div class="rounded-xl flex text-white items-center justify-center w-full mb-4 mr-4" style="background-color:rgba(53, 58, 80, 0.67); padding: 15px">
                <p id="titulo1" class="mb-0" >La técnica es la clave del éxito</p> 
            </div>
            <div class="rounded-xl flex items-center w-1/2 mb-4" style="padding: 15px">
                <div class="bg-white p-2 rounded-xl w-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                    <input type="text" placeholder="Buscar ejercicio" class="buscar flex-grow p-2 rounded-xl" id="searchInput">
                    
                </div>
                
            </div>
            
        </div>
        <br>
        <div class="rounded-xl text-white w-4/5 mb-8">
            <div id="cardsContainer" class="flex flex-wrap"> 
                @if (count($ejercicio) > 0)
                    @foreach ($ejercicio as $index => $data)
                        <div class="card text-white mb-8">
                            <div class="flex flex-col items-center">
                                <p class="text-lg font-bold">{{$data->nombre}}</p>
                                @if($data->imagen)
                                    <img src="{{ asset('ImgEjercicios/' . $data->imagen)}}" alt="Imagen de la marca" class="max-w-full h-auto" style="border-radius:10px">
                                @else
                                    <img src="{{asset('img/SinImagen.jpg')}}" alt="Imagen de la marca" class="max-w-full h-auto" style="border-radius:10px">
                                @endif
                                <a href="" class="mt-2">
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
                    <a href="{{route('ejercicio.index')}}" type="submit" class="mt-4 px-4 py-2 bg-white text-black font-semibold rounded-2xl hover:bg-blue-600">Regresar</a>   
                </div>
                @endif
            @endauth
        </div>
        
    </div>
@endsection

@section('js')
<script>
    function handleImageUpload(event) {
        const input = event.target;
        const imageContainer = input.parentElement;
        const selectedImage = imageContainer.querySelector('.selected-image');

        const file = input.files[0];
        const reader = new FileReader();

        reader.onload = function (e) {
            selectedImage.style.backgroundImage = `url('${e.target.result}')`; // Add the URL here
            if (e.target.result) {
                editIcon.style.display = 'flex'; // Mostrar el ícono de lápiz si hay imagen
            } else {
                editIcon.style.display = 'none'; // Ocultar el ícono de lápiz si no hay imagen
            }
        };

        reader.readAsDataURL(file);
    }
    document.getElementById('searchInput').addEventListener('input', function(e) {
    const inputValue = e.target.value;
    const clearInputBtn = document.getElementById('clearInput');
    
    if (inputValue) {
        clearInputBtn.style.display = 'block';
    } else {
        clearInputBtn.style.display = 'none';
    }
    });

    document.getElementById('clearInput').addEventListener('click', function() {
        const searchInput = document.getElementById('searchInput');
        searchInput.value = '';
        this.style.display = 'none';
    });

</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
document.getElementById('searchInput').addEventListener('input', function(e) {
    const query = e.target.value;
    axios.get('/ejercicio/buscando', {
        params: {
            query: query
        }
    })
    .then(function(response) {
        const cardsContainer = document.getElementById('cardsContainer');
        cardsContainer.innerHTML = ''; // Limpiar contenedor

        response.data.forEach(data => {
            let imgSrc = data.imagen ? `/ImgEjercicios/${data.imagen}` : '/img/SinImagen.jpg';

            // Crear tarjeta y agregarla al contenedor
            let card = `
            <div class="card text-white mb-8">
                <div class="flex flex-col items-center">
                    <p class="text-lg font-bold">${data.nombre}</p>
                    <img src="${imgSrc}" alt="Imagen del ejercicio" class="max-w-full h-auto" style="border-radius:10px">
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