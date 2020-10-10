<!DOCTYPE html>
<html>
<head>
<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'><link rel="stylesheet" href="./style.css">
<?php
if(isset($_POST["nick"])){
    include ("comprobar.php");
    $lol=comnick($_POST);
    echo $lol;
}
?>
</head>
<body>
<div class="container h-100vh">
	<div class="row row h-100 align-items-center justify-content-centerr">
		<div class="col align-self-cente ">
			<div class="card">
				<div class="card-header text-center display-4">
					registro
				</div>
				<div class="card-body">
					<form id="xd" method="post" action="">
                    <div class="form-group">
							<label for="nick">nick</label>
							<input type="text" class="form-control" name="nick" id="nick" required placeholder="nombre de usuario">
						</div>

						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" class="form-control" id="email" required placeholder="email">
                        </div>

                        <div class="form-group">
							<label for="password">contraseña</label>
							<input type="password" class="form-control" id="password" required placeholder="contraseña">
							
                        </div>
                        
						<div class="form-group>">
							<label for="password" id="ojo">confir Password</label>
							<input type="password" class="form-control" id="conpassword" required placeholder="Password">
							
                        </div>
                        <p id="mensaje" style="color: #fa0505">
                           
                        </p>
                        <button type="button" id="boton" class="btn btn-primary btn-lg btn-block" onclick="comprobar()">registrar</button>
                        <script>
                            function comprobar(){
                            var con1=document.getElementById("password").value;
                            var con2=document.getElementById("conpassword").value;
                            if (con1==con2) {
                                document.getElementById("boton").type="submit";
                                document.getElementById("mensaje").innerHTML="";
                            }else{
                            document.getElementById("mensaje").innerHTML="contraseña no coinciden";
                            document.getElementById("boton").type="button";
                            }
                            }
                        </script>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>