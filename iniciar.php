<?php
include ("coneccion.php");
function comprobarnick($datos){
    $conn=conectar();
    $sql = "SELECT * FROM usuarios WHERE Usuario_email LIKE '".$datos["nick"]."' or Usuario_nick LIKE '".$datos["nick"]."'";
    $result = $conn->query($sql);
    $res=0;
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
                $contraseña=$row["Usuario_clave"];
                $res=comprobarcon($contraseña,md5($datos["contraseña"]));

              
            $res++;
            if($row["Usuario_bloqueado"]==0)
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