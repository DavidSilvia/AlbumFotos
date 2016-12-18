<?php
session_start();
$usuario=$_SESSION['usuario'];
$album = $_SESSION['album'];
$nofoto = true;
$maxcols = 5;
$i = 0;
$link = mysqli_connect("localhost","root","","album");
$imagenes = mysqli_query($link, "select * from imagenes where usuario='$usuario' and idalbum='$album'") or die(mysqli_error($link));
echo '<table width=500px >';
echo '<tr>';
while($row=mysqli_fetch_array($imagenes)){
	$nofoto = false;
	if ($i == $maxcols) {
		$i = 0;
		echo "</tr><tr>";
	}
	echo '<td>';
	echo '<table>';
	echo '<tr style="text-align: center;"><td>'.$row['titulo'].'</td></tr>';
	echo '<tr><td><img src= '.$row['foto'].' width="200" height="200" alt="'.$row['idfoto'].'"/></td></tr>';
	echo '<tr><td>';

	if (strcmp($row['visibilidad'], "publica")==0) echo '<img src="publica.jpg" width="20" height="20" title="Visibilidad Pública"/>';
	else if (strcmp($row['visibilidad'], "accesoLimitado")==0) echo '<img src="accesoLimitado.png" width="20" height="20" title="Visibilidad para usuarios registrados"/>';
	else echo '<img src="privada.jpg" width="20" height="20" title="Visibilidad Privada"/>';

	echo '&nbsp;&nbsp;';

	$etiquetas = mysqli_query($link, "select * from etiquetas where idfoto='".$row['idfoto']."'");
	while($row2=mysqli_fetch_array($etiquetas)){
		echo $row2['etiqueta'].', ';
	}
	$etiquetas->close();

	echo '<form action="AdministrarImagenes.php" method="POST" onsubmit="mostrarImagenes()" style="margin-bottom:0px;"><input type="text" size="12" name="etiqueta" id="etiqueta" placeholder="Nueva etiqueta" required="required"/><input type="hidden" id="idfoto" name="idfoto" value="'.$row['idfoto'].'"/><input type="submit" name="subiretiqueta" id="subiretiqueta" style="width: 100px;" value="Añadir etiqueta"/></form>
	<form action="AdministrarImagenes.php" method="POST"><select name="visibilidad" style="width:70px;"><option value="publica">Pública</option><option value="accesoLimitado">Acceso Limitado</option><option value="privada">Privada</option></select><input type="hidden" id="idfoto" name="idfoto" value="'.$row['idfoto'].'"/><input type="submit" name="cambiarvisibilidad" id="cambiarvisibilidad" style="width: 130px;" value="Cambiar Visibilidad"/>
	</form>';
	echo '</td></tr>';
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
if ($nofoto) {
	echo '<span style="font-weight: bold;font-size:20px;">Actualmente no tienes fotos en este álbum<span/>';
}
mysqli_close($link);
?>