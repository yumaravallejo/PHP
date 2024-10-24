<?php
    if (isset($_POST['enviar'])) {
        $error_vacio = $_FILES['fichero']['name']=="";
        $error_tipo = $_FILES['fichero']['type'] != "text/plain";
        $error_tam = $_FILES['fichero']['size'] > 1000*1024;
        $error_fich = $_FILES['fichero']['error'] != 0;
        $errores_form = $error_vacio || $error_tipo || $error_tam || $error_fich;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
    <style>
        .error{color:red;}
    </style>
</head>
<body>
    <h1>Ejercicio 2</h1>
    <form action="Ej2.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="fichero">Introduce un fichero (máx. 1MB)</label>
            <input type="file" name="fichero" id="fichero">
            <?php
                if (isset($_POST['enviar']) && $errores_form) {
                    if ($_FILES['fichero']['name']=="") {
                        echo "<span class='error'>* Campo Vacío *</span>";
                    } else if ( $_FILES['fichero']['type'] != "text/plain") {
                        echo "<span class='error'>* Debes seleccionar un fichero de texto *</span>";
                    } else if ($_FILES['fichero']['size'] > 1000*1024) {
                        echo "<span class='error'>* El tamaño del fichero debe ser menor de 1MB *</span>";
                    } else if ( $_FILES['fichero']['error'] != 0) {
                        echo "<span class='error'>* Hay un error en el fichero *</span>";
                    } else {
                        echo "<span class='error'>* No se ha podido subir el archivo *</span>";
                    }
                }
            ?>
        </p>
        <p>
            <button type="submit" name="enviar">Mover</button>
        </p>
    </form>

    <?php
        if (isset($_POST['enviar']) && !$errores_form){
            $nombre_fichero = "archivo.txt";
            $fichero = $_FILES['fichero'];

            @$archivo=move_uploaded_file($_FILES["fichero"]["tmp_name"],"Ficheros/archivo.txt");
            if ($archivo) {
                echo "<p>Archivo subido con éxito</p>";
            } else{
                echo "<p>No ha podido subirse el fichero</p>";

            }

        }
    ?>
</body>
</html>