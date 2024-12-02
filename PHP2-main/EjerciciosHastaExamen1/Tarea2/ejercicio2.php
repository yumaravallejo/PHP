<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>

<body>
    <h1>Imprime un array asociativo</h1>
    <?php

    $v[1] = 90;
    $v[30] = 7;
    $v['e'] = 99;
    $v['hola'] = 43;

    foreach ($v as $indice => $contenido) {
        if (is_numeric($indice)) {
            echo "<p> El índice " . $indice . " tiene como valor: " . $contenido;
        } else {
            echo "<p> El índice '" . $indice . "' tiene como valor: " . $contenido;
        }
    }
    ?>
</body>

</html>