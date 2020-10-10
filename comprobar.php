
<?php
include ("coneccion.php");
function comnick($datos){
    
    $conn=conectar();
    $sql = "SELECT Usuario_nick FROM usuarios WHERE Usuario_nick LIKE '".$datos["nick"]."'";
    $result = $conn->query($sql);
    $res=0;
        if ($result->num_rows > 0) {
            $res=1;
        }
    return $res;
}
?>