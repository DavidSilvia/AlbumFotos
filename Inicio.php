<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Inicio</title>
	<meta http-equiv="Content-Type" content="text/html;" charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="Estilo.css"/>
	<script>
	//<![CDATA[
	//Validación cliente
	function verificar(){
		var nombre = document.getElementById('nombre').value;
		var apellidos = document.getElementById('apellidos').value;
		var usuario = document.getElementById('usuario').value;
		var email = document.getElementById('correo').value;
		var contrasena = document.getElementById('contrasena').value;
		var repetir = document.getElementById('repetir').value;
		var fecha = document.getElementById('fecha').value;
		var sexo = document.getElementsByName('sexo');

		if ((nombre.length == 0) || (apellidos.length == 0) || (usuario.length == 0) || (email.length == 0) || (contrasena.length == 0) || (fecha.length == 0) || (repetir.length == 0)) {
			alert("Por favor, introduzca todos los campos");
			return false;
		}

		var seleccionado = false;
		for(var i=0; i < sexo.length; i++){
			if(sexo[i].checked) seleccionado=true;
		}
		if (!seleccionado) {
			alert("Por favor, introduzca todos los campos");
			return false;
		}

		if (contrasena.localeCompare(repetir) != 0) {
			alert("Las contraseñas no coinciden");
			return false;
		}

		var exp = /^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/;
		if (!exp.test(fecha)) {
			alert("El formato de fecha correcto es 'aaaa-mm-dd'");
			return false;
		}

		return true;
	}
		//]]>
	</script>
</head>
<body>
	<span class="titulo">ÁLBUM DE FOTOS</span><br/><br/>
	<div style="text-align: left;top: 100px;position: absolute;left: 900px;">
		<p style="font-weight: bold;font-size:30px;">Registro</p>
		<form action="Inicio.php" method="post" onsubmit="return verificar()">
			<p>Nombre: <input type="text" id="nombre" name="nombre"/></p>
			<p>Apellidos: <input type="text" id="apellidos" name="apellidos"/></p>
			<p>Nombre de usuario: <input type="text" id="usuario" name="usuario"/></p>
			<p>Correo electrónico: <input type="email" id="correo" name="correo" placeholder="ejemplo@ejemplo.com" /></p>
			<p>Contraseña: <input type="password" id="contrasena" name="contrasena"/></p>
			<p>Repetir contraseña: <input type="password" id="repetir" name="repetir"/></p>
			<p>Fecha de nacimiento: <input type="date" id="fecha" name="fecha" placeholder="aaaa-mm-dd" /></p>
			<p>Sexo: 
				<br/>
				<input type="radio" name="sexo" value="mujer"/> Mujer 
				<input type="radio" name="sexo" value="hombre" /> Hombre
			</p>
			<p><input type="submit" name="registro" value="Regitrarse" class="boton" /></p>
		</form>
		</div>
		<div style="text-align: left;top: 200px;position: absolute;left: 200px;  width: 600px;">
		Esta aplicaci&oacute;n te permitir&aacute; subir &aacute;lbumes d&oacute;nde podr&aacute;s subir tus fotos y adem&aacute;s tendr&aacute;s la opci&oacute;n de compartirlas con todo el mundo, 
		con los usuarios registrados o guardarlas online exclusivamente para ti. Adem&aacute;s, podr&aacute;s buscar fotos por etiquetas y etiquetar tus fotos. <br/><br/>
		<span style= 'position: absolute; text-align: center;font-size: 20px; left: 100px;'>Comienza a disfrutar de nuestros servicios!<br/><br/>
		<a href='VerFotos.php' id='bfsu'>Ver fotos p&uacute;blicas</a></span>
		</div>
		<p>Si ya está registrado, inicie sesión: <a style="padding: 10px;color: black;font-weight: bold;" href="login.php">Log in</a></p>
		<?php
		if (isset($_POST['usuario'])) {
			$nombre = $_POST['nombre'];
			$apellidos = $_POST['apellidos'];
			$usuario = $_POST['usuario'];
			$correo = $_POST['correo'];
			$contrasena = $_POST['contrasena'];
			$fecha = $_POST['fecha'];
			if (isset($_POST['sexo'])) {
				$sexo = $_POST['sexo'];
			}
			else{
				die("<span style='font-size:20px; font-weight: bold;color: red;'>Error:Por favor, introduzca todos los campos</span>");
			}

		//Validación servidor
			if (empty($nombre) || empty($apellidos) || empty($usuario) || empty($correo) || empty($contrasena) || empty($fecha)) {
				die("<span style='font-size:20px; font-weight:bold; color:red;'> Error: Por favor, introduzca todos los campos</span>");
			}
			if(!preg_match("/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/", $fecha)){
				die("<span style='font-size:20px;font-weight: bold;color: red;'>Error: El formato de fecha correcto es 'aaaa-mm-dd' </span>");
			}

		//Inserción en la BD
			$link = mysqli_connect("localhost","root","","album");
			$sql = "INSERT INTO usuario(Nombre, Apellidos, Usuario, Correo, Password, FechaNac, Sexo,Confirmado) VALUES ('$nombre','$apellidos', '$usuario', '$correo','$contrasena', '$fecha', '$sexo',0)";
			if(!mysqli_query($link, $sql)){
				die("<span style='font-size:20px;font-weight: bold;color: red;'>Error:".mysqli_error($link)."</span>");
			}
			echo "<span style='font-size:20px;font-style: italic;'>¡Se ha registrado correctamente!</span><br/>";
			echo "<span style='font-size:15px;font-style: italic;'>En breves momentos se dará de alta a su cuenta</span>";
			mysqli_close($link);
		}
		?>
	</div>
</body>
</html>
