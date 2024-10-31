<?php
    //Control de errores
    if (isset($_POST['enviar'])){
        $error_vacio = $_POST['numero1'] == "" ||$_POST['numero2'] == "";
        $error_num = $_POST['numero1'] <1 || $_POST['numero1'] >10 || $_POST['numero2'] <1 || $_POST['numero2'] >10;
        $errores_form = $error_vacio || $error_num;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
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
        // Realizar una web con un formulario que pida dos números n y m entre 1 y 10,
        // lea el fichero tabla_n.txt con la tabla de multiplicar de ese número de la
        // carpeta Tablas, y muestre por pantalla la línea m del fichero. Si el fichero no
        // existe debe mostrar un mensaje informando de ello
    ?>
    <div class="formulario">
        <h1 class="centrado">Práctica con ficheros</h1>
        <form action="Ejer3.php" method="post">
            <p>
                <label for="numero1">Introduce un número entre el 1 y 10</label>
                <input type="number" placeholder="Introduce un número" value="<?php if(isset($_POST['numero1'])) echo $_POST['numero1']; ?>" name="numero1" id="numero1">
                <?php
                    //Mensajes de errores
                    if (isset($_POST['enviar']) && $errores_form) {
                        if ($_POST['numero1'] == "") {
                            echo "<span class='error'>* Campo Vacío *</span>";
                        } else if ($_POST['numero1'] <1 || $_POST['numero1'] >10) {
                            echo "<span class='error'>* Número no válido *</span>";
                        }
                    }
                ?>
            </p>

            <p>
                <label for="numero2">Introduce un número entre el 1 y 10</label>
                <input type="number" placeholder="Introduce un número" value="<?php if(isset($_POST['numero2'])) echo $_POST['numero2']; ?>" name="numero2" id="numero2">
                <?php
                    //Mensajes de errores
                    if (isset($_POST['enviar']) && $errores_form) {
                        if ($_POST['numero2'] == "") {
                            echo "<span class='error'>* Campo Vacío *</span>";
                        } else if ($_POST['numero2'] <1 || $_POST['numero2'] >10) {
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
                $num_pedido1 = $_POST['numero1'];
                $num_pedido2 = $_POST['numero2'];
                $nombre_carpeta = "Tablas";
                $nombre_fichero = $nombre_carpeta."/tabla_".$num_pedido1.".txt";
                $nom_sin_direcc = "tabla_".$num_pedido1.".txt";

                @$archivo = fopen($nombre_fichero, "r") or die ("<p class='error'>* No se ha encontrado el archivo *</p>");

                $contador = 1;
                $flag = 1;
                while($flag == 1) {
                    $flag = 0;
                    $linea = fgets($archivo);
                    if ($contador != $num_pedido2) {
                        $contador++;
                        $flag = 1;
                    } else {
                        echo "<p>La línea número ".$num_pedido2." del fichero ".$nom_sin_direcc." es: <strong>".$linea."</strong></p>";
                    }
                }

                fclose($archivo);
                echo "</div>";
            }
            
        ?>
    
</body>
</html>