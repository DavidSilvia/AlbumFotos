<html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
if(!isset($_SESSION['usuario']) || (strstr($_SESSION['tipo'],'1')!=null)){
	header("Location:login.php");
}
?>
<head>
	<title>Borrar imagenes</title>
	<meta http-equiv="Content-Type" content="text/html;" charset="utf-8"/>
	<link rel="STYLESHEET" type="text/css" href="Estilo.css">
</head>
<body>
	<span class="titulo">&Aacute;LBUM DE FOTOS</span><br/><br/>
	<div style="margin-top: 20px;">
		<span style="font-weight: bold;font-size:20px;position: absolute; left:35%; text-align:left;">Estas son todas las imágenes <span style="font-style: italic;font-weight: normal;text-align: left;"></span></span>
		<span><a style="color: black; position:absolute; left:60%;" href="logout.php">Log out</a></span>
	</div>
	<p style="position: absolute; left: 675px; top: 100px; color: black;"><a href = 'Inicioin.php'>Inicio</a></p>
</body>
<?php
$link = mysqli_connect("localhost","root","","album");
$imagenes = mysqli_query($link, "select * from imagenes");
$maxcols = 5;
$i = 0;
echo '<table width=500px style="margin-left: 150px; margin-top: 130px;">';
echo '<tr>';
while($row=mysqli_fetch_array($imagenes)){
	if ($i == $maxcols) {
		$i = 0;
		echo "</tr><tr>";
	}
	echo '<td>';
	echo '<table>';
	echo '<tr style="text-align: center;"><td>Usuario: '.$row['usuario'].'</td></tr>';
	echo '<tr style="text-align: center;"><td>Titulo: '.$row['titulo'].'</td></tr>';
	echo '<tr><td><img src= '.$row['foto'].' width="200" height="200"/></td></tr>';
	echo '<tr><td>';
	$etiquetas = mysqli_query($link, "select * from etiquetas where idfoto='".$row['idfoto']."'");
	while($row2=mysqli_fetch_array($etiquetas)){
		echo $row2['etiqueta'].', ';
	}
	$etiquetas->close();
	echo '</td></tr>';
	echo '<tr style="text-align: center;"><td><a href="BorrarImagenes.php?idfoto='.$row['idfoto'].'"><img src="papelera.png" width="40" height="40"/></a></td></tr>';
	echo '</table>';
	echo '</td>';
	$i++;
}
while ($i <= $maxcols) {
	echo "<td>&nbsp;</td>";
	$i++;
}
echo '</tr>';
echo '</table>';
$imagenes->close();
mysqli_close($link);

if(isset($_GET['idfoto'])){

	$idfoto=$_GET['idfoto'];
	$link = mysqli_connect("localhost","root","","album");
	$sql1 = "delete from etiquetas where idfoto='$idfoto'";
	if(mysqli_query($link, $sql1)){
		$sql = "delete from imagenes where idfoto='$idfoto'";
		if(!mysqli_query($link, $sql)){
			die("<script type='text/javascript'>
				alert('No se ha podido eliminar la imagen');
				window.location.replace(\"BorrarImagenes.php\");
			</script>");
		}
		echo "<script type='text/javascript'>
		alert('Se ha eliminado la imagen correctamente');
		window.location.replace(\"BorrarImagenes.php\");</script>";
	}
	else{
		die("<script type='text/javascript'>
			alert('No se ha podido eliminar la imagen');
			window.location.replace(\"BorrarImagenes.php\");
		</script>");
	}

	mysqli_close($link);

}
?>
</html>