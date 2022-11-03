<?php

$mysql_host = "localhost";
$mysql_usuario = "root";
$mysql_passwd = "";
$mysql_bd = "martinator";
$enlace = mysqli_connect($mysql_host, $mysql_usuario, $mysql_passwd, $mysql_bd);

/* comprobar la conexión */
if (mysqli_connect_errno()) {
    printf("Falló la conexión: %s\n", mysqli_connect_error());
    exit();
}

mysqli_set_charset($enlace,"utf8");
?>

