<?php
// Start the session
session_start();
include("iniciar.php");
//setcookie("user", "", time() - 3600);
if(isset($_COOKIE[$cookie_name])) {
    $_SESSION["user"]=$_COOKIE[$cookie_name];
}
if (isset($_SESSION["user"])) {
    $datos = obtenerdatos($_SESSION["user"]);
    $cookie_name = "sesion";
    $cookie_value = $_SESSION["user"];
    setcookie($cookie_name, $cookie_value, time() + (86400), "/"); // 86400 = 1 day
}

?>
<!DOCTYPE html>
<html>
<head>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClEN8h3G0rA2mK5Mfp7slx4IJEsMNkhEM&callback=initMap&libraries=&v=weekly"
      defer
    ></script>
    <style type="text/css">
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 40%;
        width: 40%;
      }

      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
    <script>
      let map;
      if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(initMap);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
      function initMap(position) {
        map = new google.maps.Map(document.getElementById("map"), {
          center: { lat: position.coords.latitude, lng: position.coords.longitude },
          zoom: 15,

        });
        new google.maps.Marker({
    position: { lat: position.coords.latitude, lng: position.coords.longitude },
    map,
    title: "Hello World!",
  });
      }
    </script>
    <title>beti</title>
</head>
<body>
    <?php
    
    if (isset($_POST["salir"])) {
        // remove all session variables
        session_unset();

        // destroy the session
        session_destroy();
    }

    if (isset($_SESSION["user"])) {
        $datos = obtenerdatos($_SESSION["user"]); // 86400 = 1 day
    } else {
    ?>
        <script lang="JavaScript">
            window.location.href = "login.php";
        </script>
    <?php
    }
    echo "hola " . $datos["Usuario_nick"];
    if ($datos["Usuario_perfil"] == "admin")
        echo " es administrador de esta estupenda pagina web 😎🤏";
    ?>
    <button onclick="getLocation()">Try It</button>
    
<p id="demo"></p>

<script>
var x = document.getElementById("demo");

function getLocation() {
  
}

function showPosition(position) {
  x.innerHTML = "Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude;
}
</script>
    <form action="" method="post">
        <input type="hidden" name="salir" value="1">
        <input type="submit" value="cerrar sesion">
    </form>
    <form action="pag.php" method="post" enctype="multipart/form-data">
     cambiar imagen:
    <input type="file" name="fileToUpload" id="fileToUpload"><br>
    <input type="submit" value="subir" name="aceptar">
    </form>
    <div id="map"></div>
    <?php
        include("subirfoto.php");
        
        if(isset($_POST["aceptar"])){
        
        crearimg($datos["Usuario_nick"]);
        
        }
        $img=obtenerimg($datos["Usuario_nick"]);
        if($img==null||$img==""){
            $img="default.jpg";
        }
        echo "<img src='fotosperfil/".$img."' alt='f'>";
    ?>
    
</body>

</html>


