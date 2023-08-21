@extends('layouts.appUser')

@section('titulo')
    Metas
@endsection

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

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
        width: 32%;  /* 10% dividido entre 4 cards es 25%. Si descuentas un margen del 1% a la derecha de cada card, obtienes un ancho de 23% */
        margin-right: 1.3%; /* margen a la derecha */
        background-color: rgba(53, 58, 80, 0.67);
        padding: 40px;
        border-radius: 10px;
        box-sizing: border-box; /* Asegurarse de que el padding no afecte el ancho total */
    }
    .cardMetas{
        width: 110%;  /* 10% dividido entre 4 cards es 25%. Si descuentas un margen del 1% a la derecha de cada card, obtienes un ancho de 23% */
        margin-right: 1.3%; /* margen a la derecha */
        background-color: #D9D9D9;
        border-radius: 10px;
        box-sizing: border-box; /* Asegurarse de que el padding no afecte el ancho total */
    }
    /* Sin margen en el último card de cada fila */
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
        <!-- Encabezado -->
        <div class="rounded-xl flex text-white items-center w-4/5 mb-4" style="background-color: rgba(53, 58, 80, 0.67); padding: 15px">
            <img src="{{asset('img/cuadro.png')}}" alt="Imagen pequeña" class="h-8 w-8">
            <p id="titulo" class="ml-4 mb-0">Mis Metas</p>
            <!-- Enlace para agregar un nuevo gimnasio -->
            <a href="{{route('metas.create')}}" class="ml-auto flex items-center rounded-full border-4 border-white w-12 h-12 text-white text-2xl text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="20" cy="20" r="16" />
                    <line x1="20" y1="12" x2="20" y2="28" />
                    <line x1="12" y1="20" x2="28" y2="20" />
                </svg>
            </a>
        </div>
        <br>
        <div class="flex w-4/5 justify-center"> 
            <div class="rounded-xl flex text-white items-center justify-center w-full mb-4 mr-4" >
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
                <!-- Primera columna -->
                <div class="card text-white mb-8 w-1/3 px-2 h-96 columna">
                    <div class="flex items-center mb-4"> <!-- Añadí mt-2 para moverlo un poco hacia arriba -->
                        <img src="{{asset('img/cuadro.png')}}" alt="Imagen pequeña" class="h-4 w-4"> <!-- Ajusté la imagen a un tamaño un poco más grande, puedes cambiarlo como prefieras -->
                        <p id="titulo" class="ml-4 mb-0">Inicio</p>
                    </div>
                    
                    <div class="flex flex-col items-center h-full bg-gray-500 mb-4">
                        @php
                            $metasInicio = $metas->where('estado', 'inicio');
                        @endphp
                            @if ($metasInicio->count())
                                @foreach ($metasInicio  as $meta)
                                <div class="cardMetas text-black mb-4 w-1/3 px-2 h-128 flex flex-col" id="meta-{{ $meta->id }}"> <!-- Cambio de flex a flex-col para estructura vertical -->
                                    <!-- Título del meta (nombre) centrado y que abarque las dos columnas -->
                                    <div class="text-left w-full bg-gray-200" style="background-color: #D9D9D9; padding: 0; margin: 0;">
                                        <p class="titulo">Vencimiento: {{ $meta->fecha }}</p>
                                    </div>
                                    <div class="text-center w-full bg-gray-200" style="background-color: #D9D9D9; padding: 0; margin: 0!important;">
                                        <h4 class="titulo">{{ $meta->nombre }}</h4>
                                    </div>
                                    <!-- Contenido principal en estructura horizontal -->
                                    <div class="flex flex-1 mb-0">
                                        <!-- Columna de la izquierda (Información) -->
                                        <div class="flex-1 p-4 mb-0" style="width:80% !important; white-space: normal; overflow-wrap: break-word;">
                                            <p class="truncated-text-d">{{ $meta->descripcion }}</p>
                                            <button class="view-more-button-d" style="display:none; color: #72def1 !important">Ver más</button>
                                            <button class="view-less-button-d" style="display:none; color: #72def1 !important">Ver menos</button>
                                            <!-- Aquí puedes agregar más detalles si lo necesitas -->
                                        </div>

                                        <!-- Columna de la derecha (Botones) -->
                                        <div class="flex flex-col mb-0 justify-center items-center p-4 space-y-2" style="width:20% !important"> <!-- space-y-2 da un espacio vertical entre los botones -->
                                            <button class="focus:outline-none text-black p-2 mr-2 ">
                                                <i class="fas fa-pencil-alt text-xl"></i> <!-- Ícono de lápiz de Font Awesome -->
                                            </button>
                                            <button class="focus:outline-none text-black p-2">
                                                <i class="fas fa-trash-alt text-xl"></i> <!-- Ícono de bote de basura de Font Awesome -->
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Botones "Proceso" y "Finalizar" -->
                                    <div class="flex justify-between px-4 mt-4"> <!-- Contenedor de botones con espacio entre ellos -->
                                        <button data-meta-id="{{ $meta->id }}" style="background-color: #FFDE59; width: 150px; text-align: center;" class="move-to-proceso-btn px-4 py-2 mr-4 text-black font-semibold rounded-2xl hover:bg-blue-600">Proceso</button>
                                        <button style="background-color: #FFDE59; width: 150px; text-align: center;" class="px-4 py-2 mr-4 text-black font-semibold rounded-2xl hover:bg-blue-600">Finalizar</button>
                                    </div>
                                    <br>
                                </div>
                                @endforeach
                            @else
                                <div class="cardMetas text-black mb-4 w-1/3 px-2 h-128 flex flex-col">
                                    <div class="text-center w-full bg-gray-200 no-metas-inicio-message" style="background-color: #D9D9D9; padding: 0; margin: 0!important;">
                                        <p class="titulo">No tienes metas por iniciar.</p>
                                    </div>
                                </div>
                            @endif
                    </div>

                </div>


                <!-- Segunda columna -->
                <div class="card text-white mb-8 w-1/3 px-2 h-96 columna">
                    <div class="flex items-center"> <!-- Añadí mt-2 para moverlo un poco hacia arriba -->
                        <img src="{{asset('img/cuadro.png')}}" alt="Imagen pequeña" class="h-4 w-4"> <!-- Ajusté la imagen a un tamaño un poco más grande, puedes cambiarlo como prefieras -->
                        <p id="titulo" class="ml-4 mb-0">Proceso</p>
                    </div>
                    
                    <div class="flex flex-col items-center h-full bg-gray-500" id="columna-proceso">
                    @php
                            $metasInicio = $metas->where('estado', 'proceso');
                        @endphp
                            @if ($metasInicio->count())
                                @foreach ($metasInicio  as $meta)
                                <div class="cardMetas text-black mb-4 w-1/3 px-2 h-128 flex flex-col" id="meta-{{ $meta->id }}"> <!-- Cambio de flex a flex-col para estructura vertical -->
                                    <!-- Título del meta (nombre) centrado y que abarque las dos columnas -->
                                    <div class="text-left w-full bg-gray-200" style="background-color: #D9D9D9; padding: 0; margin: 0;">
                                        <p class="titulo">Vencimiento: {{ $meta->fecha }}</p>
                                    </div>
                                    <div class="text-center w-full bg-gray-200" style="background-color: #D9D9D9; padding: 0; margin: 0!important;">
                                        <h4 class="titulo">{{ $meta->nombre }}</h4>
                                    </div>
                                    <!-- Contenido principal en estructura horizontal -->
                                    <div class="flex flex-1 mb-0">
                                        <!-- Columna de la izquierda (Información) -->
                                        <div class="flex-1 p-4 mb-0" style="width:80% !important; white-space: normal; overflow-wrap: break-word;">
                                            <p class="truncated-text-d">{{ $meta->descripcion }}</p>
                                            <button class="view-more-button-d" style="display:none; color: #72def1 !important">Ver más</button>
                                            <button class="view-less-button-d" style="display:none; color: #72def1 !important">Ver menos</button>
                                            <!-- Aquí puedes agregar más detalles si lo necesitas -->
                                        </div>

                                        <!-- Columna de la derecha (Botones) -->
                                        <div class="flex flex-col mb-0 justify-center items-center p-4 space-y-2" style="width:20% !important"> <!-- space-y-2 da un espacio vertical entre los botones -->
                                            <a class="focus:outline-none text-black p-2 mr-2 " href="{{route('metas.editar',$meta->id)}}">
                                                <i class="fas fa-pencil-alt text-xl"></i> <!-- Ícono de lápiz de Font Awesome -->
                                            </a>
                                            <button class="focus:outline-none text-black p-2" onclick="eliminar({{ $meta->id }})">
                                                <i class="fas fa-trash-alt text-xl"></i> <!-- Ícono de bote de basura de Font Awesome -->
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Botones "Proceso" y "Finalizar" -->
                                    <div class="flex justify-between px-4 mt-4"> <!-- Contenedor de botones con espacio entre ellos -->
                                        <button style="background-color: #FFDE59; width: 150px; text-align: center;" class="px-4 py-2 mr-4 text-black font-semibold rounded-2xl hover:bg-blue-600">Finalizar</button>
                                    </div>
                                    <br>
                                </div>
                                @endforeach
                            @else
                                <div class="cardMetas text-black mb-4 w-1/3 px-2 h-128 flex flex-col">
                                    <div class="text-center w-full bg-gray-200" style="background-color: #D9D9D9; padding: 0; margin: 0!important;">
                                        <p class="titulo">No tienes metas en proceso.</p>
                                    </div>
                                </div>
                            @endif
                    </div>
                </div>

                <!-- Tercera columna -->
                <div class="card text-white mb-8 w-1/3 px-2 h-96 columna">
                    <div class="flex items-center"> <!-- Añadí mt-2 para moverlo un poco hacia arriba -->
                        <img src="{{asset('img/cuadro.png')}}" alt="Imagen pequeña" class="h-4 w-4"> <!-- Ajusté la imagen a un tamaño un poco más grande, puedes cambiarlo como prefieras -->
                        <p id="titulo" class="ml-4 mb-0">Finalizadas</p>
                    </div>
                    
                    <div class="flex flex-col items-center h-full bg-gray-500">
                        <!-- Contenido de la primera columna -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
    // Función para truncar el texto y mostrar el botón "ver más"
    function truncateText() {
        const textElements = document.querySelectorAll('.truncated-text-t');
        const textElements2 = document.querySelectorAll('.truncated-text-d');
        const maxCharacters = 50; // Cambia este valor al número máximo de caracteres que deseas mostrar inicialmente

        textElements.forEach((element) => {
            const text = element.textContent;
            if (text.length > maxCharacters) {
                const truncatedText = text.slice(0, maxCharacters) + ' ...';
                const fullText = text;

                element.textContent = truncatedText;

                const viewMoreButton = document.createElement('button');
                viewMoreButton.innerText = 'Ver más';
                viewMoreButton.className = 'view-more-button-t';
                viewMoreButton.setAttribute('style', ' color: #0f91d2 !important;'); 
                viewMoreButton.addEventListener('click', () => {
                    element.textContent = fullText;
                    viewMoreButton.style.display = 'none';
                    viewLessButton.style.display = 'inline-block';
                    viewMoreButton.style.color = '#0f91d2';
                    viewLessButton.style.color = '#0f91d2';
                });

                const viewLessButton = document.createElement('button');
                viewLessButton.innerText = 'Ver menos';
                viewLessButton.className = 'view-less-button-t';
                viewLessButton.style.display = 'none';
                viewLessButton.setAttribute('style', 'display: none; color: #0f91d2 !important;'); // Agrega el estilo aquí
                viewLessButton.addEventListener('click', () => {
                    element.textContent = truncatedText;
                    viewMoreButton.style.display = 'inline-block';
                    viewLessButton.style.display = 'none';
                    viewMoreButton.style.color = '#0f91d2';
                    viewLessButton.style.color = '#0f91d2';
                });

                element.parentNode.appendChild(viewMoreButton);
                element.parentNode.appendChild(viewLessButton);
            }
        });

        textElements2.forEach((element) => {
            const text = element.textContent;
            if (text.length > maxCharacters) {
                const truncatedText = text.slice(0, maxCharacters) + ' ...';
                const fullText = text;

                element.textContent = truncatedText;

                const viewMoreButton = document.createElement('button');
                viewMoreButton.innerText = 'Ver más';
                viewMoreButton.className = 'view-more-button-d';
                viewMoreButton.setAttribute('style', ' color: #0f91d2 !important;'); // Agrega el estilo aquí
                
                viewMoreButton.addEventListener('click', () => {
                    element.textContent = fullText;
                    viewMoreButton.style.display = 'none';
                    viewLessButton.style.display = 'inline-block';
                    
                });

                const viewLessButton = document.createElement('button');
                viewLessButton.innerText = 'Ver menos';
                viewLessButton.className = 'view-less-button-d';
                viewLessButton.style.display = 'none';
                viewLessButton.setAttribute('style', 'display: none; color: #0f91d2 !important;'); // Agrega el estilo aquí
                
                viewLessButton.addEventListener('click', () => {
                    element.textContent = truncatedText;
                    viewMoreButton.style.display = 'inline-block';
                    viewLessButton.style.display = 'none';
                    viewMoreButton.style.color = '#0f91d2';
                    viewLessButton.style.color = '#0f91d2';
                });

                element.parentNode.appendChild(viewMoreButton);
                element.parentNode.appendChild(viewLessButton);
            }
        });
    }

    // Ejecutar la función al cargar la página
    window.addEventListener('DOMContentLoaded', truncateText);

    
    // Función para mostrar el SweetAlert de confirmación antes de eliminar
    function eliminar(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4fe37d',
            cancelButtonColor: '#80828f',
            confirmButtonText: 'Sí, eliminarlo'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma la eliminación, redirigimos a la ruta de eliminar
                window.location.href = "{{ route('metas.eliminar', ':id') }}".replace(':id', id);
            }
        });
    }

