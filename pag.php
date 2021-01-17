<?php
// Start the session
session_start();
include("iniciar.php");
//setcookie("user", "", time() - 3600);
if(isset($_COOKIE[$cookie_name])) {
    //$_SESSION["user"]=$_COOKIE[$cookie_name];
}
if (isset($_POST["salir"])) {
  // remove all session variables
  session_unset();

  // destroy the session
  session_destroy();
}  
if (isset($_SESSION["user"])) {
    $datos = obtenerdatos($_SESSION["user"]);
    $cookie_name = "sesion";
    $cookie_value = $_SESSION["user"];
    setcookie($cookie_name, $cookie_value, time() + (86400), "/"); // 86400 = 1 day
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

     
?>
<script>
  function enviar(){
    document.formulario1.submit()
  }
</script>
<?php
        include("subirfoto.php");
        
        if(isset($_POST["aceptar"])){
        crearimg($datos["Usuario_nick"]);
        
        }
        $img=obtenerimg($datos["Usuario_nick"]);
        if($img==null||$img==""){
            $img="default.jpg";
        }
        
    ?>
<?php

$antonio=$datos["coordenadas"];
$prueba=explode(",", $antonio)
?>
<!doctype html>
<html lang="en">

<head>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClEN8h3G0rA2mK5Mfp7slx4IJEsMNkhEM&callback=initMap&libraries=&v=weekly"
    defer></script>
  <script>
    function initMap() {
      map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: <?php echo $prueba[0];?>, lng: <?php echo $prueba[1];?>},
        zoom: 5,

      });
      <?php
        $conn=conectar();
        $sql = "SELECT * FROM usuarios";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
          $imagen=$row["Usuario_fotografia"];
          $antonio=$row["coordenadas"];
          $prueba=explode(",", $antonio)
          ?>
           var icon = {
    url: "fotosperfil/<?php echo $imagen;?>", // url
    scaledSize: new google.maps.Size(30, 30), // scaled size
    origin: new google.maps.Point(0,0), // origin
    anchor: new google.maps.Point(0, 0) // anchor
};
      new google.maps.Marker({
    position: { lat: <?php echo $prueba[0];?>, lng: <?php echo $prueba[1];?> },
    map,
    icon: icon,
    title: "<?php echo $row["Usuario_nick"];?>",
  });
    
          <?php
        }
        
        
      ?>
      }
      
  </script>
  <?php
  if (isset($_GET["pg"])) {
    $page = $_GET["pg"];
  }else{
    $page = 1;
  }
  $conn=conectar();
  $sql = "SELECT * FROM productos";
  $result = $conn->query($sql);
  $totalResultados = mysqli_num_rows($result);
  $resultadoPorPaginas = 9;
  $numeroPaginas = ceil($totalResultados / $resultadoPorPaginas);
  $primeraPagina = ($page - 1) * $resultadoPorPaginas;
  $sql = "SELECT * FROM productos LIMIT " . $primeraPagina . ',' . $resultadoPorPaginas;
  $result = $conn->query($sql);
  

  ?>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <title>Hello, world!</title>
  <link rel="stylesheet" href="css/estilos.css" />
</head>

<body>
  <!-- navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Dropdown
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Disabled</a>
        </li>
      </ul>
      <div class="btn-group">
        <button type="button" class="border-0 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false">
          <img class="img-fluid drop_perfil rounded-circle" src="fotosperfil/<?php echo $img;?>" alt="">
        </button>
        <div class="dropdown-menu dropdown-menu-right">
          <form action="" method="post">
            <input type="hidden" name="salir" value="1">
            <input type="submit" class="dropdown-item" value="cerrar sesion">
        </form>
        <a href="#" class="dropdown-item" >hola</a>
        </div>
      </div>
  </nav>
  <!-- navbar -->
  <div class="container-fluid my-5 bg-light rounded cuerpo">
    <div class="row">
      <div class="col-md-3">
        <!-- cuadro -->
        <div class="card my-3">
        <form action="pag.php" method="post" name="formulario1" enctype="multipart/form-data" id="formulario">
            <div class="teste divide">
            <label for="fileToUpload" class="thumbnail divide">
              <img src="fotosperfil/<?php echo $img;?>" class="card-img-top img-fluid rounded-circle" alt="...">
              <div class="image-overlay">
              <div class="circle-icon">
                <i class="fa fa-upload" aria-hidden="true"></i>
              </div>
             </div>
            </label>
            <input type="hidden" value="subir" name="aceptar">
            <input type="file" name="fileToUpload" id="fileToUpload" onchange="enviar()">
      </div>
          </form>
          <div class="card-body">
            <h5 class="card-title"><?php echo $datos["Usuario_nick"]; ?></h5>
            <p class="card-text"> direccion: mi casa</p>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional
              content. This content is a little bit longer.</p>
              
          </div>
      </div>
      
        <!-- cuadro -->
          <div class="container-fluid my-3" id="map">
          </div>
      </div>
      <div class="col-md-9">
        <div class="container">
        <?php
        while ($row = $result->fetch_assoc()) {
        ?>
                  <div class="card iten mx-1 my-3 mx-lg-4 my-lg-5" style="width: 18rem; float: left; height: 500px;">
                    <img src="img/ezviz-c1c-plus-camara-de-seguridad-ip-interior-blanca.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title titulo">Zotac GAMING GeForce RTX 3090 Trinity 24GB GDDR6X</h5>
                    </div>
                    
                    <div class="card-body">
                      <a href="#" class="card-link btn btn-danger">comprar</a>
                      precio:
                    </div>
                  </div>
          <?php
                }
         ?>       
        </div>
      
      
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-9">
      <nav aria-label="Page navigation example" class="text-center">
  <ul class="pagination class="text-center">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <?php
    for ($page2 = 1; $page2 <= $numeroPaginas; $page2++) {
      
     ?>
    <li class="page-item"><a class="page-link" href="pag.php?pg=<?php echo $page2;?>"><?php echo $page2;?></a></li>
  <?php
  }
     ?>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
      </div>
    </div>
  </div>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
</body>

</html>