<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>

<head>

	<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
	<link rel="stylesheet" href="./style.css">
</head>

<body>
	<div class="container h-100vh">
		<div class="row row h-100 align-items-center justify-content-centerr">
			<div class="col align-self-cente ">
				<div class="card">
					<div class="card-header text-center display-4">
						iniciar sesion
					</div>
					<?php
					if (isset($_POST["nick"])) {
						include("iniciar.php");
						$res = comprobarnick($_POST);
						if ($res == 3) {
							$_SESSION["user"] = $_POST["nick"];
							$_SESSION["contraseña"] = $_POST["contraseña"];
					?>
							<script lang="JavaScript">
								window.location.href = "pag.php";
							</script>
					<?php
						}else if($res==1){
							//bloqueo($_POST);
						}
						
					}
					?>
					<div class="card-body">
						<form id="for" method="post" action="login.php">
							<div class="form-group">
								<label for="nick">nick o correo electronico</label>
								<input type="text" class="form-control" name="nick" id="nick" required placeholder="email/nick">
							</div>

							<div class="form-group">
								<label for="password">contraseña</label>
								<input type="password" class="form-control" name="contraseña" id="password" title="necesita al menos una letra minuscula y mayuscula un numero y 8 caracteres" required placeholder="contraseña">

							</div>
							<a href="index.php">crear cuenta</a>
							<p id="mensaje" style="color: #fa0505">
								<?php
								if (isset($_POST["nick"])) {
									if ($res < 2) {
										echo "datos incorrecto";
									}
								}
								?>
							</p>
							<button type="submit" id="boton" class="btn btn-primary btn-lg btn-block" onclick="">registrar</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>