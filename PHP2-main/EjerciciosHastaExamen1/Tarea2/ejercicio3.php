<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>
<body>
<h1>Números de películas vistas</h1
    <?php
        $peliculas = array("enero" => 9, "febrero" => 12,
        "marzo" => 0, "abril" => 17);

        foreach ($peliculas as $mes => $numero) {
            if ($numero > 0) {
                echo "<p> En <strong>".$mes."</strong> se han visto <strong>"
                .$numero."</strong> películas. </p>";
            }
        }
    ?>
</body>
</html>
