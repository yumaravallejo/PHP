<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 14</title>
</head>
<body>
    <h1>Estadios</h1>
    <?php
        $estadios_futbol = array("Barcelona" => "Camp Nou", "Real Madrid" => "Santiago Bernabeu",
        "Valencia" => "Mestalla", "Real Sociedad" => "Anoeta");

        echo "<table>";
        foreach ($estadios_futbol as $ciudad => $estadio) {
            echo "<tr><td>$ciudad</td><td>$estadio</td></tr>";
        }
        echo "<table>";

        echo "<p>Eliminamos el estadio del Real Madrid</p>";
        unset($estadios_futbol["Real Madrid"]);

        echo "<table>";
        foreach ($estadios_futbol as $ciudad => $estadio) {
            echo "<tr><td>$ciudad</td><td>$estadio</td></tr>";
        }
        echo "<table>";



    ?>
</body>
</html>