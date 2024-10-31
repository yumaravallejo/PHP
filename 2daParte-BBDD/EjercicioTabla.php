<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría de Bases de Datos</title>
    <style>
        .correcto {color:green}
        table, th, td, tr {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px
        }
    </style>
</head>
<body>
    <h1>Teoría BD</h1>
    <?php
        /* CONEXIÓN BBDD */
        const SERVIDOR_BD = "localhost";
        const USUARIO_BD = "jose";
        const CONTRASENIA_BD = "josefa";
        const NOMBRE_BD = "bd_teoria";

        try {
            @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CONTRASENIA_BD, NOMBRE_BD);
            mysqli_set_charset($conexion, "utf8");
        } catch(Exception $e) {
            die ("<p>No se ha podido conectar a la base de datos: ".$e->getMessage()."</p></body></html>");
        }

        echo "<p class='correcto'>Conexión realizada</p>";

        /* CONSULTAS */
        try {
        $consulta = "select * from t_alumnos";
        $resultado = mysqli_query($conexion, $consulta);
        } catch (Exception $e) {
            mysqli_close($conexion);
            die ("<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p></body></html>");
        }

        echo "<table>";
        ?>
        <tr>
            <th>Cod Alumno</th>
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Código Postal</th>
        </tr>
        <?php

        $num_tuplas = mysqli_num_rows($resultado);
        for ($i=0; $i<$num_tuplas; $i++) {
            echo "<tr>";
            $tupla = mysqli_fetch_row($resultado);
            for ($j = 0; $j<count($tupla); $j++) {
                echo "<td>".$tupla[$j]."</td>";
            }
            echo "</tr>";
        }
        echo "</table>";


?>

</body>
</html>