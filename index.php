<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
  <div class="container h-100vh">
    <div class="row row h-100 align-items-center justify-content-centerr">
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
              <a href="login.php">¿ya tienes cuenta?</a>
              <p id="mensaje" style="color: #fa0505">

              </p>
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
  <div class="w3-container">



    <div id="id01" class="w3-modal w3-animate-opacity" style="display: none;">
      <?php
      if ($correcto == 1) {
        echo "<script>
      
                                document.getElementById('id01').style.display='block';
                           </script>";
      }
      ?>

      <div class="w3-modal-content w3-card-4">
        <header class="w3-container w3-teal">
          <h2>gracias por registrarte</h2>
        </header>
        <div class="w3-container">
          <p>se le ha enviado un correo de verificacion a su cuenta de correo</p>
          <p>verifique su cuenta y vuelva a iniciar sesion</p>
        </div>
        <footer class="w3-container w3-teal">
          <form method="get" action="login.php">
            <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
          </form>
        </footer>
      </div>
    </div>
  </div>
</body>

</html>