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

        try {
            $consulta3 = "select * from t_notas join t_alumnos on t_notas.cod_alum = t_alumnos.cod_alumno JOIN t_asignaturas on t_notas.cod_asig = t_asignaturas.cod_asignatura";
            $resultado3 = mysqli_query($conexion, $consulta3);
        } catch (Exception $e) {
            mysqli_close($conexion);
            die ("<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p></body></html>");
        }
        
        

        echo "<table>";
        ?>
        <tr>
            <th>Nombre</th>
            <th>Asignatura</th>
            <th>Nota</th>
        </tr>
        <?php

        $num_tuplas = mysqli_num_rows($resultado3);
        for ($i=0; $i<$num_tuplas; $i++) {
            echo "<tr>";
            $tupla3 = mysqli_fetch_assoc($resultado3);

            echo "<td>".$tupla3['nombre']."</td>";
            echo "<td>".$tupla3['denominacion']."</td>";
            echo "<td>".$tupla3['nota']."</td>";

            echo "</tr>";
        }
        echo "</table>";


?>

</body>
</html>