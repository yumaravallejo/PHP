<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 8</title>
</head>
<body>
    <?php
        echo "<h1>Nombres</h1>";

        $array = array("Pedro", "Ismael", "Sonia", "Clara", "Susana", "Alfonso", "Teresa");

        echo "Hay ".count($array)." nombres.";

        echo "<ul>";
        foreach ($array as $nombre) {
            echo "<li>".$nombre."</li>";
        }
        echo "</ul>";
    ?>
</body>
</html>
