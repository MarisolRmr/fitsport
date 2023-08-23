@extends('layouts.appUser')

@section('titulo')
    Atleta Dashboard
@endsection

@section('css')
<style>


</style>
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
  <div class="w-full max-w-screen-sm px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border" style="background-color: rgba(53, 58, 80, 0.67);">
      <div class="flex-auto p-4">
        <div class="flex flex-row -mx-3">
          <div class="flex-none w-2/3 max-w-full px-3" style="justify-content: center">
            <div style="justify-content: center">
              <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase text-white dark:opacity-60">Metas en progreso</p>
              @foreach($metas as $data)
                <div class="cardMetas text-black mb-4 w-1/3 px-2 h-128 flex flex-col" style="justify-content: center">
                  <div class="text-center w-full bg-gray-200" style="background-color: #D9D9D9; padding: 0; margin: 0!important; justify-content:center; border-radius:20px;">
                      <p class="truncated-text-d text-lg font-bold">{{ $data->nombre }}</p>
                  </div>
                </div>
              @endforeach
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- card2 -->
  <div class="w-full max-w-screen-sm px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4" style="width: 50%">
    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border" style="background-color: rgba(53, 58, 80, 0.67);">
      <div class="flex-auto p-4">
        <div class="flex flex-row -mx-3">
          <div class="flex-none w-2/3 max-w-full px-3">
            <div>
              <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase text-white dark:opacity-60">Rutinas</p>
              @foreach($rutina as $data)
              <div class="cardMetas text-black mb-4 w-1/3 px-2 h-128 flex flex-col">
                <div class="text-center w-full bg-gray-200 items-center justify-center" style="background-color: #D9D9D9; padding: 0; margin: 0!important; justify-content:center; border-radius:20px;">
                    <p class="truncated-text-d text-lg font-bold">{{ $data->nombre }}</p>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- card3 -->
    <div class="w-full max-w-screen-sm px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
      <img src="{{asset ('img/user/user_shape.png')}}" class="h-full w-full" alt="admin_dashboard" />
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