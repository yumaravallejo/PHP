<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7</title>
</head>
<body>
    <?php
        echo "<h1>Ciudades</h1>";

        $array = array("MD" => "Madrid", "BC" => "Barcelona", "LD" => "Londres", "NY" => "Nueva York",
        "LA" => "Los Ángeles", "CC" => "Chicago");

        foreach ($array as $indice => $ciudad) {
            echo "<p> El índice del array que contiene como valor ".$ciudad." es ".$indice.".</p>";
        }
    ?>
</body>
</html>

