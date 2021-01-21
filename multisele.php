<?php
// Start the session
include("coneccion.php");

if(isset($_POST["multiselect"])){
    $valores=$_POST["multiselect"];
    echo "se eliminaron ".count($valores)." proeductos";
    for ($i=0; $i < count($valores); $i++) { 
        $conn=conectar();
        $sql = "DELETE FROM productos WHERE id ='".$valores[$i]."'";
        $result = $conn->query($sql);
    }
}