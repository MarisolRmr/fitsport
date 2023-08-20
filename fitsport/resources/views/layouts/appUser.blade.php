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
                <i class="relative top-0 leading-normal text-blue-500 ni ni-tv-2"></i>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Dashboard</span>
            </a>
          </li>
          <li class="mt-0.5 w-full">
            <a href="#" style="font-size:18px" class="text-white dark:opacity-80 py-2.7  ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors">
              <div class="mr-2 flex h-12 w-12 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class="relative top-0  leading-normal text-orange-500 ni ni-calendar-grid-58"></i>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Mis Rutinas</span>
            </a>
          </li>

          <li class="mt-0.5 w-full">
            <a style="font-size:18px" class="text-white dark:opacity-80 py-2.7  ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="#">
              <div class="mr-2 flex h-12 w-12 items-center justify-center rounded-lg bg-center fill-current stroke-0 text-center xl:p-2.5">
                <i class="relative top-0  leading-normal text-emerald-500 ni ni-credit-card"></i>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Mis Metas</span>
            </a>
          </li>

          <li class="mt-0.5 w-full">
            <a href="#" style="font-size:18px" class="text-white dark:opacity-80 py-2.7  ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors">
              <div class="mr-2 flex h-12 w-12 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class="relative top-0  leading-normal text-cyan-500 ni ni-app"></i>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Gyms and Boxes</span>
            </a>
          </li>
          <li class="mt-0.5 w-full hover:bg-white">
            <a href="#" style="font-size:18px" class="  text-white dark:opacity-80 py-2.7  ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors " >
              <div class="mr-2 flex h-12 w-12 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class="relative top-0  leading-normal text-slate-700 ni ni-single-02"></i>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Calendario</span>
            </a>
          </li>
          <li class="mt-0.5 w-full hover:bg-white">
            <a href="{{route('nutriologos.mostrar')}}" style="font-size:18px" class="  text-white dark:opacity-80 py-2.7  ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors " >

              <div class="mr-2 flex h-12 w-12 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class="relative top-0  leading-normal text-red-600 ni ni-single-02"></i>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Nutriólogos</span>
            </a>
          </li>
          <li class="mt-0.5 w-full hover:bg-white">

            <a href="{{route('noticias.index_atleta')}}" style="font-size:18px" class="  text-white dark:opacity-80 py-2.7  ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors " >

              <div class="mr-2 flex h-12 w-12 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class="relative top-0  leading-normal text-red-600 ni ni-single-02"></i>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Noticias</span>
            </a>
          </li>
          <li class="mt-0.5 w-full hover:bg-white">
            <a href="{{route('ejercitate.mostrar')}}" style="font-size:18px" class="  text-white dark:opacity-80 py-2.7  ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors " >   
              <div class="mr-2 flex h-12 w-12 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class="relative top-0  leading-normal text-red-600 ni ni-single-02"></i>
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