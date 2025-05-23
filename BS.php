<!DOCTYPE html> <html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./estilos.css">
        <title>BD FP Dual</title>
    </head>
    <body>
    <header>
        <h1 id="h1base">Base de datos CPIFP Bajo Aragón</h1>
    </header>
    <nav>
       <ul>
            <li><a href="formtutoresemp.php">Formulario tutores de empresa</a></li>
            <li><a href="#">Base de datos</a></li>
            <li><a href="formempresa.php">Formulario empresas</a></li>
            <li><a href="formrepresentantes.php">Formulario representantes</a></li>
        </ul>
    </nav>
    <main id="maindb">
        
        <?php
            require 'ver_tablas.php';
        ?>

    </main>
    <footer>
        <p>LOS DÖNER</p> 
    </footer>
    </body>
    </html>