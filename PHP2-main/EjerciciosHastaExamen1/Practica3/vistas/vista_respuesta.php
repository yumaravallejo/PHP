<!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Recogida de datos</title>
        </head>
        <body>
            <h1>Recogiendo los datos</h1>
            <?php
                echo "<p><strong>Nombre:</strong> ".$_POST["nombre"]."</p>";
                echo "<p><strong>Apellidos:</strong> ".$_POST["apellidos"]."</p>";
                echo "<p><strong>Contraseña:</strong> ".$_POST["clave"]."</p>";
                echo "<p><strong>Sexo:</strong> ".$_POST["sexo"]."</p>";
                if (isset($_POST["novedades"])) {
                    echo "<p><strong>Suscripción:</strong> Sí.</p>";
                } else {
                    echo "<p><strong>Suscripción:</strong> No.</p>";
                }
        
                
                
        
            ?>
        </body>
        </html>