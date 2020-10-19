<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<body>
<?php
if (isset($_SESSION["user"])) {
    
}else{
    ?>
    <script lang="JavaScript">
         window.location.href = "login.php";
    </script>
    <?php
}
echo "hola".$_SESSION["user"];
?>
</body>
</html>
