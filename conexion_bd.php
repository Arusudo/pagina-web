<?php

$conexion=new mysqli("192.168.12.183", "root","PHP@Mypass1","803306");
$conexion->set_charset("utf8"); 
if ($conexion->connect_error) {
    die ("conexion fallida".$conexion->connect_error);
}
?>