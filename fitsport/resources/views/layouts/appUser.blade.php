<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="#" type="image/x-icon">
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

 
    {{-- Estilos de tailwind --}}
    @vite('resources/css/app.css')

    {{-- Scripts de tailwind --}}
    @vite('resources/js/app.js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" rel="stylesheet">
  

    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="{{ asset('css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/argon-dashboard-tailwind.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/argon-dashboard-tailwind.min.css') }}" rel="stylesheet" />
    
    @vite('resources/css/nucleo-icons.css')
    @vite('resources/css/nucleo-svg.css')
    @vite('resources/css/argon-dashboard-tailwind.css')

    <!-- Popper -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>


    <script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/argon-dashboard-tailwind.js') }}"></script>
    <script src="{{ asset('js/argon-dashboard-tailwind.min.js') }}"></script>

    @yield('css')
    <title>FitSport</title>
    <style>
      .swal2-icon{
        border-color: #849be3cc !important;
        color: #849be3cc !important;
      }
      .offcanvas {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 280px;
        transform: translateX(-100%);
        transition: transform 0.3s ease-in-out;
        background-color: rgba(53, 58, 80, 0.67);
        z-index: 990;
      }

      .offcanvas.active {
        transform: translateX(0);
      }
      .close-offcanvas-button {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 8px;
        background: transparent;
        border: none;
        color: white;
        font-size: 20px;
        cursor: pointer;
      }
      #sidenav li:hover{
        background-color: rgba(77, 82, 106, 0.8);
      }
      /* Color de fondo de la barra de desplazamiento */
      ::-webkit-scrollbar {
        background-color: rgba(53, 58, 80, 0.4); 
      }

      /* Estilo de la barra de desplazamiento */
      ::-webkit-scrollbar-thumb {
        background-color: #64677893;
        border-radius: 10px;
      }
    
    </style>
</head>

