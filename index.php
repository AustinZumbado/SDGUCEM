<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./vistas/dist/img/favicon.ico">
    <link rel="icon" href="./vistas/dist/img/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="./login/fonts/icomoon/style.css">

    <link rel="stylesheet" href="./login/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./login/css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="./login/css/style.css">

    <title>Login UCEM</title>
  </head>

  <body>
  

  
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="./login/images/undraw_remotely_2j6y.svg" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <img src="login/images/ucemLogo.png" alt="Image" class="img-fluid">
              <p class="mb-4">Ingresar al sistema de gestion UCEM</p>
            </div>
            <form action="./controlador/ControlLogin.php?acc=2" method="POST">
              <div class="form-group first">
                <label for="Usuario">Cedula</label>
                <input type="text" class="form-control" id="Usuario" name="Usuario">

              </div>
              <div class="form-group last mb-4">
                <label for="Clave">Contraseña</label>
                <input type="password" class="form-control" id="Clave" name="Clave">
                
              </div>
              
              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Recuerdame</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="#" class="forgot-pass">Olvide la contraseña</a></span> 
              </div>

              <input type="submit" value="Ingresar" class="btn btn-block btn-primary">
            </form>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>

  
    <script src="./login/js/jquery-3.3.1.min.js"></script>
    <script src="./login/js/popper.min.js"></script>
    <script src="./login/js/bootstrap.min.js"></script>
    <script src="./login/js/main.js"></script>
  </body>
</html>