<?php
  session_start();
  session_unset();
  session_destroy();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../login/fonts/icomoon/style.css">
  <link rel="stylesheet" href="../login/css/owl.carousel.min.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../login/css/bootstrap.min.css">
  <!-- Style -->
  <link rel="stylesheet" href="../login/css/style.css">
  <title>Login UCEM</title>
</head>

<body>
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="../login/images/undraw_remotely_2j6y.svg" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
                <img src="../login/images/ucemLogo.png" alt="Image" class="img-fluid">
                <h2 class="mb-4">Su sesión se ha cerrado o ha caducado. por favor conéctese de nuevo.</h2>
              </div>
              <button onclick="location.href='../index.php'" class="btn btn-block btn-primary">Regresar al login</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script src="../login/js/jquery-3.3.1.min.js"></script>
  <script src="../login/login/js/popper.min.js"></script>
  <script src="../login/js/bootstrap.min.js"></script>
  <script src="../login/js/main.js"></script>
</body>

</html>