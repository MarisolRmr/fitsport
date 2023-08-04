@extends('layouts.app')

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
        <!-- cards row 2 -->
        <div class="flex flex-wrap -mx-3">
            <div class="w-full h-1/2 max-w-full px-6 mt-0 lg:w-6/12 lg:flex-none">
            <img style="border-radius: 18px;" src="{{asset ('img/portada_perfil.png')}}" class="h-full w-full" alt="admin_dashboard" />   
            </div>
        </div>
    </div>

    <div class="rounded-xl flex text-white items-center w-4/5 mb-4" style="background-color:rgba(53, 58, 80, 0.67); padding: 15px">
        <img src="{{asset('img/cuadro.png')}}" alt="Imagen pequeña" class="h-8 w-8">
        <p id="titulo" class="ml-4 mb-0">Mi Perfil</p>
        
    </div>
    
    <div class=" rounded-xl  text-white w-4/5 mb-8" style="background-color:rgba(53, 58, 80, 0.67); padding: 40px">
        <div class=" rounded-xl p-4 text-white overflow-x-auto" style="background: #64677893;">
       

       
        </div>
    </div>
</div>

@endsection

@section('js')

<script>
    

</script>
@endsection