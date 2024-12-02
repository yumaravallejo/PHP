<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 16</title>
</head>
<body>
    <h1>Ejercicio 16</h1>
    <?php
        $array = array(5 => 1, 12 => 2, 13 => 56, 'x' => 42);

        echo "<p>";
        foreach ($array as $n) {
            echo "$n    ";
        }
        echo "</p>";

        echo "<p>Este array tiene ".count($array)." elementos.</p>";

        unset($array[5]);

        echo "<p>";
        foreach ($array as $n) {
            echo "$n    ";
        }
        echo "</p>";

        unset($array);
    ?>
</body>
</html>