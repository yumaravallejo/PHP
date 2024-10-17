<?php
    //Control de errores
    if (isset($_POST['enviar'])){
        $error_vacio = $_POST['numero'] == "";
        $error_num = $_POST['numero'] <1 || $_POST['numero'] >10;
        $errores_form = $error_vacio || $error_num;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
    <style>
    .formulario {
        background-color: lightblue;
        padding: 10px;
        border: 1px solid black;
    }
    
    .respuestas {
        background-color: lightgreen;
        padding: 10px;
        border: 1px solid black;
        margin-top: 10px;
    }

    .centrado {text-align:center;}
    .error {color:red;}

    </style>
</head>
<body>
    <?php
        // Realizar una web con un formulario que pida un número entero entre 1 y 10,
        // lea el fichero tabla_n.txt con la tabla de multiplicar de ese número de la
        // carpeta Tablas, done n es el número introducido, y la muestre por pantalla.
        // Si el fichero no existe debe mostrar un mensaje informando de ello.

    ?>
    <div class="formulario">
        <h1 class="centrado">Práctica con ficheros</h1>
        <form action="Ejer2.php" method="post">
            <p>
                <label for="numero">Introduce un número entre el 1 y 10</label>
                <input type="number" placeholder="Introduce un número" value="" name="numero" id="numero">
                <?php
                    //Mensajes de errores
                    if (isset($_POST['enviar']) && $errores_form) {
                        if ($error_vacio) {
                            echo "<span class='error'>* Campo Vacío *</span>";
                        } else {
                            echo "<span class='error'>* Número no válido *</span>";
                        }
                    }
                ?>
            </p>

            <button type="submit" name="enviar">Enviar</button>
        </form>

        <?php 
        echo "</div>";
            if (isset($_POST['enviar']) && !$errores_form) {
                echo "<div class='respuestas centrado'>";
                $num_pedido = $_POST['numero'];
                $nombre_carpeta = "Tablas";
                $nombre_fichero = $nombre_carpeta."/tabla_".$num_pedido.".txt";

                @$archivo = fopen($nombre_fichero, "r") or die ("<p class='error'>* No se ha encontrado el archivo *</p>");

                echo "<h2>Tabla del ".$num_pedido."</h2>";
                while(!feof($archivo)) {
                    $linea = fgets($archivo);
                    echo "<p>".$linea."<p>";
                }

                fclose($archivo);
                echo "</div>";
            }
            
        ?>
    
</body>
</html>