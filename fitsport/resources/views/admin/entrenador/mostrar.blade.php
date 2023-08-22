@extends('layouts.app')

@section('titulo')
    Administrador Entrenador
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
    <p id="titulo" class="ml-4 mb-0">Entrenador</p>
    <a href="{{route('entrenador.create')}}" class="ml-auto flex items-center rounded-full border-4 border-white w-12 h-12 text-white text-2xl text-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="20" cy="20" r="16" />
                <line x1="20" y1="12" x2="20" y2="28" />
                <line x1="12" y1="20" x2="28" y2="20" />
            </svg>
        </a>
  </div>
  

    <div class=" rounded-xl  text-white w-4/5 mb-8" style="background-color:rgba(53, 58, 80, 0.67); padding: 40px">
        <div class=" rounded-xl p-4 text-white overflow-x-auto" style="background: #64677893;">
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
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Horario</th>
                        <th>Gimnasio/Box</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($entrenador as $entrenador)
                    <tr>
                        <td>{{ $entrenador->id }}</td>
                        <td style="text-align: center;">
                            <!-- Contenedor para centrar la imagen -->
                            <div style="display: flex; justify-content: center;">
                                <!-- Mostrar la imagen del gimnasio si existe, si no, mostrar "Sin Imagen" -->
                                @if($entrenador->fotografia)
                                    <img src="{{ asset('ImgEntrenador/' . $entrenador->fotografia) }}" alt="Imagen de la marca" style="height: 80px; width: 80px; border-radius: 17px;">
                                @else
                                    Sin Imagen
                                @endif
                            </div>
                        </td>
                        <td class="actions-cell"><a href="{{ route('entrenador.verEntrenador', $entrenador->id) }}" class="edit-button">{{ $entrenador->nombre }} {{ $entrenador->apellido }}</a></td>
                        <td>{{ date('g:i a', strtotime($entrenador->horaEntrada)) }} - {{ date('g:i a', strtotime($entrenador->horaSalida)) }}</td>
                        <td>{{ $entrenador->gimnasio->nombre}}</td>
                        <td>{{ $entrenador->telefono }}</td>
                        <td>{{ $entrenador->correo }}</td>
                        <td class="actions-cell"><a href="{{ route('entrenador.editar', $entrenador->id) }}" class="edit-button">Editar</a></td>
                        <td class="actions-cell"><a href="#" onclick="eliminar({{ $entrenador->id }})" class="edit-button">Eliminar</a></td>
                    </tr>
                    @endforeach
                    
                    
                    
                </tbody>
            </table>
        </div>
    </div>
  
</div>

@endsection

@section('js')

<script>
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
                window.location.href = "{{ route('entrenador.eliminar', ':id') }}".replace(':id', id);
            }
        });
    }
    new DataTable('#example', {
        order: [[3, 'desc']],
        "lengthMenu":[[5,10,50,-1],[5,10,50,"All"]],
        language: {
            emptyTable: "Aún no hay Entrenadores que mostrar."
        }
    });

</script>
@endsection