<!DOCTYPE html> <html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="estilos.css">
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
        <form action="buscador.php" method="post">
            
            <label for="busqueda">Busca lo que necesites aquí</label>
            <input type="text" id="busqueda" name="busqueda" placeholder="Busca aquí">

            <button type="submit">Buscar</button>
        </form>
    </main>
    <footer>
        <p>LOS DÖNER</p> 
    </footer>
    </body>
    </html>