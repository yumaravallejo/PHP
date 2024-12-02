<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 15</title>
</head>
<body>
    <h1>Números ordenados de menor a mayor</h1>
    <?php
        $numeros = array(3, 2, 8, 123, 5, 1);

        echo "<p>";
        foreach ($numeros as $n) {
            echo "$n    ";
        }
        echo "</p>";

        asort($numeros);

        echo "<p>";
        foreach ($numeros as $n) {
            echo "$n    ";
        }
        echo "</p>";
    ?>
</body>
</html>