
<?php
function conectar(){
$servername = "localhost";
$username = "zsdkknxf_Usuario";
$password = "trebujenaA1";
$dbname = "zsdkknxf_Usuario";
$con = new mysqli($servername, $username, $password,$dbname);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
return $con;
}
?>