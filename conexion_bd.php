<?php
// new mysqli es la conexion al servidr y base de datos ademas de indicar el usuario y la contraseña
$conexion=new mysqli("127.0.0.1", "root","","fp_dual");

// indica que tipo de caracteres se utilizan
$conexion->set_charset("utf8");

// hace que si hay un fallo de conexion la "mate" y termine la conexion
if ($conexion->connect_error) { //es una condicional que dice que si hay un fallo de conexion haga lo de abajo
    die ("conexion fallida".$conexion->connect_error); // die como bien dice su nombre es muere, y hace que si se cumple la condicional mate la conexion
}
?>