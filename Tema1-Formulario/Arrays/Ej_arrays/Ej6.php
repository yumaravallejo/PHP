<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6 - Práctica con arrays</title>
</head>
<body>
    <h1>Mostrar array con su índice numérico</h1>

    <?php
        $ciudades[] = "Madrid";
        $ciudades[] = "Barcelona";
        $ciudades[] = "Londres";
        $ciudades[] = "New York";
        $ciudades[] = "Los Ángeles";
        $ciudades[] = "Chicago";

        foreach($ciudades as $index=>$ciudad) {
            echo "<p>La ciudad con el índice ".$index." tiene el nombre ".$ciudad."</p>";
        }

        //Esta clase de arrays también pueden recorrerse con un for básico
        // Solamente si los índices son numéricos y están en orden
    ?>
</body>
</html>