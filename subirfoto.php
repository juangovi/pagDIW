<?php
    session_start();
    
    function crearimg($usuario){
        
    $conn=conectar();
    $target_dir = "fotosperfil/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imagen=$_FILES["fileToUpload"]["name"];
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        
        $uploadOk = 1;
      } else {
      
        $uploadOk = 0;
      }
    
    
    // Check if file already exists
    /*if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }*/
    
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
      
      $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      
      $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $sql = "UPDATE usuarios SET Usuario_fotografia='".$usuario.$imagen."' WHERE Usuario_nick LIKE '".$usuario."'";
        $result = $conn->query($sql);
        rename("fotosperfil/".$imagen,"fotosperfil/".$usuario.$imagen);
      } else {
        
      }
    }
    
    
    }
    function obtenerimg($usuario){
        $conn=conectar();
        $sql = "SELECT Usuario_fotografia FROM usuarios WHERE Usuario_nick LIKE '".$usuario."'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row["Usuario_fotografia"];
    }
?>