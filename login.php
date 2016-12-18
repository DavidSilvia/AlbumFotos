<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
	<title>Iniciar sesi&oacute;n</title>
	<meta  http-equiv="Content-Type" content="text/html;" charset="utf-8"/>
	<link rel="STYLESHEET" type="text/css" href="Estilo.css">	
</head>
<body>
	<span class="titulo">&Aacute;LBUM DE FOTOS</span><br/><br/>
	<p style="font-weight: bold;font-size:30px;">Identificaci&oacute;n de usuarios</p>
	<div style="position: absolute; left:500px;text-align: left;">
		<form action="login.php" method="post">
			<p> Nombre de usuario : <input type="usuario" required name="usuario" size="21" value="" required/></p>
			<p> Password: <input type="password" required name="pass" size="21" value="" required/></p>
			<p style="text-align: center;"> <input id="submit" type="submit" value="Iniciar sesi&oacute;n" class="boton"/></p>
			<p style="text-align: center;"><a href = 'Inicio.php' style="color: black;">Inicio</a></p><br/>
		</form>
	</div>
	<div style="position: absolute; left:450px;top: 350px;">
		<?php
		if (isset($_POST['usuario'])){

			$link = mysqli_connect("localhost","root","","album") or die(mysql_error());

			$usuario=$_POST['usuario']; 
			$pass=$_POST['pass'];
			if ( empty($usuario)|| empty($pass)) {
			die("<span style='font-size:20px; font-weight:bold; color:red;'> Error: Por favor, introduzca todos los campos</span>");
			}

	//Comprobación de usuario existente
			$usuarios = mysqli_query($link,"select * from usuario where Usuario='$usuario' and Password='$pass'");

			$cont= mysqli_num_rows($usuarios); 
			if($cont==1){

		//Comprobación de usuario dado de alta
				$confirmado = mysqli_query($link,"select * from usuario where Usuario='$usuario' and Password='$pass' and Confirmado=1");
				$cont = mysqli_num_rows($confirmado);
				if ($cont==0) {
					die("<span style='font-size:20px;color: red;font-style: italic;font-weight: bold;'>Lo sentimos, su solicitud de alta a&uacute;n no ha sido confirmada</span>");
				}

		//Inicio de sesión
				session_start();
				if(strstr($usuario, 'admin') != null){
					$_SESSION['tipo'] = '0';
				}
				else{
					$_SESSION['tipo'] = '1';
				}
				$_SESSION['usuario'] = $usuario;
				header("location: Inicioin.php");
			}
			else {
				echo "<p style='color:red;font-size:20px;font-weight: bold;position: absolute; left: 150px;'>Datos incorrectos</p>";
			}
			mysqli_close($link);
		}
		?>
	</div>
</body>
</html>


