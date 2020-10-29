<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
  <link rel="stylesheet" href="./style.css">

  <?php
  $errornick = 100;
  $erroremail = 100;
  if (isset($_POST["nick"])) {
    include("comprobar.php");
    $errornick = comnick($_POST);
    $erroremail = comemail($_POST);
  }
  ?>
</head>

<body>
  <div class="container h-100vh" id="log" style="display: block;">
    <div class="row row h-100 align-items-center justify-content-centerr" >
      <div class="col align-self-cente ">
        <div class="card">
          <div class="card-header text-center display-4">
            registro
          </div>
          <div class="card-body">
            <form id="for" method="post" action="">
              <div class="form-group">
                <label for="nick">nick</label><?php if ($errornick == 1) {
                                                echo "<spam style='color: red'> *este nick ya exise</spam>";
                                              } ?>
                <input type="text" class="form-control" name="nick" id="nick" required placeholder="nombre de usuario">
              </div>

              <div class="form-group">
                <label for="email">Email</label><?php if ($erroremail == 1) {
                                                  echo "<spam style='color: red'> *este email ya esta en uso</spam>";
                                                } ?>
                <input type="email" class="form-control" name="email" id="email" required placeholder="email">
              </div>

              <div class="form-group">
                <label for="password">contraseña</label>
                <input type="password" class="form-control" name="contraseña" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="necesita al menos una letra minuscula y mayuscula un numero y 8 caracteres" required placeholder="contraseña">

              </div>

              <div class="form-group>">
                <label for="password" id="ojo">confir Password</label>
                <input type="password" class="form-control" id="conpassword" required placeholder="Password">

              </div>
              <div>
              <a href="login.php">¿ya tienes cuenta?</a>
              <p id="mensaje" style="color: #fa0505; text-align: right; float: right">

              </p>
              </div>
              <button type="button" id="boton" class="btn btn-primary btn-lg btn-block" onclick="comprobar()">registrar</button>
              <?php
              $correcto = 0;
              if ($erroremail + $errornick == 0) {
                include("insertar.php");

                $correcto = insertar($_POST);
              }
              ?>


              <script>
                function comprobar() {
                  var con1 = document.getElementById("password").value;
                  var con2 = document.getElementById("conpassword").value;
                  if (con1 == con2) {
                    document.getElementById("boton").type = "submit";
                    document.getElementById("mensaje").innerHTML = "";
                  } else {
                    document.getElementById("mensaje").innerHTML = "contraseña no coinciden";
                    document.getElementById("boton").type = "button";
                  }
                }
              </script>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container h-100vh" id="mod" style="display: none;">
  <?php
      if ($correcto == 1) {?>
        <script>
          document.getElementById('mod').style.display='block';
          document.getElementById('log').style.display='none';
        </script>
  <?php
      
      }
      ?>
    <div class="row row h-100 align-items-center justify-content-centerr">
      <div class="col align-self-cente ">
        <div class="card">
          <div class="card-header text-center display-4">
            gracias
          </div>
          <div class="card-body">
            <p class="parrafo">se le ha enviado un correo electronico con un link de verificacion
            antes de poder entrar tendras que ir al correo electronico adjunto y verificar su correo</p>
            <a href="login.php" id="boton" class="btn btn-primary btn-lg btn-block">Login</a>
          </div>
  
</body>

</html>