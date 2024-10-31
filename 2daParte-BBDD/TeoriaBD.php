<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría de Bases de Datos</title>
    <style>.correcto {color:green}</style>
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

        echo "<p class='correcto'>Consulta realizada</p>";


        echo "<h3>Número de tuplas: </h3>";
        $n_tuplas = mysqli_num_rows($resultado);
        echo "<p>El número de alumnos en la tabla t_alumnos es ahora mismo de: ".$n_tuplas."</p>";

        echo "<h3>Mostrando las tuplas: </h3>";
        //Array asociativo: indices -> nombre de los campos
        $tupla = mysqli_fetch_assoc($resultado);
        echo "<p>El nombre del primer alumno obtenido es: ".$tupla['nombre']."</p>";

        //Array escalar
        $tupla = mysqli_fetch_row($resultado);
        echo "<p>El teléfono del segundo alumno obtenido es: ".$tupla[2]."</p>";

        //Guarda como objeto, se cogen los campos con la flecha y el nombre del campo
        $tupla = mysqli_fetch_object($resultado);
        echo "<p>El código postal del tercer alumno obtenido es: ".$tupla->cp."</p>";

        //Nos vamos a la tupla que queramos
        mysqli_data_seek($resultado, 1);

        //Cuando se coge una tupla que no existe porque se han acabado guarda NULL
        //Este es tanto asociativo como escalar
        $tupla = mysqli_fetch_array($resultado);
        mysqli_free_result($resultado);
        echo "<p>El nombre del segundo alumno obtenido es: ".$tupla[1]." y el teléfono ".$tupla['telefono']."</p>";

        mysqli_close($conexion);

        echo "<h2>Cerramos la conexión</h2>"
    ?>
</body>
</html>