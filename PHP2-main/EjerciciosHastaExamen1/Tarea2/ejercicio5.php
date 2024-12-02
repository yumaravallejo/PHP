<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
</head>
<body>
    <?php
        echo "<h1>Datos de Pedro</h1>";

        $datos = array("Nombre" => "Pedro Torres", "Dirección" => "C/ Mayor, 37",
        "Teléfono" => "123456789");

        foreach($datos as $nombre => $dato) {
            echo "<p>".$nombre.": ".$dato."</p>";
        }
    ?>
</body>
</html>
