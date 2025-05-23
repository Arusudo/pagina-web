<?php

require 'conexion_bd.php'; // incluye el achivo de conexion

function mostrarTabla($conexion, $tablaNombre, $tituloVisible) { // function es una funcion reutilizable y sirve para conectarse a una tabla especifica, mostrar los datos de lat abla y que aparezca como una tabla HTML
    
    $sql = "SELECT * FROM $tablaNombre"; // aqui no se pone el nombre de la tabla porque la function al ser reutilizable isrve para varias tablas
    $resultado = $conexion->query($sql); // la preparacion de la consulta sl

    if ($resultado && $resultado->num_rows > 0) { //resultadoo verifica la consulta sql si se ha hecho sin fallos y num_rows comprueba que almenos devuelva 1 fila
        echo "<h2>$tituloVisible</h2>"; // si se cumplen las dos condiciones se rea la tabla
         echo "<table border='1' cellpadding='5' cellspacing='0'>"; // añade los estilos css a la tabla y cellspaing sirve para quitar espacios entre celdas
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

// Mostramos tres tablas distintas
mostrarTabla($conexion, 'empresas', 'Empresas'); // esto muestra la tabla empresas y el segundo nombre es el titulo de la tabla visible
mostrarTabla($conexion, 'representantes', 'Representantes'); // lo mismo con esta linea 
mostrarTabla($conexion, 'tutor_empresa', 'Tutores de Empresa'); // lo mismo con esta otra

$conexion->close();