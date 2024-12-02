<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>

<body>
    <h1>Los 10 primeros números pares</h1>
    <?php
    // Almacena en un array los 10 primeros números pares. 
    // Imprímelos cada uno en una línea.

    for ($i = 0; $i < 10 * 2; $i += 2) {
        echo "<p>" . $i . "</p>";
    }
    ?>
</body>

</html>