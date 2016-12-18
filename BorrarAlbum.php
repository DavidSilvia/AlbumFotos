<html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
if(!isset($_SESSION['usuario']) || (strstr($_SESSION['tipo'],'1')!=null)){
	header("Location:login.php");
}
?>
<head>
	<title>Borrar albumes</title>
	<meta http-equiv="Content-Type" content="text/html;" charset="utf-8"/>
	<link rel="STYLESHEET" type="text/css" href="Estilo.css">
</head>
<body>
	<span class="titulo">&Aacute;LBUM DE FOTOS</span><br/><br/>
	<div style="margin-top: 20px;">
		<span style="font-weight: bold;font-size:20px;position: absolute; left:35%; text-align:left;">Estos son todos los albumes <span style="font-style: italic;font-weight: normal;text-align: left;"></span></span>
		<span><a style="color: black; position:absolute; left:60%;" href="logout.php">Log out</a></span>
	</div>
	<p style="position: absolute; left: 675px; top: 100px; color: black;"><a href = 'Inicioin.php'>Inicio</a></p>
</body>
<?php
$link = mysqli_connect("localhost","root","","album");
$albumes = mysqli_query($link, "select * from albumes");
echo '<table width=500px style="margin-left: 150px; margin-top: 130px;">';
echo '<tr>';
while($row=mysqli_fetch_array($albumes)){
	echo '<td>';
	echo '<table>';
	echo '<tr style="text-align: center;"><td>'.$row['nombre'].'</td></tr>';
	echo '<tr><td><img src= '.$row['foto'].' width="200" height="200"/></td></tr>';
	echo '<tr style="text-align: center;"><td><a href="BorrarAlbum.php?id='.$row['id'].'"><img src="papelera.png" width="40" height="40"/></a></td></tr>';
	echo '</table>';
	echo '</td>';
}
echo '</tr>';
echo '</table>';
$albumes->close();
mysqli_close($link);

if(isset($_GET['id'])){

	$id=$_GET['id'];
	$link = mysqli_connect("localhost","root","","album");
	$sql = "delete from albumes where id='$id'";
	if(!mysqli_query($link, $sql)){
		die("<script type='text/javascript'>
			alert('No se ha podido eliminar el álbum');
			window.location.replace(\"BorrarAlbum.php\");
		</script>");
	}
	$imagenes = mysqli_query($link, "select * from imagenes where idalbum='$id'");
	while($row2=mysqli_fetch_array($imagenes)){
		$idfoto = $row2['idfoto'];
		$sql1 = "delete from etiquetas where idfoto='$idfoto'";
		if(mysqli_query($link, $sql1)){
			$sql2 = "delete from imagenes where idfoto='$idfoto'";
			if(!mysqli_query($link, $sql2)){
				die("<script type='text/javascript'>
					alert('No se ha podido eliminar el álbum');
					window.location.replace(\"BorrarAlbum.php\");
				</script>");
			}
		}
		else{
			die("<script type='text/javascript'>
				alert('No se ha podido eliminar el álbum');
				window.location.replace(\"BorrarAlbum.php\");
			</script>");
		}
	}
	$imagenes->close();
	echo "<script type='text/javascript'>
	alert('Se ha eliminado el álbum correctamente');
	window.location.replace(\"BorrarAlbum.php\");</script>";
	mysqli_close($link);
}
?>
</html>