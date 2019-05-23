<?php

$conexion = mysqli_connect("127.0.0.1", "root", "","parcial") or die("no conecto");

mysqli_query($conexion,"SET NAMES 'utf8'");

$mensaje = $_POST ['mensaje'];

mysqli_query($conexion,"INSERT INTO `parcial`.`log` VALUES (NULL, CURRENT_TIMESTAMP, '$mensaje');");

mysqli_close();

echo "Datos ingresados correctamente.";

?>