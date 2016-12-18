<html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
if(!isset($_SESSION['usuario']) || (strstr($_SESSION['tipo'],'0')!=null)){
	header("Location:login.php");
}
?>
<head>
	<title>Ver albumes</title>
	<meta http-equiv="Content-Type" content="text/html;" charset="utf-8"/>
	<link rel="STYLESHEET" type="text/css" href="Estilo.css">
</head>
<body>
	<span class="titulo">&Aacute;LBUM DE FOTOS</span><br/><br/>
	<div style="margin-top: 20px;">
		<span style="font-weight: bold;font-size:20px;position: absolute; left:35%; text-align:left;">Estos son tus albumes <span style="font-style: italic;font-weight: normal;text-align: left;"><?php echo $_SESSION['usuario'];?></span></span>
		<span><a style="color: black; position:absolute; left:60%;" href="logout.php">Log out</a></span>
	</div>
	<p style="position: absolute; left: 675px; top: 100px; color: black;"><a href = 'Inicioin.php'>Inicio</a></p>
	<?php
	$usuario=$_SESSION['usuario'];
	$noalbumes = true;
	$maxcols = 6;
	$i = 0;
	$link = mysqli_connect("localhost","root","","album");
	$albumes = mysqli_query($link, "select * from albumes where usuario='$usuario'");
	echo '<table width=500px style="margin-left: 150px; margin-top: 130px;">';
	echo '<tr>';
	while($row=mysqli_fetch_array($albumes)){
		$noalbumes = false;
		if ($i == $maxcols) {
			$i = 0;
			echo "</tr><tr>";
		}
		echo '<td>';
		echo '<table>';
		echo '<tr style="text-align: center;"><td><a href="AdministrarImagenes.php?id='.$row['id'].'">'.$row['nombre'].'</a></td></tr>';
		echo '<tr><td><a href="AdministrarImagenes.php?id='.$row['id'].'"><img src= '.$row['foto'].' width="200" height="200"/></a></td></tr>';
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
	$albumes->close();
	if ($noalbumes) {
		echo '<span style="font-weight: bold;font-size:20px;">Actualmente no tienes ningún álbum<span/>';
	}
	mysqli_close($link);
	?>
</body>
</html>