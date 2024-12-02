<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
    <style>
        table, td, th{border:1px solid black}
        table{border-collapse: collapse; width: 90%; margin: 0 auto;}
    </style>
</head>

<body>
    <h1>Ejercicio 5</h1>
    <?php
                @$fd=fopen("http://dwese.icarosproject.com/PHP/datos_ficheros.txt", "r");
                ?>
    <p>
            <table>
                <caption>PIB per cápita de los países de la Unión Europea</caption>
                <?php
                $linea = fgets($fd);
                $datos_linea=explode("\t", $linea);
                $n_col=count($datos_linea);
                    echo "<tr>";
                    for($i=0; $i<$n_col; $i++){
                        echo "<th>$datos_linea[$i]</th>";
                    }
                    echo "</tr>";

                    while ($linea=fgets($fd)) {
                        $datos_linea=explode("\t", $linea);
                        echo "<tr>";
                        echo "<th>$datos_linea[0]</th>";
                        for($i=0; $i<$n_col; $i++){
                            if(isset($datos_linea[$i])){
                                echo "<td>$datos_linea[$i]</td>";
                            } else {
                                echo "<td></td>";
                            }
                        }
                        echo "</tr>";
                    }
                    fclose($fd);
                ?>
            </table>
        </p>

</body>

</html>
