<?php
function mi_strlen($texto) {
    $cont = 0;
    while (isset($texto[$cont])) {
        $cont++;
    }
    return $cont;
}

function mi_explode($separador, $texto) {
    $array = [];
    $longitud = mi_strlen($texto);
    $i = 0;
    while ($i < $longitud && $texto[$i] == $separador) {
        $i++;
    }

    if($i < $longitud) {
        $j = 0;
        for ($i ; $i < $longitud; $i++) {
            $array[$j] = '';
            if ($texto[$i] != $separador) {
                $array[$j] .= $texto[$i];
            } else {
                while ($i < $longitud && $texto[$i] == $separador) {
                    $i++;
                }
                $j++;
            }
        }
    }

    return $array;
}
if (isset($_POST["btnSubir"])) {
    $error_form = $_FILES["fichero"]["name"] == "" ||
        $_FILES["fichero"]["error"] ||
        $_FILES["fichero"]["type"] != 'text/plain' ||
        $_FILES["fichero"]["size"] > 1000 * 1024;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
    <style>
        .error {
            color: red;
        }
        .texto_centrado {text-align: center;}
    </style>
</head>

<body>
    <h1>Ejercicio 4</h1>
    <?php
    if (isset($_POST["btnSubir"]) && !$error_form) {
        @$var = move_uploaded_file($_FILES["fichero"]["tmp_name"], "Horario/horarios.txt");
        if (!$var) {
            echo "<p>El fichero seleccionado no se ha podido mover a la carpeta destino</p>";
        }
    }

    @$fd = fopen("Horario/horarios.txt", "r");
    if ($fd) {
        while ($linea = fgets($fd)) {
            $datos_linea = mi_explode("\t", $linea);
            //$profesores[] = $datos_linea[0];
            //"<option value'".$i."'>".$profesores[$i]."</option>"
            if(isset($_POST["btnVerHorario"]) && $_POST["profesor"] == $datos_linea[0]) {
                $options = "<option selected value'".$datos_linea[0]."'>".$datos_linea[0]."</option>";
            } else {
                $options = "<option value'".$datos_linea[0]."'>".$datos_linea[0]."</option>";
            }
            
            fclose($fd);
        }
    ?>
        <h2>Horario de los profesores</h2>
        <form action="ejercicio4.php" method="post">
            <p>
                <label for="profesor">Horario del profesor </label>
                <select name="profesor" id="profesor">
                    <?php
                        //for ($i = 0; $i < count($profesores); $i++) {
                            //echo "<option value'".$i."'>".$profesores[$i]."</option>";
                        //}
                        echo $options;
                    ?>
                </select>
                <button name="btnVerHorario" type="submit">Ver horario</button>
            </p>
        </form>
    <?php
        if (isset($_POST["btnVerHorario"])) {
            echo "<h3>Horario del profesor: ".$datos_profesor_selec[0]."</h3>";
        }
    } else {
    ?>
        <h2>No se encuentra el archivo <em>Horario/horarios.txt</em></h2>
        <form action="ejercicio4.php" method="post" enctype="multipart/form-data">
            <p>
                <label for="fichero">Seleccione un archivo (Máx. 1MB)</label>
                <input type="file" name="fichero" id="fichero" accept=".txt">
                <?php
                if (isset($_POST["btnSubir"]) && $error_form) {
                    if ($_FILES["fichero"]["name"] == '') {
                        echo "<span class = error>*</span>";
                    } else if ($_FILES["fichero"]["error"]) {
                        echo "<span class = error>Error en la subida del fichero</span>";
                    } else if ($_FILES["fichero"]["type"] != 'text/plain') {
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
    }
    ?>
</body>

</html>