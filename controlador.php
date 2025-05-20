<?php

include("conexion_bd.php"); //es para que incluya el archio de conexion a la BS y servidor

session_start(); // es obligatorio sirve para iniciar la sesion y que funcione el codigo de abajo

if ($_SERVER['REQUEST_METHOD'] == 'POST') { //es una condicional, es para ue se espea una peticion POST y no otro tipo
    if (empty($_POST["uname"]) || empty($_POST["psw"])) { //sire para que no haga nada si los campos estan acios
        echo '<div>LOS CAMPOS ESTAN VACIOS</div>'; //para que muestre el mensje si los campos estan vacios
    } else { //parte de la condicional que lo hara si no se cumple lo de arriba
        $usuario = $_POST["uname"]; //es la variable para que guarde el usuario del formulario
        $clave = $_POST["psw"]; // es la ariable para que guarde la contraseña del formulario
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE user = ?"); // conexion-> prepare sirve para idnicar que quieroo hacer una consulta
        // select * from usuarios wehere user es pra ue de la tabla usuarios busque en la columna user el usuario
        // el simbolo ? es un marcador de posicion y sirve para eitar inyecciones sql e indic que as a vincular el valor luego con bind_param
        $stmt->bind_param("s", $usuario); //vincula variables php a los marcadores de posiciion de la consulta sql
        $stmt->execute(); // indica que ejecute la coonsulta preparada antes
        $resultado = $stmt->get_result(); // recoge el resultado de la consulta

        if ($resultado->num_rows === 1) { // comprueba si la consulta a devuelto exactamente una fila, si coincide una columna pero la otra no devuelve 0 y no cepta la sesiion
            $usuarioData = $resultado->fetch_assoc(); // extrae la fila de resultados de la base de datos

            if ($clave === $usuarioData['password']) { //comprueba que la conraseña es correcta
                $_SESSION['usuario'] = $usuarioData['user']; //comprueba que el usuario es correcta
                header("Location: index.html"); //una vez aceptada la sesion te redirige a la pgina de index
                exit; //detiene la ejecucion de todo el codigo 
            } else { // es parte de la condicional, si no se cumple el if de arriba pasa a esta parte
                echo "<div>ACCESO DENEGADO: Contraseña incorrecta</div>"; //muestra el mensaje de dentro del di
            }
        } else { //muestra este mensaje si la segunda parte de la ondicional de usuariodata no es correcto
            echo "<div>USUARIO NO ENCONTRADO</div>"; //muestra el mensaje dentro del di
        }
    }
}
?>
