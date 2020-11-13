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
    <form action="" method="post">
        <input type="hidden" name="salir" value="1">
        <input type="submit" value="cerrar sesion">
    </form>
    <form action="pag.php" method="post" enctype="multipart/form-data">
     cambiar imagen:
    <input type="file" name="fileToUpload" id="fileToUpload"><br>
    <input type="submit" value="subir" name="aceptar">
    </form>
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