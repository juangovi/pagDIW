<?php
// Start the session
include("coneccion.php");
$conn=conectar();
if(isset($_POST["multiselect"])){
    $valores=$_POST["multiselect"];
    echo "se eliminaron ".count($valores)." proeductos";
    for ($i=0; $i < count($valores); $i++) { 
        $sql = "DELETE FROM productos WHERE id =".$valores[$i];
        $result = $conn->query($sql);
    }
}