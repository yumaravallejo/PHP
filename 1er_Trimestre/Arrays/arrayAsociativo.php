<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array Asociativo</title>
    <style>
        table,td,th{border: 1px solid black;}
        table {border-collapse: collapse;}
        td, th {padding: 5px;
        }
    </style>
</head>
<body>
    <h1>Arrays asociativos</h1>
    <?php
        $notas["Nerea"] = 10;
        $notas["Javi"] = 6;
        $notas["Edu"] = 8;

        echo "<h2>Notas de los alumnos de 2º DAW en una asignatura DWESE (Foreach)</h2>";

        echo "<table>";
        echo "<tr><th>Alumno</th><th>Nota</th></tr>";
        foreach ($notas as $nombre=>$valor_nota) {
            echo "<tr>";
                echo "<td>".$nombre."</td>";
                echo "<td>".$valor_nota."</td>";
            echo "</tr>";
        }
        echo "</table>";

        echo "<br>";
        echo "<h2>Notas de los alumnos de 2º DAW en una asignatura DWESE (While)</h2>";


        echo "<table>";
        echo "<tr><th>Alumno</th><th>Nota</th></tr>";
        while (current($notas)){
        echo "<tr>";
                echo "<td>".key($notas)."</td>";
                echo "<td>".current($notas)."</td>";
            echo "</tr>";
        next($notas);
        }
        echo "</table>";
    ?>
</body>
</html>