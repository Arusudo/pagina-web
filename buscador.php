<?php

require 'conexion_bd.php';

$busqueda = trim($_POST['busqueda'] ?? ''); 

<?php
require 'conexion_bd.php';

$busqueda = trim($_POST['busqueda'] ?? '');
if ($busqueda === '') {
    die("No escribiste nada para buscar.");
}
$param = "%" . $busqueda . "%";

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

