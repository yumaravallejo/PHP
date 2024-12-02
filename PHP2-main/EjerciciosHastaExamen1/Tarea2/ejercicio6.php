<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejerciio 6</title>
</head>
<body>
    <?php
        echo "<h1>Ciudades</h1>";

        $ciudades = array("Madrid", "Barcelona", "Londres", "New York",
        "Los Ángeles", "Chicago");

        foreach($ciudades as $posicion => $nombre) {
            echo "<p>La ciudad co el indice ".$posicion." tiene el nombre ".$nombre."</p>";
        }
    ?>
</body>
</html>
