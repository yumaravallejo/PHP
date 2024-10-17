<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 8 - Práctica con arrays</title>
</head>
<body>
    <h1>Mostrar array en una lista</h1>
    <?php
        $persona[] = "Pedro";
        $persona[] = "Ismael";
        $persona[] = "Sonia";
        $persona[] = "Clara";
        $persona[] = "Susana";
        $persona[] = "Alfonso";
        $persona[] = "Teresa";

        echo "<ul>";
        foreach($persona as $nombre) {
            echo "<li>".$nombre."</li>";
        }
        echo "<ul>";

        //Esta clase de arrays también pueden recorrerse con un for básico
        // Solamente si los índices son numéricos y están en orden
    ?>
</body>
</html>