</script>
<script>
    // Configuración del token CSRF para todas las solicitudes AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

$('.move-to-proceso-btn').click(function() {
    var btn = $(this);
    var metaId = btn.data('meta-id');
    var tarjeta = $('#meta-' + metaId);
    var columnaProceso = $('#columna-proceso'); // Selecciona la columna "Proceso"

    var metasInicioCount = $('.cardMetas[data-estado="inicio"]').length;
    $.ajax({
        url: '{{ route('metas.cambiarEstado') }}',
        method: 'POST',
        data: {
            meta_id: metaId,
            estado: 'proceso' // Cambia este valor según tu necesidad
        },
        success: function(response) {
            if (response.success) {
            console.log('Estado cambiado exitosamente');

            // Desactiva el evento click del botón "Proceso" para esta tarjeta
            btn.off('click');

            // Mueve la tarjeta a la columna "Proceso"
            tarjeta.appendTo(columnaProceso);

            // Cambia el botón "Proceso" al botón "Finalizar" en la tarjeta
            // Adjunta un nuevo evento click para el botón "Finalizar"
            finalizarBtn.click(function() {
                // Aquí puedes implementar la lógica para finalizar la meta
            });
            // Verificar si quedan metas por iniciar
            if (metasInicioCount === 1) {
                    // Mostrar el mensaje de "No tienes metas por iniciar"
                    $('.no-metas-inicio-message').show();
                }

        } else {
            console.log('Error al cambiar el estado: ' + response.message);
        }
        },
    });
});




</script>






@endsection