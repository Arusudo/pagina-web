<!DOCTYPE html>
 <html id="html1">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="estilos.css">
        <title>BD FP Dual</title>
    </head>
    <body>
        <header>
            <h1 id="h1ini">CPIFP Bajo Aragón</h1>
        </header>
        <main id="mainses" class="mains">
            <div> 
                <h1 id="h1form">Inicio de sesión</h1>
            </div>
            <?php
            // esto es para que incluya los archivos php de conexion a la BS y el controlador del formulario
            include("conexion_bd.php");
            include("controlador.php");
            ?>
            <section>
            <form action="controlador.php" method="post" id="iniform"> 
                    <label for="uname">Usuario</label><br>
                    <input required type="text" placeholder="Introduce tu usuario" name="uname" id="uname" ><br>

                    <label required for="psw">Contraseña</label><br>
                    <input required type="password" placeholder="Introduce tu contraseña" name="psw" id="psw"><br>

                    <button type="submit" name="button">Acceder</button>
                </form>
            </section>
        </main>
        <footer>
          LOS DÖNER  
        </footer>
    </body>
    </html>
