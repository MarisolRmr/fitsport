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
    <a href="{{route('ejercicio.create')}}" class="ml-auto"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg></a>
  </div>

  <div class=" rounded-xl  text-white w-4/5 mb-8" style="background-color:rgba(53, 58, 80, 0.67); padding: 40px">
    <div class=" rounded-xl p-4 text-white overflow-x-auto" style="background: #64677893;">
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
                    <td>{{$data->nombre}}</td>
                    <td>{{$data->descripcion}}</td>
                    <td>{{$data->explicacion}}</td>
                    <td></td>
                    <td class="actions-cell"><a href="#" class="edit-button">Editar</a></td>
                    <td class="actions-cell"><a href="#" class="edit-button">Eliminar</a></td>
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
    new DataTable('#example', {
        order: [[3, 'desc']],
        "lengthMenu":[[5,10,50,-1],[5,10,50,"All"]],
        language: {
            emptyTable: "Aún no hay Ejercicios que mostrar."
        }
    });

</script>
@endsection