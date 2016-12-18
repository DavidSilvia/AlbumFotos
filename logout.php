<?php
session_start();
unset($_SESSION['tipo']);
unset($_SESSION['usuario']);
session_destroy();
header("Location: Inicio.php");
?>