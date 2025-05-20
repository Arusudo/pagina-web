<?php
// Datos de conexión
$host = "192.168.12.183";
$usuario = "root";
$contraseña = "PHP@Mypass1"
$base = "fp_dual";

$conn = new mysqli ($host, $usuario, $contraseña, $base);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

//Captura de datos
$nombre = $_POST
?>