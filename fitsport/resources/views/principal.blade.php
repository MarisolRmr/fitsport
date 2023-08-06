<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="shortcut icon" href="{{asset('img/dembbell.png')}}">
	<title>FitSport</title>
	
	<!-- Iconos -->
	<script src="https://kit.fontawesome.com/a8a964cfb5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/estilos_principal.css')}}">

	<!-- Importar Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body>
	<!-- Barra de navegación -->
	<nav>
		<div class="topnav">
		  <a class="nav-a" href="{{route('login')}}"><h4 style="margin-bottom:0px">Iniciar Sesión</h4></a>
		  <a class="nav-a" href="{{route('register')}}"><h4 style="margin-bottom:0px">Crear Cuenta</h4></a>
		</div>
	</nav>
	
	<!-- Contenido principal -->
	<div class="content" >
		<!-- Carrusel de imágenes -->
		<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
		  <div class="carousel-inner">
		    <div class="carousel-item active">
		      <img src="{{asset('img/carousel1.png')}}" class="d-block w-100" alt="imagen-ilustrativa-1">
		    </div>
		    <div class="carousel-item">
		      <img src="{{asset('img/carousel2.png')}}" class="d-block w-100" alt="imagen-ilustrativa-2">
		    </div>
		    <div class="carousel-item">
		      <img src="{{asset('img/carousel3.png')}}" class="d-block w-100" alt="imagen-ilustrativa-3">
		    </div>
		  </div>
		  <!-- Botones de control del carrusel -->
		  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev" style="z-index: 0">
		    <span class="fa fa-solid fa-angle-left" aria-hidden="true"></span>
		    <span class="visually-hidden">Previous</span>
		  </button>
		  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next" style="z-index: 0">
		    <span class="fa fa-solid fa-angle-right" aria-hidden="true"></span>
		    <span class="visually-hidden">Next</span>
		  </button>
		</div>
		<div class="row w-100">
			<div class="col-md">
				<!-- Elemento de decoración -->
				<div class="decoration"></div>
				<!-- Imagen -->
				<img src="{{asset('img/img1.png')}}" class="img1 ">
				
			</div>
			<div class="col-md" >
				<!-- Frase descriptiva -->
				<p class="frase1">
					La fuerza y el crecimiento llegan del esfuerzo continuo. Únete a FitSport y crea la mejor versión de ti. <br>
					
				</p>
				<br>
				<!-- Botón de unirse -->
				<div class="unirse">
					<a href="{{route('register')}}"  >UNIRSE</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Importar el archivo JavaScript de Bootstrap -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>
