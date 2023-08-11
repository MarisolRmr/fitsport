<!DOCTYPE html>
<html >
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="shortcut icon" href="{{asset('img/dembbell.png')}}">
	<title>Sign Up</title>
	<!-- Iconos -->
	<script src="https://kit.fontawesome.com/a8a964cfb5.js" crossorigin="anonymous"></script>

	<link rel="stylesheet" type="text/css" href="{{asset('css/estilos_principal.css')}}">

	<!-- Importar Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<style>
		.border-red-500{
			border: 2px solid red;
		}
	</style>
</head>
<body>
	<div class="containerl">
		<!-- Imagen decorativa -->
		<div class="image2"></div>
		<!-- Imagen decorativa arriba-->
		<img src="{{asset('img/img3.png')}}" class="img3">
		<!-- Caja negra -->
		<div class="black-box">
			<div class="d-flex align-items-center justify-content-center">
				<div>
					<!-- logotipo -->
					<img src="{{asset('img/logo.png')}}" style="margin-bottom: 7%; margin-top: 2%">

					<form action="{{route('register')}}" enctype="multipart/form-data" method="post" novalidate>
						@csrf
						<!-- Sección de entrada de datos personales -->
					   <div class="mb-5 row input-sign" style="padding-left: 2%; padding-right: 2% margin-bottom:10%;">
					    <div class="col-sm-6">
					      <label for="nombre" style="color: white font" class="form-label label">Nombre</label>
					      <input type="text" class="form-control @error ('nombre') border-red-500 @enderror"  value="{{old('nombre')}}" id="nombre" name="nombre" placeholder="Ingrese aquí su nombre">
					      @error ('nombre')
							<p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
								{{$message}}
							</p>
						  @enderror
						</div>
					    <div class="col-sm-6">
					      <label for="apellido" style="color: white font" class="form-label label">Apellido</label>
					      <input type="text" class="form-control  @error ('apellido') border-red-500 @enderror" value="{{old('apellido')}}"  id="apellido" name="apellido" placeholder="Ingrese aquí su apellido">
					      @error ('apellido')
							<p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
								{{$message}}
							</p>
						  @enderror
						</div>
					  </div>

					  <div class="mb-5 row input-sign" style="padding-left: 2%; padding-right: 2% margin-bottom:10%;">
					    <div class="col-sm-6">
					      <label for="correo" style="color: white font" class="form-label label">Correo electrónico</label>
					      <input type="email" class="form-control  @error ('correo') border-red-500 @enderror" value="{{old('correo')}}" id="correo" name="correo" placeholder="Ingrese aquí su correo">
					      @error ('correo')
							<p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
								{{$message}}
							</p>
						  @enderror
						</div>
					    <div class="col-sm-6">
					      <label for="telefono" style="color: white font" class="form-label label">Teléfono</label>
					      <input type="text" class="form-control @error ('telefono') border-red-500 @enderror" value="{{old('telefono')}}" id="telefono" name="telefono" placeholder="Ingrese aquí su telefono">
					      @error ('telefono')
							<p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
								{{$message}}
							</p>
						  @enderror
						</div>
					  </div>

					  <div class="mb-5 row input-sign" style="padding-left: 2%; padding-right: 2% margin-bottom:10%;">
					    <div class="col-sm-6">
					      <label for="fecha_nac" style="color: white font" class="form-label label">Fecha de nacimiento</label>
					      <input type="date" class="form-control  @error ('fecha_nac') border-red-500 @enderror" value="{{old('fecha_nac')}}" id="fecha_nac" name="fecha_nac" placeholder="Ingrese aquí su fecha de nacimiento">
					      @error ('fecha_nac')
							<p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
								{{$message}}
							</p>
						  @enderror
						</div>
					    <div class="col-sm-6">
					      <label for="usuario" style="color: white font" class="form-label label">Nombre de usuario</label>
					      <input type="text" class="form-control @error ('usuario') border-red-500 @enderror"  value="{{old('usuario')}}"  id="usuario" name="usuario" placeholder="Ingrese aquí su nombre de usuario">
					      @error ('usuario')
							<p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
								{{$message}}
							</p>
						  @enderror
						</div>
					  </div>

					  <div class="mb-5 row input-sign" style="padding-left: 2%; padding-right: 2% margin-bottom:10%;">
					    <div class="col-sm-6">
					      <label for="password" style="color: white font" class="form-label label">Contraseña</label>
					      <input type="password" class="form-control @error ('password') border-red-500 @enderror" id="password" name="password" value="{{old('password')}}"  placeholder="Ingrese aquí su contraseña">
					      @error ('password')
							<p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
								{{$message}}
							</p>
						  @enderror
						</div>
					    <div class="col-sm-6">
					      <label for="password_confirmation" style="color: white font" class="form-label label">Confirme la contraseña</label>
					      <input type="password" class="form-control @error ('password_confirmation') border-red-500 @enderror" id="password_confirmation" value="{{old('password_confirmation')}}" name="password_confirmation" placeholder="Ingrese aquí su contraseña de nuevo">
					      @error ('password_confirmation')
							<p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
								{{$message}}
							</p>
						  @enderror
						</div>
					  </div>

					  <!-- Sección para cargar una imagen -->
					  <div class="image-input-container mb-5">
					  	<label for="fotografia">
						  	<svg xmlns="http://www.w3.org/2000/svg" height="3em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#d3d3d3}</style><path d="M149.1 64.8L138.7 96H64C28.7 96 0 124.7 0 160V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V160c0-35.3-28.7-64-64-64H373.3L362.9 64.8C356.4 45.2 338.1 32 317.4 32H194.6c-20.7 0-39 13.2-45.5 32.8zM256 192a96 96 0 1 1 0 192 96 96 0 1 1 0-192z"/></svg>
						
					  		<span class="selected-image" style="background-image: url('{{ Session::get('imagen_cargada') }}')"></span>
					  		<input type="file" class="@error('fotografia') border-red-500 @enderror" id="fotografia" name="fotografia" value="{{old('fotografia')}}" accept="image/*" onchange="handleImageUpload(event)" />
					  		@error ('fotografia')
					  		<p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
					  			{{$message}}
					  		</p>
					  		@enderror
					  	</label>
					  </div>


					  <!-- Botón de registro -->
				      <div class="row">
				      	<div class="col justify-content-center align-items-center d-flex" style="margin-bottom: 15%">
				      		<button type="submit" class="button-sub">Sign Up</button>
				      	</div>
				      </div>
					</form>

					<!-- Enlace para iniciar sesión -->
					<div class="justify-content-center align-items-center d-flex" style="margin-bottom: 5rem">
				  	  <p class="p-reg">
				  	  	Ya tienes una cuenta? <a href="{{route('login')}}" style="color: #7B96D4">Inicia Sesión</a>
				  	  </p>
			      	</div>

				</div>
			</div>
		</div>
		<!-- Imagen decorativa abajo -->
		<img src="{{asset('img/img4.png')}}" class="img32">
	</div>

	<!-- Importar el archivo JavaScript de Bootstrap -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	<!-- Función para manejar la carga de imágenes -->
	<script>
		
		function handleImageUpload(event) {
		  const input = event.target;
		  const imageContainer = input.parentElement;
		  const selectedImage = imageContainer.querySelector('.selected-image');

		  const file = input.files[0];
		  const reader = new FileReader();

		  reader.onload = function (e) {
			console.log(e.target.result);
		    selectedImage.style.backgroundImage = `url(${e.target.result})`;
		  };

		  reader.readAsDataURL(file);
		}
	</script>
</body>
</html>
