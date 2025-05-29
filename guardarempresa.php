<?php

require 'conexion_bd.php'; //hay requiere en vez de include porque aui si no hay archio de conexion da fallo fatal y no sigue el script

//son los campos del formulario y los interrogantes siendo marcadores de posiciion es que si el campo esta vaciio se usa una cadena vacio como valor por defecto
$nombre    = trim($_POST['nemp'] ?? ''); // el trim elimina espacios delante y dtras de la palbra
$ubicacion   = trim($_POST['ubiemp'] ?? ''); 
$CIF = trim($_POST['CIF'] ?? '');
$telefono    = trim($_POST['numerotel'] ?? '');
$familia  = trim($_POST ['famprof'] ?? '');
$horario    = trim($_POST ['hora'] ?? '');
$tipo   = trim($_POST['privacidad'] ?? '');

// esta condicional hace que si estan vacios los campos no se pueda enviar el formulario
if (empty($nombre) || empty($ubicacion) || empty($CIF) || empty($telefono) || empty($familia) || empty($horario) || empty($tipo)) {
    die("Todos los campos son obligatorios.");
}

// esto es la consulta sl para que vaya a la tabla tutores empresa y sus respectivas columnas
$sql = "INSERT INTO `empresas` (CIF, nombre, ubicacion, familia_profesional, telefono, horario, privacidad)
        VALUES (?, ?, ?, ?, ?, ?, ?)"; // los interrogantes son los valores de las olumnas y son pra montar la cosnulta y eitar ataques de inyeccion sql ademas de separar logica de datos

$consultasql = $conexion->prepare($sql); // esto eniva la consulta

if (!$consultasql) {
    die("Error preparando la consulta: " . $conexion->error); // la exclamacion en la ariable de dentro del if es para que si se hizo mal se corte la conexion
}

$consultasql->bind_param("sssssss", $CIF, $nombre, $ubicacion, $familia, $telefono, $horario, $tipo);
// bind_paramsirve para decir a la consulta que valores reemplazan a los "?"

// cuando se envia el formulario correctamente ejecuta la consulta y mete los datos a la base de datos
if ($consultasql->execute()) {
    $exito=true; //marca que tod ha ido bien
    echo "1";
} else {
   echo "Error al guardar: " . $consultasql->error; //si no imprime este mensaje en pantalla
}

// la flecha sire para que el objeto acceda a un metodo en este caso a close de cerrar conexion
$consultasql->close();
$conexion->close();
if($exito) {
    // header("location: formempresa.php");
    echo "Empresa guardada crrectamente.";
    exit;
}
