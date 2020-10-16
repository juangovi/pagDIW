<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<body>
<?php
echo $_SESSION["user"];
?>
</body>
</html>