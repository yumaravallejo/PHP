<?php
    if (isset($_POST["btnSubir"])) {
        $error_form = $_FILES["fichero"]["name"] == "" || 
        $_FILES["fichero"]["error"] ||
        $_FILES["fichero"]["type"] != 'text/plain' ||
        $_FILES["fichero"]["size"] > 1000*1024;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
    <style>
        .error {color: red;}
    </style>
</head>
<body>
    <h1>Ejercicio 2</h1>
    <form action="ejercicio2.php" method="post" enctype="multipart/form-data">
    <p>
        <label for="fichero">Seleccione un archivo (Máx. 1MB)</label>
        <input type="file" name="fichero" id="fichero" accept=".txt">
        <?php
            if(isset($_POST["btnSubir"]) && $error_form) {
                if($_FILES["fichero"]["name"] == '') {
                    echo "<span class = error>*</span>";
                } else if($_FILES["fichero"]["error"]) {
                    echo "<span class = error>Error en la subida del fichero</span>";
                } else if($_FILES["fichero"]["type"] != 'text/plain') {
                    echo "<span class = error>Error: no has seleccionado un archivo de texto</span>";
                } else {
                    echo "<span class = error>Error: el archivo seleccionado es superior a 1 MB</span>";
                }
            }
        ?>
    </p>
    <p>
        <button type="submit" name="btnSubir">Subir</button>
    </p>
    </form>
    <?php
        if (isset($_POST["btnSubir"]) && !$error_form) {
            @$var = move_uploaded_file($_FILES["fichero"]["tmp_name"], "Ficheros/archivo.txt");
            if ($var) {
                echo "<p>Fichero subido con éxito</p>";
            } else {
                echo "<p>El fichero seleccionado no ha podido moverme a la carpeta destino</p>";
            }
        }
    ?>
</body>
</html>