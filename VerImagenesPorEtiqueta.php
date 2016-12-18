<?php
$etiqueta = $_GET['etiqueta'];
$encontrado = false;
$maxcols = 5;
$i = 0;
$link = mysqli_connect("localhost","root","","album");
$etiquetas = mysqli_query($link, "select idfoto from etiquetas where etiqueta='$etiqueta'") or die(mysqli_error($link));
echo '<table width=500px >';
echo '<tr>';
echo '<script>alert("hola")</script>';
while($row=mysqli_fetch_array($etiquetas)){
	$encontrado = true;
	$imagen = mysqli_query($link, "select * from imagenes where idfoto='".$row['idfoto']."'") or die(mysqli_error($link));
	$row2=mysqli_fetch_array($imagen);
	if ($i == $maxcols) {
		$i = 0;
		echo "</tr><tr>";
	}
	echo '<td>';
	echo '<table>';
	echo '<tr style="text-align: center;"><td>Usuario: '.$row2['usuario'].'</td></tr>';
	echo '<tr style="text-align: center;"><td>Titulo: '.$row2['titulo'].'</td></tr>';
	echo '<tr><td><img src= '.$row2['foto'].' width="200" height="200" alt="'.$row2['idfoto'].'"/></td></tr>';
	echo '</table>';
	echo '</td>';
	$i++;
	$imagen->close();
}
while ($i <= $maxcols) {
	echo "<td>&nbsp;</td>";
	$i++;
}
echo '</tr>';
echo '</table>';
$etiquetas->close();
if (!$encontrado) {
	echo '<span style="font-weight: bold;font-size:20px;">No se encontró ninguna foto con esa etiqueta<span/>';
}
mysqli_close($link);
?>