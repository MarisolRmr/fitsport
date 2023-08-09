@extends('layouts.app')

@section('titulo')
    Administrador Ejercicios
@endsection
@section('css')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap');

    .dataTables_wrapper .dataTables_filter input {
        color: gray;
        border-radius: 20px;
        margin-left: 10px;
        outline-offset: 0px;
    }
    .dataTables_wrapper .dataTables_filter input:focus{
        border-radius: 20px;
        margin-left: 15px;
        color:white;
        outline-offset: 0px;
        border: 1px solid gray;
        outline: none;
        padding: 5px 15px;
    }
    .dataTables_wrapper .dataTables_length select option {
        color:black;
        border-radius: 20px;
        margin-top: 7px;
    }
    .dataTables_wrapper .dataTables_length select {
        border-radius: 17px;
        outline-offset: 0px;
        outline: none;
    }
  
    input[type="search"]::-webkit-search-cancel-button {
    display: none;

    } 
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled{
        color:gray !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover{
        color:gray !important;
    }
    .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_paginate{
        margin-top:10px;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current{
        border:none;
        background-color: gray;
        color: white !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover{
        border:none;
        background-color: gray;
        color: white !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 50px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        border: 1px solid transparent;
        background: #9BF1A0;
        color:black !important;
    }
    table.dataTable {
        border-radius: 20px;
    }
    #example {
        background-color: transparent;
        color: white;
        border-collapse: collapse;
        
    }
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 20px !important;
    }
    #example th,
    #example td,
    #example tr {
        border: 1px solid white;
        background-color: transparent;
    }
    .edit-button,
    .delete-button {
        display: inline-block;
        padding: 8px 12px;
        color: #ffffff;
        border-radius: 10px;
        text-decoration: none;
        margin-right: 5px;
        text-align: center;
    }

    .edit-button:hover,
    .delete-button:hover {
        color: white;
        background-color: #959697;
    }
    .actions-cell {
        text-align: center;
    }
    #titulo{
        font-family: 'Poppins';
        font-size: 120%;
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
    <div class="rounded-xl flex text-white items-center w-4/5 mb-4" style="background-color:rgba(53, 58, 80, 0.67); padding: 15px">
        <img src="{{asset('img/cuadro.png')}}" alt="Imagen pequeña" class="h-8 w-8">
        <p id="titulo" class="ml-4 mb-0">Ejercicios</p>
        <a href="{{route('ejercicio.create')}}" class="ml-auto">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="20" cy="20" r="16" />
        <line x1="20" y1="12" x2="20" y2="28" />
        <line x1="12" y1="20" x2="28" y2="20" />
        </svg>
        </a>
    </div>

    <div class=" rounded-xl  text-white w-4/5 mb-8" style="background-color:rgba(53, 58, 80, 0.67); padding: 40px">
        <div class=" rounded-xl p-4 text-white overflow-x-auto" style="background: #64677893;">
        @if(session('agregada'))
            <div class="bg-green-200 p-2 rounded-lg mb-6 text-black text-center ">
                {{ session('agregada') }}
            </div>
        @endif
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

        <table id="example" class="mt-2 table hover hover:border-collapse">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Explicación</th>
                    <th>Imagen</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @if (count($ejercicio)>0)
                    @foreach ($ejercicio as $data)
                    <tr>
                        <td>{{$data->id}}</td>
                        <td class="actions-cell"><a href="{{route('ejercicio.verEjercicio',$data->id)}}" class="edit-button">{{$data->nombre}}</a></td>
                        <td>
                            <div class="truncated-text-d" style="width: 200px;">{{ $data->descripcion }}</div>
                            <button class="view-more-button-d" style="display:none; color: #72def1 !important">Ver más</button>
                            <button class="view-less-button-d" style="display:none; color: #72def1 !important">Ver menos</button>
                        </td>
                        <td>
                            <div class="truncated-text-d" style="width: 200px;">{{$data->explicacion}}</div>
                            <button class="view-more-button-d" style="display:none; color: #72def1 !important">Ver más</button>
                            <button class="view-less-button-d" style="display:none; color: #72def1 !important">Ver menos</button>
                        </td>
                        <td>
                            @if($data->imagen)
                            <img src="{{ asset('ImgEjercicios/' . $data->imagen)}}" alt="Imagen de la marca" style="height: 80px; weight:80px; border-radius:17px">
                            @else
                                Sin Imagen
                            @endif
                        </td>
                        <td class="actions-cell"><a href="{{route('ejercicio.editar',$data->id)}}" class="edit-button">Editar</a></td>
                        <td class="actions-cell">
                            <!-- Botón de eliminar con SweetAlert -->
                            <a href="#" onclick="eliminar({{ $data->id }})" class="edit-button">Eliminar</a>
                        </td>
                        <!--<td class="actions-cell"><a href="{{route('ejercicio.eliminar',$data->id)}}" class="edit-button">Eliminar</a></td>-->
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        </div>
    </div>
