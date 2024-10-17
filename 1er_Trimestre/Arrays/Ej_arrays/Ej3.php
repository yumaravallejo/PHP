<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 - Práctica con arrays</title>
</head>
<body>
    <h1>Mostrar un aray en una tabla</h1>
    <?php
        $peliculas["Enero"] = 9;
        $peliculas["Febrero"] = 12;
        $peliculas["Marzo"] = 0;
        $peliculas["Abril"] = 17;

        echo "<table>";
        echo "<tr><th>Mes</th><th>Películas</th></tr>";
        foreach($peliculas as $mes=>$pelis_vistas){  
            if ($pelis_vistas>0){
                echo "<tr>";
                    echo "<td>".$mes."</td>
                          <td>".$pelis_vistas."</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
    ?>
</body>
</html>