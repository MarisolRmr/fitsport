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

      
    </style>
</head>

<body class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">
  
    {{-- @yield('contenido_top') --}}
 
    <!-- sidenav  -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample">
    <aside class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4  ">
      <div class="h-19 text-center mb-4">
        <a class="block px-8 py-6 m-0  whitespace-nowrap dark:text-white text-slate-700" href="#">
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

          {{-- <li class="w-full mt-4">
            <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase text-white opacity-60">Registrar</h6>
          </li> --}}

          <li class="mt-0.5 w-full">
            <a href="{{route('gymBoxes.index')}}" style="font-size:18px" class="text-white dark:opacity-80 py-2.7  ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors">
              <div class="mr-2 flex h-12 w-12 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class="relative top-0  leading-normal text-orange-500 ni ni-calendar-grid-58"></i>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Gyms and Boxes</span>
            </a>
          </li>

          <li class="mt-0.5 w-full">
            <a style="font-size:18px" class="text-white dark:opacity-80 py-2.7  ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="#">
              <div class="mr-2 flex h-12 w-12 items-center justify-center rounded-lg bg-center fill-current stroke-0 text-center xl:p-2.5">
                <i class="relative top-0  leading-normal text-emerald-500 ni ni-credit-card"></i>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Nutriólogos</span>
            </a>
          </li>

          <li class="mt-0.5 w-full">
            <a href="{{route('entrenador.index')}}" style="font-size:18px" class="text-white dark:opacity-80 py-2.7  ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors">
              <div class="mr-2 flex h-12 w-12 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class="relative top-0  leading-normal text-cyan-500 ni ni-app"></i>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Entrenadores</span>
            </a>
          </li>

          <!--<li class="mt-0.5 w-full">
            <a style="font-size:18px" class="text-white dark:opacity-80 py-2.7  ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="#">
              <div class="mr-2 flex h-12 w-12 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class="relative top-0  leading-normal text-red-600 ni ni-world-2"></i>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Atletas</span>
            </a>
          </li>-->

          <li class="mt-0.5 w-full hover:bg-white">
            <a href="{{route('ejercicio.index')}}" style="font-size:18px" class="  text-white dark:opacity-80 py-2.7  ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors " >
              <div class="mr-2 flex h-12 w-12 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class="relative top-0  leading-normal text-slate-700 ni ni-single-02"></i>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ejercítate</span>
            </a>
          </li>
          <li class="mt-0.5 w-full hover:bg-white">
            <a href="{{route('noticias.index')}}" style="font-size:18px" class="  text-white dark:opacity-80 py-2.7  ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors " >
              <div class="mr-2 flex h-12 w-12 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class="relative top-0  leading-normal text-red-600 ni ni-single-02"></i>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Noticias</span>
            </a>
          </li>

        </ul>
      </div>

    </aside>
    </div>


    <!-- end sidenav -->


     <!-- FONDO INTERNET -->
    {{-- <div class="absolute w-full h-full top-0 bg-cover bg-center" style="background-image: url('https://cdn.wallpapersafari.com/3/96/eFMyB8.png'); min-height: 75px;">
      <span class="absolute top-0 left-0 w-full h-full bg-black opacity-70"></span>
    </div> --}}

    <div class="absolute w-full h-full top-0 bg-cover bg-center" style="background-image: url('{{asset ('img/admin/fondo4.png')}}'); min-height: 75px; position: fixed;">
      <span class="absolute top-0 left-0 w-full h-full bg-black opacity-70"></span>
    </div>
    
  
    <main id="main" class=" relative h-full max-h-screen rounded-xl transition-all duration-200 ease-in-out rounded-xl flex-grow">


        <!-- Navbar -->
        
      <nav class="relative flex flex-wrap items-center justify-between px-0 py-3 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="false">
        <div class="flex items-center">
            <a class="block px-2 py-3 text-4xl font-bold text-white transition-all ease-nav-brand" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
              <i style="height: 25px; width: 25px;" class="fas fa-bars sm:mr-1"></i>
            </a>
        </div>
        <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
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
                <a href="#" class="block px-0 py-2 text-sm font-semibold text-white transition-all ease-nav-brand">
                  <i class="fa fa-user sm:mr-1"></i>
                  <span class="hidden sm:inline p-2"> Username </span>
                </a>
              </li>

              <li class="flex items-center">
                <form method="post" action="{{route('logout')}}">
                  @csrf
                  <button type="submit" class="block px-0 py-2 text-sm font-semibold text-white transition-all ease-nav-brand">
                    <span class="hidden sm:inline"> Cerrar Sesión </span> 
                  </button>
                </form>
                
              </li>



              {{-- <li class="flex items-center">
                <a href="#" class="block px-0 py-2 text-sm font-semibold text-white transition-all ease-nav-brand">
                  <i class="fa fa-user sm:mr-1"></i>
                  <span class="hidden sm:inline"> Iniciar Sesión</span>
                </a>
              </li> --}}

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

        var offcanvasToggle = document.querySelector('[data-bs-toggle="offcanvas"]');

        offcanvasToggle.addEventListener('click', function() {
          offcanvas.classList.toggle('active');
          main.classList.toggle('xl:ml-68');
          main.classList.toggle('w-32');
        });
      });
      
    </script>

    @yield('js')
  </body>

</html>