<body id="body" class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">
    <!-- sidenav  -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" style="height: 100vh; overflow-y: auto;">
    <aside class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4  ">
      <div class="h-19 text-center mb-4">
        <a class="block px-8 py-6 m-0  whitespace-nowrap dark:text-white text-slate-700" href="{{route('home')}}">
          <img src="{{asset ('img/logo.svg')}}" class="inline h-full max-w-full" alt="main_logo" />
        </a>
      </div>
      <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />
      <div class="items-center block w-auto grow basis-full">
        <ul class="flex flex-col pl-0 mb-0" id="sidenav">
          <li class="mt-0.5 w-full">
            <a href="{{route('home')}}" style="font-size:18px" class="py-2.7 text-white dark:opacity-80 ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors">
              <div class="mr-2 flex h-12 w-12 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Dashboard</span>
            </a>
          </li>
          <li class="mt-0.5 w-full">
            <a href="{{route('rutina.index')}}" style="font-size:18px" class="text-white dark:opacity-80 py-2.7  ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors">
              <div class="mr-2 flex h-12 w-12 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M96 64c0-17.7 14.3-32 32-32h32c17.7 0 32 14.3 32 32V224v64V448c0 17.7-14.3 32-32 32H128c-17.7 0-32-14.3-32-32V384H64c-17.7 0-32-14.3-32-32V288c-17.7 0-32-14.3-32-32s14.3-32 32-32V160c0-17.7 14.3-32 32-32H96V64zm448 0v64h32c17.7 0 32 14.3 32 32v64c17.7 0 32 14.3 32 32s-14.3 32-32 32v64c0 17.7-14.3 32-32 32H544v64c0 17.7-14.3 32-32 32H480c-17.7 0-32-14.3-32-32V288 224 64c0-17.7 14.3-32 32-32h32c17.7 0 32 14.3 32 32zM416 224v64H224V224H416z"/></svg>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Mis Rutinas</span>
            </a>
          </li>

          <li class="mt-0.5 w-full">
            <a style="font-size:18px" 
              class="text-white dark:opacity-80 py-2.7  ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" 
              href="{{route('metas.index')}}">
              <div class="mr-2 flex h-12 w-12 items-center justify-center rounded-lg bg-center fill-current stroke-0 text-center xl:p-2.5">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M353.8 54.1L330.2 6.3c-3.9-8.3-16.1-8.6-20.4 0L286.2 54.1l-52.3 7.5c-9.3 1.4-13.3 12.9-6.4 19.8l38 37-9 52.1c-1.4 9.3 8.2 16.5 16.8 12.2l46.9-24.8 46.6 24.4c8.6 4.3 18.3-2.9 16.8-12.2l-9-52.1 38-36.6c6.8-6.8 2.9-18.3-6.4-19.8l-52.3-7.5zM256 256c-17.7 0-32 14.3-32 32V480c0 17.7 14.3 32 32 32H384c17.7 0 32-14.3 32-32V288c0-17.7-14.3-32-32-32H256zM32 320c-17.7 0-32 14.3-32 32V480c0 17.7 14.3 32 32 32H160c17.7 0 32-14.3 32-32V352c0-17.7-14.3-32-32-32H32zm416 96v64c0 17.7 14.3 32 32 32H608c17.7 0 32-14.3 32-32V416c0-17.7-14.3-32-32-32H480c-17.7 0-32 14.3-32 32z"/></svg>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Mis Metas</span>
            </a>
          </li>

          <li class="mt-0.5 w-full">
            <a href="{{route('gymBoxes.index_atleta')}}" style="font-size:18px" class="text-white dark:opacity-80 py-2.7  ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors">
              <div class="mr-2 flex h-12 w-12 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Gyms and Boxes</span>
            </a>
          </li>
          {{-- <li class="mt-0.5 w-full hover:bg-white">
            <a href="#" style="font-size:18px" class="  text-white dark:opacity-80 py-2.7  ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors " >
              <div class="mr-2 flex h-12 w-12 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class="relative top-0  leading-normal text-slate-700 ni ni-single-02"></i>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Calendario</span>
            </a>
          </li> --}}
          <li class="mt-0.5 w-full hover:bg-white"><a href="{{route('nutriologos.mostrar')}}" style="font-size:18px" class="  text-white dark:opacity-80 py-2.7  ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors " >

              <div class="mr-2 flex h-12 w-12 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                {{-- <i class="relative top-0  leading-normal text-red-600 ni ni-single-02"></i> --}}
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 400 512">
                  <style>svg{fill:#ffffff}</style><path d="M88 8.1S221.4-.1 209 112.5c0 0 19.1-74.9 103-40.6 0 0-17.7 74-88 56 0 0 14.6-54.6 66.1-56.6 0 0-39.9-10.3-82.1 48.8 0 0-19.8-94.5-93.6-99.7 0 0 75.2 19.4 77.6 107.5 0 .1-106.4 7-104-119.8zm312 315.6c0 48.5-9.7 95.3-32 132.3-42.2 30.9-105 48-168 48-62.9 0-125.8-17.1-168-48C9.7 419 0 372.2 0 323.7 0 275.3 17.7 229 40 192c42.2-30.9 97.1-48.6 160-48.6 63 0 117.8 17.6 160 48.6 22.3 37 40 83.3 40 131.7zM120 428c0-15.5-12.5-28-28-28s-28 12.5-28 28 12.5 28 28 28 28-12.5 28-28zm0-66.2c0-15.5-12.5-28-28-28s-28 12.5-28 28 12.5 28 28 28 28-12.5 28-28zm0-66.2c0-15.5-12.5-28-28-28s-28 12.5-28 28 12.5 28 28 28 28-12.5 28-28zM192 428c0-15.5-12.5-28-28-28s-28 12.5-28 28 12.5 28 28 28 28-12.5 28-28zm0-66.2c0-15.5-12.5-28-28-28s-28 12.5-28 28 12.5 28 28 28 28-12.5 28-28zm0-66.2c0-15.5-12.5-28-28-28s-28 12.5-28 28 12.5 28 28 28 28-12.5 28-28zM264 428c0-15.5-12.5-28-28-28s-28 12.5-28 28 12.5 28 28 28 28-12.5 28-28zm0-66.2c0-15.5-12.5-28-28-28s-28 12.5-28 28 12.5 28 28 28 28-12.5 28-28zm0-66.2c0-15.5-12.5-28-28-28s-28 12.5-28 28 12.5 28 28 28 28-12.5 28-28zM336 428c0-15.5-12.5-28-28-28s-28 12.5-28 28 12.5 28 28 28 28-12.5 28-28zm0-66.2c0-15.5-12.5-28-28-28s-28 12.5-28 28 12.5 28 28 28 28-12.5 28-28zm0-66.2c0-15.5-12.5-28-28-28s-28 12.5-28 28 12.5 28 28 28 28-12.5 28-28zm24-39.6c-4.8-22.3-7.4-36.9-16-56-38.8-19.9-90.5-32-144-32S94.8 180.1 56 200c-8.8 19.5-11.2 33.9-16 56 42.2-7.9 98.7-14.8 160-14.8s117.8 6.9 160 14.8z"/></svg>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Nutriólogos</span>
            </a>
          </li>
          <li class="mt-0.5 w-full hover:bg-white">

            <a href="{{route('noticias.index_atleta')}}" style="font-size:18px" class="  text-white dark:opacity-80 py-2.7  ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors " >

              <div class="mr-2 flex h-12 w-12 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M96 96c0-35.3 28.7-64 64-64H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H80c-44.2 0-80-35.8-80-80V128c0-17.7 14.3-32 32-32s32 14.3 32 32V400c0 8.8 7.2 16 16 16s16-7.2 16-16V96zm64 24v80c0 13.3 10.7 24 24 24H296c13.3 0 24-10.7 24-24V120c0-13.3-10.7-24-24-24H184c-13.3 0-24 10.7-24 24zm208-8c0 8.8 7.2 16 16 16h48c8.8 0 16-7.2 16-16s-7.2-16-16-16H384c-8.8 0-16 7.2-16 16zm0 96c0 8.8 7.2 16 16 16h48c8.8 0 16-7.2 16-16s-7.2-16-16-16H384c-8.8 0-16 7.2-16 16zM160 304c0 8.8 7.2 16 16 16H432c8.8 0 16-7.2 16-16s-7.2-16-16-16H176c-8.8 0-16 7.2-16 16zm0 96c0 8.8 7.2 16 16 16H432c8.8 0 16-7.2 16-16s-7.2-16-16-16H176c-8.8 0-16 7.2-16 16z"/></svg>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Noticias</span>
            </a>
          </li>
          <li class="mt-0.5 w-full hover:bg-white">
            <a href="{{route('ejercitate.mostrar')}}" style="font-size:18px" class="  text-white dark:opacity-80 py-2.7  ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors " >   
              <div class="mr-2 flex h-12 w-12 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M320 48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM125.7 175.5c9.9-9.9 23.4-15.5 37.5-15.5c1.9 0 3.8 .1 5.6 .3L137.6 254c-9.3 28 1.7 58.8 26.8 74.5l86.2 53.9-25.4 88.8c-4.9 17 5 34.7 22 39.6s34.7-5 39.6-22l28.7-100.4c5.9-20.6-2.6-42.6-20.7-53.9L238 299l30.9-82.4 5.1 12.3C289 264.7 323.9 288 362.7 288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H362.7c-12.9 0-24.6-7.8-29.5-19.7l-6.3-15c-14.6-35.1-44.1-61.9-80.5-73.1l-48.7-15c-11.1-3.4-22.7-5.2-34.4-5.2c-31 0-60.8 12.3-82.7 34.3L57.4 153.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l23.1-23.1zM91.2 352H32c-17.7 0-32 14.3-32 32s14.3 32 32 32h69.6c19 0 36.2-11.2 43.9-28.5L157 361.6l-9.5-6c-17.5-10.9-30.5-26.8-37.9-44.9L91.2 352z"/></svg>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ejercítate</span>
            </a>
          </li>

        </ul>
      </div>
    </aside>
    </div>
    <!-- end sidenav -->


    <div class="absolute w-full h-full top-0 bg-cover bg-center" style="background-image: url('{{asset ('img/user/fondo_user.png')}}'); min-height: 75px; position: fixed;">
      <span class="absolute top-0 left-0 w-full h-full bg-black opacity-70"></span>
    </div>
  
    <main id="main" class=" relative h-full max-h-screen rounded-xl transition-all duration-200 ease-in-out rounded-xl flex-grow">
      <nav class="relative flex flex-wrap items-center justify-between px-0 py-3 mx-4 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="false">
        <div class="flex items-center">
            <a class="block px-2 py-3 text-4xl font-bold text-white transition-all ease-nav-brand" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
              <i style="height: 25px; width: 25px;" class="fas fa-bars sm:mr-1"></i>
            </a>
        </div>
        <div class="flex items-center justify-between w-full pl-4 py-1 mx-auto flex-wrap-inherit">
          <nav>
            <!-- breadcrumb -->
            <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
              <li class="text-sm leading-normal">

                <a class="text-white opacity-50" href="#"> FitSport</a>
                
              </li>
              <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']" aria-current="page">@yield('titulo')</li>
            </ol>
            <h4 class="mb-0 font-bold text-white capitalize"> @yield('titulo') </h4>
          </nav>

          <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
            <div class="flex items-center md:ml-auto md:pr-4">
              <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
              </div>
            </div>
            
            <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
              <li class="flex items-center">
                <div class="relative inline-block" style="min-width: 180px;">
                  <div class="p-0 flex items-center justify-center">
                    <a style="cursor:pointer" onclick="toggleDropdown()" class="block px-0 py-2 text-sm font-semibold text-white transition-all ease-nav-brand">
                      @if(auth()->user()->fotografia)
                          <img src="{{ asset('uploads/' . auth()->user()->fotografia) }}" alt="Fotografía de usuario" class="sm:inline w-8 h-8 rounded-full sm:mr-1">
                      @else
                          <i style="font-size: 20px" class="fa fa-user sm:mr-1"></i>
                      @endif
                      <span class="hidden sm:inline pl-0 p-2" style="font-size: 20px">{{ auth()->user()->usuario }}</span>
                    </a>
                  </div>
                  <div style="right: 5px" id="dropdown-content" class="hidden absolute w-48 mt-2 bg-white rounded-lg shadow-lg">
                    <ul style="z-index:10" id="dropdown">
                      <li id="d1"><a href="{{route('perfil.index')}}" class="px-3 py-2 mb-0 block text-gray-800 hover:bg-primary">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                      </svg>
                      Mi Perfil</a></li>
                      <li id="df" class="flex items-center">
                        <form method="post" action="{{route('logout')}}">
                          @csrf
                          <button type="submit"  class="px-3 py-2 block text-gray-800">
                            <span stroke-width="1.5" class="hidden sm:inline">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                              </svg>
                            Cerrar Sesión </span> 
                          </button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </li>

            
            </ul>
          </div>
        </div>
      </nav>
      <!-- end Navbar -->
      @yield('contenido')
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    
     <!-- Importar el archivo JavaScript de Bootstrap -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

     <script>
      document.addEventListener('DOMContentLoaded', function() {
        var offcanvas = document.getElementById('offcanvasExample');
        var main = document.getElementById('main');
        var body = document.getElementById('body');

        var offcanvasToggle = document.querySelector('[data-bs-toggle="offcanvas"]');

        offcanvasToggle.addEventListener('click', function() {
          offcanvas.classList.toggle('active');
          main.classList.toggle('xl:ml-68');
          main.classList.toggle('w-32');
          body.style.overflow = 'auto';
        });
      });

      function toggleDropdown() {
        const dropdownContent = document.getElementById('dropdown-content');
        dropdownContent.classList.toggle('hidden'); // Agregar o quitar la clase 'hidden'
      }
      
    </script>

    @yield('js')
  </body>

</html>