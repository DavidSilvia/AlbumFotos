<html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
if(!isset($_SESSION['usuario']) || (strstr($_SESSION['tipo'],'0')!=null)){
	header("Location:login.php");
}
?>
<head>
	<title>A&ntilde;adir album</title>
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
			return true;
		}
		//]]>
	</script>
</head>
<body>
	<span class="titulo">&Aacute;LBUM DE FOTOS</span><br/><br/>
	<div style="margin-top: 20px;">
		<span style="font-weight: bold;font-size:20px;position: absolute; left:35%; text-align:left;">A&ntilde;ade tu album <span style="font-style: italic;font-weight: normal;text-align: left;"><?php echo $_SESSION['usuario'];?></span></span>
		<span><a style="color: black; position:absolute; left:60%;" href="logout.php">Log out</a></span>
	</div>
	<p style="position: absolute; left: 675px; top: 100px; color: black;"><a href = 'Inicioin.php'>Inicio</a></p>
	<div style="position: absolute;left: 550px; top: 200px">
		<form action="AnadirAlbum.php" method="POST" enctype= "multipart/form-data" onsubmit="return validar()">
			<p>Nombre del album: <input type="text" id="nombrealbum" name="nombrealbum" required/></p>
			<br/>
			<p style="position: absolute;width: 500px; left: -100px;">Seleccione foto de portada: <input type="file" id="imagen" name="imagen" required/></p>
			<p style="position: absolute; left: 80px;top: 180px;"><input type="submit" name="aceptar" value="Crear album" class="boton" /></p>
		</form>
	</div>
	<?php
	if(isset($_FILES['imagen']) || $_FILES['imagen']['error']=0){

		$link = mysqli_connect("localhost","root","","album");

		$nom = $_POST['nombrealbum'];
		if(empty($nom)){
			die("Error: Introduce un nombre");
		}

		if (strpos($nom,'~')!==false || strpos($nom,'"')!==false || strpos($nom,'#')!==false || strpos($nom,'%')!==false || strpos($nom,'&')!==false || strpos($nom,'*')!==false || strpos($nom,':')!==false || strpos($nom,'<')!==false || strpos($nom,'>')!==false || strpos($nom,'?')!==false || strpos($nom,'/')!==false || strpos($nom,'{')!==false || strpos($nom,'|')!==false || strpos($nom,'}')!==false || strpos($nom,'+')!==false || strpos($nom,'\\')!==false){
			die("<script>alert('Ha introducido un caracter no válido, elimínelo y vuelva a intentarlo')</script>");
		}

		$temp = explode(".", $_FILES["imagen"]["name"]);
		$newfilename = $nom.'.'.end($temp);
		$file_to_saved = "falbumes/".$newfilename;
		move_uploaded_file($_FILES['imagen']['tmp_name'],$file_to_saved);

		$sql = "INSERT INTO albumes(nombre, usuario, foto) VALUES ('$nom', '".$_SESSION['usuario']."', '".$file_to_saved."')";
		if(!mysqli_query($link, $sql)){
			die("Error:".mysqli_error($link));
		}
		echo "<p style='position: absolute; left: 550px; top: 500px;'>Se ha a&ntilde;adido el album correctamente</p>";
		mysqli_close($link);
	}
	?>
</body>
</html> 