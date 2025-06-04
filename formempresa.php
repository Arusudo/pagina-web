<!DOCTYPE html> <html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="estilos.css">
        <title>BD FP Dual</title>
    </head>
    <body>
    <header>
        <h1 id="h1mod">CPIFP Bajo Aragón</h1>
    </header>
    <nav>
         <ul>
            <li><a href="formtutoresemp.php">Formulario tutores de empresa</a></li>
            <li><a href="BS.php">Base de datos</a></li>
            <li><a href="#">Formulario empresas</a></li>
            <li><a href="formrepresentantes.php">Formulario representantes</a></li>
        </ul>
    </nav>
    <main id="mainmod">
        <section id="sectionemp">
        <form action="guardarempresa.php" method="post" id="formempresas">

            <h1 id="h1formmod">Formulario para empresas</h1>
            
            <label for="Nombreemp">Escriba el nombre de la empresa</label><br>
            <input type="text" name="nemp" id="nemp" placeholder="Escriba el nombre aquí"><br>

            <label for="ubiemp">Escriba la ubicación de la empresa</label><br>
            <input type="text" name="ubiemp" id="ubiemp" placeholder="Escriba la ubicación aquí"><br>

            <label for="CIF">Escriba el CIF de la empresa</label><br>
            <input type="text" name="CIF" id="CIF" placeholder="Escriba el CIF aquí"><br>

            <label for="number">Escriba el numero de telefono de la empresa</label><br>
            <input type="number" name="numerotel" id="numerotel" placeholder="Escriba el numero aquí"><br>

            <label for="famprof">Escriba las familias profesionales con las que trabaja la empresa</label><br>
            <input type="text" name="famprof" id="famprof" placeholder="Esccriba las familias profesionales aquí"><br>

            <label for="hora">Escriba el horario de la empresa</label><br>
            <input type="text" id="hora" name="hora" placeholder="Escriba la hora aquí"><br>

            <label for="lista">Elija una opción</label><br>
            <select name="privacidad" id="privacidad">
                <option value="">Elija una opción</option>
                <option value="Publica">Pública</option>
                <option value="Privada">Privada</option>
            </select><br>
            <button type="submit">Envíar</button>
        </form>
        </section>
    </main>
    <footer>
    </footer>
    </body>
    </html>