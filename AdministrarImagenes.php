<html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
if(!isset($_SESSION['usuario']) || (strstr($_SESSION['tipo'],'0')!=null)){
	header("Location:login.php");
}
if (isset($_GET['id'])) {
	$_SESSION['album'] = $_GET['id'];
}
?>
<head>
	<title>Ver imágenes</title>
	<meta http-equiv="Content-Type" content="text/html;" charset="utf-8"/>
	<link rel="STYLESHEET" type="text/css" href="Estilo.css">
	<script type="text/javascript">
		//<![CDATA[

		function validar(){
			var titulo = document.getElementById('titulo').value;
			if (titulo.includes('~') || titulo.includes('"') || titulo.includes('#') || titulo.includes('%') || titulo.includes('&') || titulo.includes('*') || titulo.includes(':') || titulo.includes('<') || titulo.includes('>') || titulo.includes('?') || titulo.includes('/') || titulo.includes('{') || titulo.includes('|') || titulo.includes('}') || titulo.includes('+') || titulo.includes('\\')){
				alert("Ha introducido un caracter no válido, elimínelo y vuelva a intentarlo");
				return false;
			}
			mostrarImagenes();
			return true;
		}

		function mostrarImagenes(){
			if(window.XMLHttpRequest){
				xmlhttp = new XMLHttpRequest();
			}else{
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.open("GET", "VerImagenes.php", true);
			xmlhttp.onreadystatechange=function(){
				if(xmlhttp.readyState==4 && xmlhttp.status==200){
					document.getElementById('imagenes').innerHTML=xmlhttp.responseText;
				}
			}
			xmlhttp.send();
		}
		//]]>
	</script>
</head>
<body onload="mostrarImagenes()">
	<span class="titulo">&Aacute;LBUM DE FOTOS</span><br/><br/>
	<div style="margin-top: 20px;">
		<span style="font-weight: bold;font-size:20px;position: absolute; left:35%; text-align:left;">Estos son las imágenes de tu álbum</span>
		<span><a style="color: black; position:absolute; left:70%;" href="logout.php">Log out</a></span>
	</div>
	<p style="position: absolute; left: 675px; top: 100px; color: black;"><a href = 'Inicioin.php'>Inicio</a></p>
	<form action="AdministrarImagenes.php" method="POST" enctype= "multipart/form-data" onsubmit="return validar();">
		<span style="position: absolute;left: 450px;top: 150px;">Titulo: <input type="text" name="titulo" id="titulo" required="required" />&nbsp;&nbsp; Imagen: <input type="file" name="foto" id="foto" required="required"/>&nbsp;&nbsp;<input type="submit" name="subir" id="subir" value="Subir foto" /></span>
		<span style="position: absolute; left:500px; top: 175px">
			Visibilidad: 
			<input id= "visibility" type="radio" name="visibility" value="privada" checked />Privada
			<input id= "visibility" type="radio" name="visibility" value="accesoLimitado" /> Acceso limitado
			<input id= "visibility" type="radio" name="visibility" value="publica" /> P&uacute;blica </span>
		</form>
		<div id="imagenes" style="position: absolute; left: 150px; top: 250px;">
			<img id="loading" src="loading2.gif" width="100" height="100" style="position: absolute; left: 525px;" alt="loading" />
		</div>
		<?php

		$usuario=$_SESSION['usuario'];
		$album = $_SESSION['album'];

		if (isset($_FILES['foto']) || $_FILES['foto']['error']=0) {
			$titulo = $_POST['titulo'];
			$visibilidad = $_POST['visibility'];

			if (empty($titulo)) {
				die("<span style='font-size:20px; font-weight: bold;color: red;'>Error:Por favor, introduzca todos los campos</span>");
			}

			if (strpos($titulo,'~')!==false || strpos($titulo,'"')!==false || strpos($titulo,'#')!==false || strpos($titulo,'%')!==false || strpos($titulo,'&')!==false || strpos($titulo,'*')!==false || strpos($titulo,':')!==false || strpos($titulo,'<')!==false || strpos($titulo,'>')!==false || strpos($titulo,'?')!==false || strpos($titulo,'/')!==false || strpos($titulo,'{')!==false || strpos($titulo,'|')!==false || strpos($titulo,'}')!==false || strpos($titulo,'+')!==false || strpos($titulo,'\\')!==false){
				die("<script>alert('Ha introducido un caracter no válido, elimínelo y vuelva a intentarlo')</script>");
			}

			$temp = explode(".", $_FILES["foto"]["name"]);
			$titulo = str_replace(' ', '_', $titulo);
			$newfilename = $album.'_'.$titulo.'.'.end($temp);
			$file_to_saved = "falbumes/".$newfilename;
			move_uploaded_file($_FILES['foto']['tmp_name'],$file_to_saved);

			$link = mysqli_connect("localhost","root","","album");
			$sql = "INSERT INTO imagenes(titulo, usuario, foto, idalbum, visibilidad) VALUES ('$titulo','$usuario', '".$file_to_saved."', '$album' , '$visibilidad')";
			if(!mysqli_query($link, $sql)){
				die("<span style='font-size:20px;font-weight: bold;color: red;'>Error:".mysqli_error($link)."</span>");
			}
			echo "<span style='font-size:20px;font-style: italic;position:absolute;top:220px;left:450px;'>¡Se ha añadido la imagen correctemente!</span><br/>";
			mysqli_close($link);
		}

		if (isset($_POST['etiqueta'])) {
			$newetiqueta = $_POST['etiqueta'];
			$idfoto = $_POST['idfoto'];

			if (empty($newetiqueta) ) {
				die("<span style='font-size:20px;color: red;position:absolute;top:200px;left:450px;'>Error:Por favor, introduzca todos los campos</span>");
			}

			$link = mysqli_connect("localhost","root","","album");
			$sql = "INSERT INTO etiquetas(idfoto,etiqueta) VALUES ('$idfoto','$newetiqueta')";
			if(!mysqli_query($link, $sql)){
				die("<span style='font-size:20px;font-weight: bold;color: red;'>Error:".mysqli_error($link)."</span>");
			}
			echo "<span style='font-size:20px;font-style: italic;position:absolute;top:200px;left:450px;'>¡Se ha añadido la etiqueta correctemente!</span><br/>";
			mysqli_close($link);
		}

		if (isset($_POST['visibilidad'])) {
			$newvisibilidad = $_POST['visibilidad'];
			$idfoto = $_POST['idfoto'];

			$link = mysqli_connect("localhost","root","","album");
			$sql = "UPDATE imagenes SET visibilidad='$newvisibilidad' WHERE idfoto='$idfoto'";
			if(!mysqli_query($link, $sql)){
				die("<span style='font-size:20px;font-weight: bold;color: red;'>Error:".mysqli_error($link)."</span>");
			}
			echo "<span style='font-size:20px;font-style: italic;position:absolute;top:200px;left:450px;'>¡Se ha modificado la visibilidad correctamente!</span><br/>";
			mysqli_close($link);
		}

		?>
	</body>
	</html>