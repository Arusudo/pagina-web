<?php

require 'conexion_bd.php'; //hay requiere en vez de include porque aui si no hay archio de conexion da fallo fatal y no sigue el script

//son los campos del formulario y los interrogantes siendo marcadores de posiciion es que si el campo esta vaciio se usa una cadena vacio como valor por defecto
$DNI    = trim($_POST['dni'] ?? ''); 
$nombre   = trim($_POST['ubiemp'] ?? ''); 
$CIF = trim($_POST['CIF'] ?? '');
$email    = trim($_POST['numerotel'] ?? '');

// esta condicional hace que si estan vacios los campos no se pueda enviar el formulario
if (empty($DNI) || empty($nombre) || empty($CIF) || empty($email)) {
    die("Todos los campos son obligatorios.");
}
// esta condicional hace que verifique el email y no sea palabras aleatorios con un @
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("El correo electrónico no es válido.");
}

// esto es la consulta sl para que vaya a la tabla tutores empresa y sus respectivas columnas
$sql = "INSERT INTO `representantes` (DNI, nombre, empresa, email)
        VALUES (?, ?, ?, ?)"; // los interrogantes son los valores de las olumnas y son pra montar la cosnulta y eitar ataques de inyeccion sql ademas de separar logica de datos

$consultasql = $conexion->prepare($sql); // esto enia la consulta

if (!$consultasql) {
    die("Error preparando la consulta: " . $conexion->error); // la exclamacion en la ariable de dentro del if es para que si se hizo mal se corte la conexion
}

$consultasql->bind_param("ssss", $DNI, $nombre, $CIF, $email); // bind_paramsirve para decir a la consulta que valores reemplazan a los "?"

// cuando se envia el formulario correctamente ejecuta la consulta y mete los datos a la base de datos
if ($consultasql->execute()) {
   $exito=true; //marca que todo ha ido bien
  
} else {
    echo "Error al guardar: " . $consultasql->error; //si no imprime este mensaje en pantalla
}

// la flecha sire para que el objeto acceda a un metodo en este caso a close de cerrar conexion
$consultasql->close();
$conexion->close();

if($exito) {
    header("Location: formrepresentantes.php");  
    echo "Representante guardado correctamente.";
    exit;
}

