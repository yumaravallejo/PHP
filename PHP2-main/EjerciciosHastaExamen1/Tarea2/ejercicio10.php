<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 10</title>
</head>
<body>
    <h1>10 primeros numeros naturales</h1>
    <h2>Números impares</h2>
    <?php
        $array = Array();
        $pares = 0;
        for ($i = 0; $i < 10; $i++) {
            $array[] = $i;
            if($i%2 == 0) {
                $pares += $i;
            } else {
                echo "<p>$i</p>";
            }
        }
        echo "<h2>Media de los números pares</h2>";
        echo "<p>".$pares/(count($array)/2)."</p>";

    ?>
</body>
</html>