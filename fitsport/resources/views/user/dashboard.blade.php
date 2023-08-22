@extends('layouts.appUser')

@section('titulo')
    Atleta Dashboard
@endsection

@section('contenido_top')
<div class="absolute bg-y-50 w-full top-0 bg-[url('{{asset ('img/admin.png')}}')] min-h-75">
  <span class="absolute top-0 left-0 w-full h-full bg-black opacity-60"></span>
</div>
@endsection

@section('contenido')

<!-- cards -->
<div class="w-full px-6 py-6 mx-auto">
  <!-- cards row 2 -->
  <div class="flex flex-wrap -mx-3">
    <div class="w-full h-1/2 max-w-full px-3 mt-0 lg:w-6/12 lg:flex-none">
      <img src="{{asset ('img/user/user_dash.png')}}" class="h-full w-full" alt="admin_dashboard" />   
    </div>
  </div>

  <!-- row 1 -->
  <div class="flex flex-wrap py-6 -mx-3">
    <!-- card1 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
      <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border" style="background-color: rgba(53, 58, 80, 0.67);">
        <div class="flex-auto p-4">
          <a href="{{route('metas.index')}}">
            <div class="flex flex-row -mx-3">
              <div class="flex-none w-2/3 max-w-full px-3">
                <div>
                  <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase text-white dark:opacity-60"> </p>
                  <h5 class="mb-2 font-bold text-white">Metas</h5>
                  <p class="mb-0 dark:text-white dark:opacity-60">
                    <span class="text-sm font-bold leading-normal text-emerald-500">Mis metas</span>
                  </p>
                </div>
              </div>
              <div class="px-3 text-right basis-1/3">
                <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                  <i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>
                </div>
              </div>
            </div>
          </a>
          
        </div>
      </div>
    </div>

    <!-- card2 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
      <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border" style="background-color: rgba(53, 58, 80, 0.67);">
        <div class="flex-auto p-4">
          <a href="{{route('rutina.index')}}">
          
            <div class="flex flex-row -mx-3">
              <div class="flex-none w-2/3 max-w-full px-3">
                <div>
                  <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase text-white dark:opacity-60"> </p>
                  <h5 class="mb-2 font-bold text-white">Rutinas</h5>
                  <p class="mb-0 dark:text-white dark:opacity-60">
                    <span class="text-sm font-bold leading-normal text-emerald-500">Mis rutinas</span>
                  </p>
                </div>
              </div>
              <div class="px-3 text-right basis-1/3">
                <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-red-600 to-orange-600">
                  <i class="ni leading-none ni-world text-lg relative top-3.5 text-white"></i>
                </div>
              </div>
            </div>
          
          </a>
        </div>
      </div>
    </div>

    <!-- card3 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
      <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border" style="background-color: rgba(53, 58, 80, 0.67);">
        <div class="flex-auto p-4">
          <a href="{{route('gymBoxes.index_atleta')}}">
            <div class="flex flex-row -mx-3">
              <div class="flex-none w-2/3 max-w-full px-3">
                <div>
                  <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase text-white dark:opacity-60"> </p>
                  <h5 class="mb-2 font-bold text-white">Gym</h5>
                  <p class="mb-0 dark:text-white dark:opacity-60">
                    <span class="text-sm font-bold leading-normal text-emerald-500">Gym & Boxes</span>
                  </p>
                </div>
              </div>
              <div class="px-3 text-right basis-1/3">
                <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-500 to-teal-400">
                  <i class="ni leading-none ni-paper-diploma text-lg relative top-3.5 text-white"></i>
                </div>
              </div>
            </div>
          
          </a>
          
        </div>
      </div>
    </div>

    <!-- card4 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
      <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border" style="background-color: rgba(53, 58, 80, 0.67);">
        <div class="flex-auto p-4">
          <a href=" {{route('ejercitate.mostrar')}}">
            <div class="flex flex-row -mx-3">
              <div class="flex-none w-2/3 max-w-full px-3">
                <div>
                  <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase text-white dark:opacity-60"> </p>
                  <h5 class="mb-2 font-bold text-white">Ejercitate</h5>
                  <p class="mb-0 dark:text-white dark:opacity-60">
                    <span class="text-sm font-bold leading-normal text-emerald-500">Ejercicios</span>
                  </p>
                </div>
              </div>
              <div class="px-3 text-right basis-1/3">
                <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-500 to-teal-400">
                  <i class="ni leading-none ni-paper-diploma text-lg relative top-3.5 text-white"></i>
                </div>
              </div>
            </div>

          </a>
          
        </div>
      </div>
    </div>
  </div>


  <footer class="pt-4">
    <div class="w-full px-6 mx-auto">
      <div class="flex flex-wrap items-center -mx-3 lg:justify-between">
        <div class="w-full max-w-full px-3 mt-0 mb-6 shrink-0 lg:mb-0 lg:w-1/2 lg:flex-none">
          <div class="text-sm leading-normal text-center text-white lg:text-left">
            ©
            <script>
              document.write(new Date().getFullYear() + ",");
            </script>
            made with <i class="fa fa-heart"></i> by WITech
          </div>
        </div>
      </div>
    </div>
  </footer>
</div>
<!-- end cards -->


@endsection