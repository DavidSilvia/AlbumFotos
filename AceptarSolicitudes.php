<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Aceptar Solicitudes</title>
	<meta http-equiv="Content-Type" content="text/html;" charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="Estilo.css"/>
	<script>
	//<![CDATA[
	function mostrarUsuarios(){
		
		if(window.XMLHttpRequest){
			xmlhttp = new XMLHttpRequest();
		}else{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState==4 && xmlhttp.status==200){
				document.getElementById("usuarios").innerHTML=xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET", "VerUsuarios.php", true);
		xmlhttp.send();	
	}
		//]]>
	</script>
</head>
<body onload="mostrarUsuarios()">
	<?php
	session_start();
	if(!isset($_SESSION['usuario']) || (strstr($_SESSION['tipo'],'1')!=null)){
		header("Location:login.php");
	}
	?>
	<span class="titulo">ÁLBUM DE FOTOS</span><br/><br/>
	<div id="usuarios" style="position: absolute;top: 100px; width: 40%;float: left;">
		<img id="loading" src="loading2.gif" width="50" height="50">
	</div>
	<div style="width: 59%;float: right;">
		<p style="font-weight: bold;font-size:30px;">Usuarios a aceptar</p>
		<form onsubmit="mostrarUsuarios()" action="AceptarSolicitudes.php" method="POST" >
			<p>Nombre de usuario: <input type="text" id="usuario" name="usuario" required/></p>
			<p><input type="submit" name="aceptar" value="Aceptar usuario" class="boton" /></p>
		</form>
		<p style="text-align: center;"><a href = 'Inicioin.php' style="color: black;">Inicio</a></p><br/>
		<?php
		if (isset($_POST['usuario'])) {
			$usuario = $_POST['usuario'];

			$link = mysqli_connect("localhost","root","","album");
			$sql = mysqli_query($link,"update usuario set Confirmado=1 where Usuario='$usuario'");
			if(!$sql){
				die("Error:".mysqli_error($link));
			}

			echo "<span style='font-size:20px;font-style: italic;'>El usuario $usuario ha sido aceptado </span><br/>";
			
			$email = mysqli_query($link, "select Correo from usuario where Usuario='$usuario'");
			$email = mysqli_fetch_row($email);
			$email = $email[0];
			mysqli_close($link);
			mail($email, 'Album de fotos', 'Su solicitud ha sido aceptada, ya puedes disfrutar de nuestros servicios.');
		}
		?>
	</div>
</body>
</html>