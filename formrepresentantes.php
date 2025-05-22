<!DOCTYPE html> <html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="estilos.css">
        <title>BD FP Dual</title>
    </head>
    <body>
    <header id="h1add">
        <h1>
            CPIFP Bajo Aragón
        </h1>
    </header>
     <nav>
        <ul>
            <li><a href="formtutoresemp.php">Formulario tutores de empresa</a></li>
            <li><a href="BS.php">Base de datos</a></li>
            <li><a href="formempresa.php">Formulario empresas</a></li>
            <li><a href="#">Formulario representantes</a></li>
        </ul>
    </nav>
    <main id="mainformrep">
        <section>
            <form action="guardarepresentantes.php" method="post" id="foormrepresentantes">
            <h1 id="h1formmod">Formulario para tabla de representantes</h1>

            <label for="Nombreemp">Escriba el DNI del/la representante</label><br>
            <input type="text" name="dni" id="dni" placeholder="Escriba el DNI aquí"><br>

            <label for="ubiemp">Escriba el nombre del/la representante</label><br>
            <input type="text" name="ubiemp" id="ubiemp" placeholder="Escriba aquí el nombre"><br>

            <label for="CIF">Escriba el CIF de la empresa a la que pertenece</label><br>
            <input type="text" name="CIF" id="CIF" placeholder="Escriba el CIF aquí"><br>

            <label for="number">Escriba el correo electronico</label><br>
            <input type="text" name="numerotel" id="numerotel" placeholder="Escriba el email aquí"><br>

            <button type="submit">Envíar</button>
        </form>
        </section>
    </main>
    <footer>
        <p>LOS DÖNER</p>
    </footer>
    </body>
</html>