</div>

@endsection

@section('js')

<script>
    // Función para truncar el texto y mostrar el botón "ver más"
    function truncateText() {
        const textElements = document.querySelectorAll('.truncated-text-t');
        const textElements2 = document.querySelectorAll('.truncated-text-d');
        const maxCharacters = 100; // Cambia este valor al número máximo de caracteres que deseas mostrar inicialmente

        textElements.forEach((element) => {
            const text = element.textContent;
            if (text.length > maxCharacters) {
                const truncatedText = text.slice(0, maxCharacters) + ' ...';
                const fullText = text;

                element.textContent = truncatedText;

                const viewMoreButton = document.createElement('button');
                viewMoreButton.innerText = 'Ver más';
                viewMoreButton.className = 'view-more-button-t';
                viewMoreButton.setAttribute('style', ' color: #72def1 !important;'); 
                viewMoreButton.addEventListener('click', () => {
                    element.textContent = fullText;
                    viewMoreButton.style.display = 'none';
                    viewLessButton.style.display = 'inline-block';
                    viewMoreButton.style.color = '#72def1';
                    viewLessButton.style.color = '#72def1';
                });

                const viewLessButton = document.createElement('button');
                viewLessButton.innerText = 'Ver menos';
                viewLessButton.className = 'view-less-button-t';
                viewLessButton.style.display = 'none';
                viewLessButton.setAttribute('style', 'display: none; color: #72def1 !important;'); // Agrega el estilo aquí
                viewLessButton.addEventListener('click', () => {
                    element.textContent = truncatedText;
                    viewMoreButton.style.display = 'inline-block';
                    viewLessButton.style.display = 'none';
                    viewMoreButton.style.color = '#72def1';
                    viewLessButton.style.color = '#72def1';
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
                viewMoreButton.setAttribute('style', ' color: #72def1 !important;'); // Agrega el estilo aquí
                
                viewMoreButton.addEventListener('click', () => {
                    element.textContent = fullText;
                    viewMoreButton.style.display = 'none';
                    viewLessButton.style.display = 'inline-block';
                    
                });

                const viewLessButton = document.createElement('button');
                viewLessButton.innerText = 'Ver menos';
                viewLessButton.className = 'view-less-button-d';
                viewLessButton.style.display = 'none';
                viewLessButton.setAttribute('style', 'display: none; color: #72def1 !important;'); // Agrega el estilo aquí
                
                viewLessButton.addEventListener('click', () => {
                    element.textContent = truncatedText;
                    viewMoreButton.style.display = 'inline-block';
                    viewLessButton.style.display = 'none';
                    viewMoreButton.style.color = '#72def1';
                    viewLessButton.style.color = '#72def1';
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
                window.location.href = "{{ route('ejercicio.eliminar', ':id') }}".replace(':id', id);
            }
        });
    }
    new DataTable('#example', {
        order: [[3, 'desc']],
        "lengthMenu":[[5,10,50,-1],[5,10,50,"All"]],
        language: {
            emptyTable: "Aún no hay Ejercicios que mostrar."
        }
    });

</script>
@endsection