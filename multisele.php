<?php
// Start the session

if(isset($_POST["multiselect"])){
    $valores=$_POST["multiselect"];
    echo "se selecionaron ".count($valores)." proeductos";

}