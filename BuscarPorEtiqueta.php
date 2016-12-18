<html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
if(!isset($_SESSION['usuario']) || (strstr($_SESSION['tipo'],'0')!=null)){
	header("Location:login.php");
}
?>
<head>
	<title>Buscar etiqueta</title>
	<meta http-equiv="Content-Type" content="text/html;" charset="utf-8"/>
	<link rel="STYLESHEET" type="text/css" href="Estilo.css">
	<script type="text/javascript">
		//<![CDATA[

		function mostrarImagenes(){
			if(window.XMLHttpRequest){
				xmlhttp = new XMLHttpRequest();
			}else{
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			var etiqueta = document.getElementById('etiqueta').value;
			xmlhttp.open("GET", "VerImagenesPorEtiqueta.php?etiqueta="+etiqueta, true);
			xmlhttp.onreadystatechange=function(){
				if(xmlhttp.readyState==4 && xmlhttp.status==200){
					document.getElementById('imagenes').innerHTML=xmlhttp.responseText;
				}
			}
			xmlhttp.send();
		}

		function validar(){
			var etiqueta = document.getElementById('etiqueta').value;
			if (etiqueta.length==0) {
				document.getElementById('imagenes').innerHTML="<span style='color:darkred;font-weight: bold;'>Por favor, introduce una etiqueta</span>";
			}
			else{
				mostrarImagenes();
			}
		}
		//]]>
	</script>
</head>
<body>
	<span class="titulo">&Aacute;LBUM DE FOTOS</span><br/><br/>
	<div style="margin-top: 20px;">
		<span style="font-weight: bold;font-size:20px;position: absolute; left:35%;">Busca imágenes por una etiqueta determinada</span>
		<span><a style="color: black; position:absolute; left:80%;" href="logout.php">Log out</a></span>
	</div>
	<p style="position: absolute; left: 49%; top: 100px; color: black;"><a href = 'Inicioin.php'>Inicio</a></p>
	<form >
		<span style="position: absolute;left: 40%;top: 150px;">Etiqueta: <input type="text" name="etiqueta" id="etiqueta"/>&nbsp;&nbsp;<input type="button" id="buscar" value="Buscar" onclick="validar()" /></span>
	</form>
	<div id="imagenes" style="position: absolute;left: 10%;top: 200px;">
	</div>
</body>
</html>