<?php
    if (isset($_POST['enviar'])) {
        $error_vacio = $_FILES['fichero']['name'] =="";
        $error_tam = $_FILES['fichero']['size'] > 1000*1024;
        $error_fich = $_FILES['fichero']['error'] != 0;
        $error_tipo = $_FILES['fichero']['type'] != "text/plain";
        $errores_form = $error_vacio || $error_tam || $error_fich;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
</head>
<body>
    <h1>Ejercicio 4</h1>

    <?php
        if (isset($_POST['enviar']) && !$errores_form) {
            @$mover = move_uploaded_file($_FILES['fichero']['tmp_name'], "Horario/horarios.txt");
            if (!$mover){
                echo "<p>No ha podido moverse el archivo</p>";
            }
        }

        $nombre_archivo = "Horario/horarios.txt";

        @$archivo = fopen($nombre_archivo, "r");
        if ($archivo){
            require "vistas/horario_prof.php";
            fclose($archivo);
        } else {
            require "vistas/formulario_arch.php";
        }
    ?>
</body>
</html>