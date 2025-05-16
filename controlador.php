<?php
include("conexion.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST["uname"]) || empty($_POST["psw"])) {
        echo '<div>LOS CAMPOS ESTAN VACIOS</div>';
    } else {
        $usuario = $_POST["uname"];
        $clave = $_POST["psw"];

        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE user = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $usuarioData = $resultado->fetch_assoc();

            if (password_verify($clave, $usuarioData['password'])) {
                $_SESSION['usuario'] = $usuarioData['user'];
                header("Location: index.html");
                exit;
            } else {
                echo '<div>ACCESO DENEGADO</div>';
            }
        } else {
            echo '<div>USUARIO NO ENCONTRADO</div>';
        }
    }
}
?>
