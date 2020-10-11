<?php
    function insertar($datos){
        $conn=conectar();
        $nick=$datos["nick"];
        $email=$datos["email"];
        $contraseña=md5($datos["contraseña"]);
        $hoy = date("m.d.y");
        $token=md5($nick.$hoy.$email);
       $correcto=0;
       $sql = "INSERT INTO  usuarios (Usuario_nick,Usuario_email,Usuario_clave,Usuario_token_aleatorio) 
       VALUES ('$nick','$email','$contraseña','$token')";
       if (mysqli_query($conn, $sql)) {
       enviocorreo($email, $token);
        $correcto=1;
       
       }
       return $correcto;
    }
    function enviocorreo($email,$token){
        $headers="";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$mensage="
<html>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
<head>

<style>
 h1{
     text-align: center;
 }
</style>
</head>
<body>
<h1>bienvenido a mi pagina
<a class='w3-button w3-black' href='http://juanantonio.dx.am/verificacion.php?tk=".$token."'>Link Button</a></h1>
</body>
</html>";

$success = mail($email, "verifica tu correo", $mensage,$headers);
if (!$success) {
$errorMessage = error_get_last()['message'];
}
    }

?>