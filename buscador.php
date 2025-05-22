<?php

require 'conexion_bd.php';

$busqueda = trim($_POST['busqueda'] ?? '');

if ($busqueda === '') {
    die("No escribiste nada para buscar.");
}

$busqueda_param = "%" . $busqueda . "%";

// Ejecutamos múltiples consultas
$resultados = [];

// Buscar en empresas
$sql_emp = "SELECT 'Empresa' AS tipo, nombre, CIF AS identificador FROM empresas WHERE nombre LIKE ? OR CIF LIKE ?";
$stmt_emp = $conexion->prepare($sql_emp);
$stmt_emp->bind_param("ss", $busqueda_param, $busqueda_param);
$stmt_emp->execute();
$result_emp = $stmt_emp->get_result();

while ($fila = $result_emp->fetch_assoc()) {
    $resultados[] = $fila;
}
$stmt_emp->close();

// Buscar en representantes
$sql_rep = "SELECT 'Representante' AS tipo, nombre, DNI AS identificador FROM representantes WHERE nombre LIKE ? OR DNI LIKE ?";
$stmt_rep = $conexion->prepare($sql_rep);
$stmt_rep->bind_param("ss", $busqueda_param, $busqueda_param);
$stmt_rep->execute();
$result_rep = $stmt_rep->get_result();

while ($fila = $result_rep->fetch_assoc()) {
    $resultados[] = $fila;
}
$stmt_rep->close();

// Buscar en tutores de empresa (opcional)
$sql_tut = "SELECT 'Tutor Empresa' AS tipo, nombre, DNI AS identificador FROM tutoresempresa WHERE nombre LIKE ? OR DNI LIKE ?";
$stmt_tut = $conexion->prepare($sql_tut);
$stmt_tut->bind_param("ss", $busqueda_param, $busqueda_param);
$stmt_tut->execute();
$result_tut = $stmt_tut->get_result();

while ($fila = $result_tut->fetch_assoc()) {
    $resultados[] = $fila;
}
$stmt_tut->close();

$conexion->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Resultados de búsqueda</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Resultados de la búsqueda</h1>

    <?php if (empty($resultados)): ?>
        <p>No se encontraron resultados para "<strong><?= htmlspecialchars($busqueda) ?></strong>".</p>
    <?php else: ?>
        <table border="1">
            <tr>
                <th>Tipo</th>
                <th>Nombre</th>
                <th>Identificador</th>
            </tr>
            <?php foreach ($resultados as $fila): ?>
                <tr>
                    <td><?= htmlspecialchars($fila['tipo']) ?></td>
                    <td><?= htmlspecialchars($fila['nombre']) ?></td>
                    <td><?= htmlspecialchars($fila['identificador']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <a href="index.php">Volver</a>
</body>
</html>
