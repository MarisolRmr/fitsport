
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log In</title>
    <!--Iconos -->
    <script src="https://kit.fontawesome.com/a8a964cfb5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/estilos_principal.css')}}">
    <!-- Importar Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <!-- Contenedor principal -->
    <div class="containerl" style="width: 100%">
        <!-- Imagen decorativa -->
        <div class="image5"></div>
        <!-- Imagen del decoracion arriba -->
        <img src="{{asset('img/img3.png')}}" class="img3">
        <!-- Caja de inicio de sesión -->
        <div class="black-box">
            <div class="d-flex align-items-center justify-content-center">
                <div>
                    <!-- Logotipo -->
                    <img src="{{asset('img/logo.png')}}" style="margin-bottom: 7%; margin-top: 2%">

                    <!-- Formulario de inicio de sesión -->
                    <form action="" method="post">
                        <!-- Campo de nombre de usuario -->
                         <div class="mb-5 row input-sign" style="padding-left: 2%; padding-right: 2%; margin-bottom: 10%;">
                            <div class="col mb-3 " style="padding-left: 10%; padding-right: 10%">
                              <label for="username" style="color: white; margin-left: 2%" class="form-label label">Nombre de usuario</label>
                              <input type="text" class="form-control " style="height: 43px; margin-bottom: 8%" id="username" name="username" placeholder="Ingrese aquí su nombre de usuario">
                            
                              <!-- Campo de contraseña -->
                              <label for="password" style="color: white; margin-left: 2%" class="form-label label">Contraseña</label>
                              <input type="password" class="form-control"  style="height: 43px ; margin-bottom: 5%" id="password" name="password" placeholder="Ingrese aquí su contraseña">

                              <!-- Opción "Keep me logged in" -->
                              <div class="form-check align-items-center d-flex">
                                <input type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label label-check" for="flexCheckDefault">
                                  Keep me logged in
                                </label>
                              </div>
                            </div>
                        </div>

                        <!-- Botón de inicio de sesión -->
                        <div class="row">
                            <div class="col justify-content-center align-items-center d-flex" style="margin-bottom: 10%">
                                <button type="submit" class="button-sub">Log In</button>
                            </div>
                        </div>

                        <!-- Mostrar mensaje de error en caso de credenciales incorrectas -->
                        <?php if (isset($error)) { ?>
                            <div class="row">
                                <div class="col justify-content-center align-items-center d-flex" style="margin-top: 10px; color: red;">
                                    <?php echo $error; ?>
                                </div>
                            </div>
                        <?php } ?>
                    </form>

                    <!-- Enlace de registro -->
                    <div class=" justify-content-center align-items-center d-flex" style="margin-bottom: 4rem">
                        <p class="p-reg">
                            Aún no tienes una cuenta? <a href="registrarse.php" style="color: #7B96D4">Registrate</a>
                        </p>
                    </div>
                </div>      
            </div>
        </div>
        <!-- Imagen de decoracion abajo -->
        <img src="{{asset('img/img4.png')}}" class="img33" >
    </div>

    <!-- Importar el archivo JavaScript de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    
</body>
</html>
