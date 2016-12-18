<html>
<head>
	<link rel="STYLESHEET" type="text/css" href="Estilo.css">
	<meta charset="utf-8">
</head>
<?php
$link = mysqli_connect("localhost","root","","album");
$usuarios = mysqli_query($link, "select * from usuario where Confirmado = '0'");
echo '<table border=1 align="center" width="600"> <tr><th>Nombre</th><th>Apellidos</th><th>Usuario</th><th>Correo</th><th>Password</th><th>Fecha Nacimiento</th><th>Sexo</th></tr>';
while($row=mysqli_fetch_array($usuarios)){
	echo '<tr><td>'.$row['Nombre'].'</td><td>'.$row['Apellidos'].'</td><td>'.$row['Usuario'].'</td><td>'.$row['Correo'].'</td><td>'.$row['Password'].'</td><td>'.$row['FechaNac'].'</td><td>'.$row['Sexo'].'</td></tr>';
}
echo '</table>';
$usuarios->close();
mysqli_close($link);
?>
</html>