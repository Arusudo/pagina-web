<?php

require 'conexion_bd.php'; // incluye el achivo de conexion


$busqueda = trim($_POST['busqueda'] ?? ''); // recoge lo que se ha escrito en el buscador y las comillas es ue si no hay nada llosustituye por un valor blanco o cero

function mostrarTabla($conexion, $tablaNombre, $tituloVisible) { // function es una funcion reutilizable y sirve para conectarse a una tabla especifica, mostrar los datos de lat abla y que aparezca como una tabla HTML
    global $busqueda; //es una vvariable ue se puede utilizar en todo el codigo, se puede usar dentro de uan funcion o fuera

    if ($busqueda !== '') { //comrpueba si la variable busqueda no esta vacia
        $busquedaEscapada = $conexion->real_escape_string($busqueda); //evita ataques e inyeccion sql
        $sql = "SELECT * FROM $tablaNombre WHERE CONCAT_WS('', " . //la variable de tablanombre son los nombres de la tabla y concat_ws concatena los valores de las columnas
            implode(', ', obtenerCampos($conexion, $tablaNombre)) . // es una funcion que deuelve un array con los nombres de las olumnas de la tabla
            //el implode cooniert el array en una cadena de texto o string
            ") LIKE '%$busquedaEscapada%'"; //si la cadena concatenada contiene lo que has buscadoo esa fila se devuelve
    } else {
        $sql = "SELECT * FROM $tablaNombre"; // aqui no se pone el nombre de la tabla porque la function al ser reutilizable sirve para varias tablas
    }

    $resultado = $conexion->query($sql); // la preparacion de la consulta sql

    if ($resultado && $resultado->num_rows > 0) { //resultadoo verifica la consulta sql si se ha hecho sin fallos y num_rows comprueba que almenos devuelva 1 fila
        echo "<h2>$tituloVisible</h2>"; // si se cumplen las dos condiciones se rea la tabla
        echo "<table>"; // abre la tabla

        // Encabezados
        echo "<tr>"; // el tr abre una fila de tabla que va a obtener los encabezados
        while ($campo = $resultado->fetch_field()) { // es un bucle que recorre cada columna que devulve la consulta sql
            echo "<th>{$campo->name}</th>"; // etch_field hace que obtiene informaion de cada columna y se guarda en la variable campo
        }
        echo "</tr>"; // esto cierra la fila de tabla de los encabezados

        // Filas de datos, este bucle recorre las filas de la consulta sql
        while ($fila = $resultado->fetch_assoc()) { // fila es n array asociatio siendo la clave elnombre del campo como DNI y el valor el contenido por ejemplo 12567891A
            echo "<tr>"; // emieza una nuea fila de la tabla para los datos y no encabezados
            foreach ($fila as $valor) { // recoorre cada valor individual de la fila actual
                echo "<td>" . htmlspecialchars($valor) . "</td>"; //muestra el valor d eelda dentro de td
            } // htmlspecialchars evita inyecciones html por ejemplo si alguien pone en el formulario <script>
            echo "</tr>"; //cierrra una parte de la tabla
        }

        echo "</table><br>"; //cierra la tabla y añade un salto de linea
    } else {
        echo "<p>No hay datos en la tabla <strong>$tituloVisible</strong>.</p>"; // se muestra ucando la tabla no tiene datos
    }
}

// Esta función extrae el nombre de todos los campos (columnas) de una tabla
function obtenerCampos($conexion, $tablaNombre) {
    $resultado = $conexion->query("DESCRIBE $tablaNombre");
    $campos = [];
    while ($fila = $resultado->fetch_assoc()) {
        $campos[] = $fila['Field'];
    }
    return $campos;
}

// Mostramos tres tablas distintas
mostrarTabla($conexion, 'empresas', 'Empresas'); // esto muestra la tabla empresas y el segundo nombre es el titulo de la tabla visible
mostrarTabla($conexion, 'representantes', 'Representantes'); // lo mismo con esta linea 
mostrarTabla($conexion, 'tutor_empresa', 'Tutores de Empresa'); // lo mismo con esta otra

$conexion->close();
?>
