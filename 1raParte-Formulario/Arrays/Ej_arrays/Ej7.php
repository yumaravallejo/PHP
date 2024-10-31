<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7 - Práctica con arrays</title>
</head>
<body>
    <h1>Mostrar array con índice asociativo y su valor</h1>
    <?php
        $ciudades["MD"] = "Madrid";
        $ciudades["BC"] = "Barcelona";
        $ciudades["LD"] = "Londres";
        $ciudades["NY"] = "New York";
        $ciudades["LA"] = "Los Ángeles";
        $ciudades["CH"] = "Chicago";

        foreach($ciudades as $index=>$ciudad) {
            echo "<p>El índice que contiene como valor ".$ciudad." es ".$index."</p>";
        }

        //Esta clase de arrays también pueden recorrerse con un for básico
        // Solamente si los índices son numéricos y están en orden
    ?>
</body>
</html>