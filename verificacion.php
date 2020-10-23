<!DOCTYPE html>
<html>
<body>
<?php
include ("coneccion.php");
    	$conn=conectar();
$token=$_GET["tk"];
 $sql = "UPDATE usuarios SET Usuario_bloqueado=1 WHERE Usuario_token_aleatorio='$token'";
    $result = $conn->query($sql);
        if ($result) {
        	echo "bien";
    }else{
    	echo "mal";
    }
?>
</body>
</html>