<?php
include ("coneccion.php");
function comprobarnick($datos){
    $conn=conectar();
    $sql = "SELECT Usuario_clave FROM usuarios WHERE Usuario_email LIKE '".$datos["nick"]."' or Usuario_nick LIKE '".$datos["nick"]."'";
    $result = $conn->query($sql);
    $res=0;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $contraseña=$row["Usuario_clave"];
                $res=comprobarcon($contraseña,md5($datos["contraseña"]));
              }
            $res++;
        }
    return $res;
}
function comprobarcon($contraseña1,$contraseña2){
    $res=0;
   if($contraseña1==$contraseña2)
   $res=1;
    return $res;
}
?>