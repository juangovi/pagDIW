<?php
include ("coneccion.php");

function comprobarnick($datos){
    $conn=conectar();
    $sql = "SELECT * FROM usuarios WHERE Usuario_email LIKE '".$datos["nick"]."' or Usuario_nick LIKE '".$datos["nick"]."'";
    $result = $conn->query($sql);
    $res=0;
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc(); 
            $res=1;
            $contraseña=$row["Usuario_clave"];
            $res=comprobarcon($contraseña,md5($datos["contraseña"]));

            if($row["Usuario_bloqueado"]==1&&$res==2)
            $res=3;
        }
    return $res;//1=usuario correcto 2=usuario y contraseña correcto 3=todo correcto
}
function comprobarcon($contraseña1,$contraseña2){
    $res=0;
   if($contraseña1==$contraseña2)
   $res=2;
    return $res;
}
function obtenerdatos($datos){
    $conn=conectar();
    $sql = "SELECT * FROM usuarios WHERE Usuario_email LIKE '".$datos."' or Usuario_nick LIKE '".$datos."'";
    $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

        }
    return $row;
}
