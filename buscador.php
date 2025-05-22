<?php

require 'conexion_bd.php';

$busqueda = trim($_POST['busqueda'] ?? ''); // recoge el valor enviado por post y si no hay utiliza na cadena vacia que de eso se encargan las ocmillas

if ($busqueda === '') { // si el usuario no escribe nada se detiene la ejecucion del codigo y muesta un mensajae
    die("No escribiste nada para buscar.");
}

$param = "%" . $busqueda . "%"; // se prepara el valor dela busqueda con comodines "%" para usarlo con la funcion LIKE

// Función para buscar en una tabla con campos específicos
function buscarEnTabla($conexion, $tabla, $campos, $tipo) {
    global $param;
    $camposLike = implode(" LIKE ? OR ", $campos) . " LIKE ?";
    $sql = "SELECT '$tipo' AS tipo, nombre, {$campos[0]} AS identificador FROM $tabla WHERE $camposLike";
    $stmt = $conexion->prepare($sql);

    $bindTypes = str_repeat('s', count($campos));
    $params = array_fill(0, count($campos), $param);

    $stmt->bind_param($bindTypes, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();

    $datos = [];
    while ($fila = $result->fetch_assoc()) {
        $datos[] = $fila;
    }
    $stmt->close();
    return $datos;
}

// Busquedas simplificadas
$resultados = array_merge(
    buscarEnTabla($conexion, 'empresas', ['nombre', 'CIF'], 'Empresa'),
    buscarEnTabla($conexion, 'representantes', ['nombre', 'DNI'], 'Representante'),
    buscarEnTabla($conexion, 'tutoresempresa', ['nombre', 'DNI'], 'Tutor Empresa')
);

$conexion->close();

