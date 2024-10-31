<?php
    function es_texto($text) {
        $texto_separado = explode(".", $text);
        if(count($texto_separado)>1) {
            if (end($texto_separado) == "txt") {
                $respuesta = $texto_separado;
            } else {
                $respuesta = false;
            }   
        } else {
            $respuesta = false;
        }
        return $respuesta;
    }

    if (isset($_POST['enviar'])) {
        
        //Que no esté vacío
        //Que sea .txt
        //tamaño máximo 2.5mb               
        $errores_form = $_FILES['fichero']['error'] || $_FILES['fichero']['type']!="text/plain" ||
        $_FILES['fichero']['size'] > 2.5*1024*1024;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
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
        // Realizar una web con un formulario que seleccione un fichero de texto y muestre por pantalla el número 
        // de palabras que contiene. Como ejemplo usar el
        // archivo adjunto (pag2000.txt). Controlar que el fichero seleccionado por el
        // usuario sea de tipo texto ( .txt) y que el tamaño máximo del archivo sea 2’5MB.
    ?>
    <div class="formulario">
        <h1 class="centrado">Práctica con ficheros</h1>
        <form action="Ejer4.php" method="post" enctype="multipart/form-data">
            <p>
                <label for="fichero">Introduce el nombre del fichero de texto (máx: 2.5mb)</label>
                <input type="file" name="fichero" id="fichero">
                <?php
                    if (isset($_POST['enviar']) && $errores_form) {
                        if ($_FILES['fichero']['name']=="") {
                            echo "<span class='error'>* Campo Vacío *</span>";
                        } else if (!es_texto($_FILES['fichero']['name'])) {
                            echo "<span class='error'>* No has seleccionado un fichero de texto *</span>";
                        } else {
                            echo "<span class='error'>* El tamaño es mayor de 2.5mb *</span>";
                        }
                    }
                ?>
            </p>
        
            <button type="submit" name="enviar">Contar líneas</button>
        </form>
    </div>
    
    <?php 
        if (isset($_POST['enviar']) && !$errores_form) {
            echo "<div class='respuestas'>";

            echo "<h2>Manera corta</h2>";

            $contenido_fichero = file_get_contents($_FILES['fichero']['tmp_name']);
            $word = str_word_count($contenido_fichero);
            echo "<p>El fichero tiene ".$word." palabras</p>";

            echo "<h2>Manera larga</h2>";
            $nombre_archivo = $_FILES['fichero']['name'];
            
            //Esta forma, tiene como pega que si no se tiene permisos no funcionará
            @$archivo = fopen($nombre_archivo, "r") or die ("<p class='error'>* El fichero no existe *</p>");

            $contador = 0;
            while(!feof($archivo)) {
                $linea = fgets($archivo);
                $contador += str_word_count($linea);
            }
            
            if ($contador == 0) {
                echo "<p>El fichero no tiene palabras</p>";
            } else if ($contador == 1) {
                echo "<p>El fichero tiene ".$contador." palabra</p>";
            } else {
                echo "<p>El fichero tiene ".$contador." palabras</p>";
            }

            fclose($archivo);
            echo "</div>";
        }
    ?>
</body>
</html>