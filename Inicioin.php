<html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
if(!isset($_SESSION['usuario'])){
	header("Location:login.php");
}
?>
<head>
	<title>Bienvenido</title>
	<meta http-equiv="Content-Type" content="text/html;" charset="utf-8"/>
	<link rel="STYLESHEET" type="text/css" href="Estilo.css">
</head>
<body>
	<span class="titulo">&Aacute;LBUM DE FOTOS</span><br/><br/>
	<div style="margin-top: 20px;">
		<span style="font-weight: bold;font-size:20px;position: absolute; left:35%; text-align:left;">Bienvenido <span style="font-style: italic;font-weight: normal;text-align: left;"><?php echo $_SESSION['usuario'];?></span></span>
		
		<span><a style="color: black; position:absolute; left:60%;" href="logout.php">Log out</a></span>
	</div>
	<div style="position: absolute;left: 575px; top: 200px">
		<?php
		$tipo = $_SESSION['tipo'];
		//Tipo Admin
		if(strstr($tipo, '0')!=null){
			echo "<span style='font-size: 20px;'><a href='AceptarSolicitudes.php' id='as'>Aceptar solicitudes</a></span><br/><br/>";
			echo "<span style='font-size: 20px;'><a href='BorrarAlbum.php' id='ba'>Borrar albumes</a></span><br/><br/>";
			echo "<span style='font-size: 20px;'><a href='BorrarImagenes.php' id='bf'>Borrar fotos</a></span><br/><br/>";
			echo "<span style='font-size: 20px;'><a href='DarBaja.php' id='db'>Dar de baja usuario</a></span><br/><br/>";
		//Tipo Usuario
		}else if(strstr($tipo, '1')!=null){
			echo "<span style='font-size: 20px;'><a href='AnadirAlbum.php' id='aa'>A&ntilde;adir album</a></span><br/><br/>";
			echo "<span style='font-size: 20px;'><a href='VerAlbumes.php' id='va'>Ver Mis Albumes</a></span><br/><br/>";
			echo "<span style='font-size: 20px;'><a href='VerFotos.php' id='vf'>Ver Fotos P&uacute;blicas</a></span><br/><br/>";
			echo "<span style='font-size: 20px;'><a href='BuscarPorEtiqueta.php' id='be'>Buscar por etiqueta</a></span><br/><br/>";
		}
		?>
	</div>
</body>
</html> 