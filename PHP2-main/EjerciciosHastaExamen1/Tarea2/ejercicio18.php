<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 18</title>
</head>
<body>
    <h1>Deportes</h1>
    <?php
        $deportes = array('fútbol', 'baloncesto', 'natación', 'tenis');

        echo "<p>";
        for ($i = 0; $i < count($deportes); $i++) {
            echo $deportes[$i]." ";
        }
        echo "</p>";

        echo "<p>El array tiene ".count($deportes)." valores.</p>";

        reset($deportes);
        echo "<p> Valor al que está señalando el puntero: ".current($deportes)."</p>";

        end($deportes);
        echo "<p> Valor al que está señalando el puntero: ".current($deportes)."</p>";

        prev($deportes);
        echo "<p> Valor al que está señalando el puntero: ".current($deportes)."</p>";
    ?>
</body>
</html>