<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría BD</title>
    <style>
        table, th, td { border: 1px solid black;} 
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 0 auto;
            text-align: center;
        }
        th {
            background-color: #CCC;
        }
    </style>
</head>
<body>
    <h1>Teoría de bases de datos</h1>
    <?php
    try {
        $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_teoria");
        mysqli_set_charset($conexion, "utf8"); // Para que me escriba bien los caracteres de la bbdd
    } catch (Exception $e) {
        die ("<p>No ha podido conectarse a la base de datos: ".$e -> getMessage()."</p></body></html>");
    }

    // Consulta de todos los alumnos
    $consulta = "select * from t_alumnos";
    try {
        $resultado = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        mysqli_close($conexion);
        die ("<p>No se ha podido realizar la consulta: ".$e -> getMessage()."</p></body></html>");
    }

    // Recorremos el resultado obtenido
    // Primero comprobamos si está vacío
    $n_tuplas = mysqli_num_rows($resultado);
    echo "<p>Número de tuplas obtenidas ha sido: ".$n_tuplas."</p>";

    // ARRAY ASOCIATIVO $array["nombre_columna"] = valor
    $tupla = mysqli_fetch_assoc($resultado); // Como el gets de los ficheros
    echo "<p>El primer alumno tiene el nombre: ".$tupla["nombre"]."</p>"; 
    
    // ARRAY ESCALAR $array[0] = valor de id
    $tupla = mysqli_fetch_row($resultado); // Como el gets de los ficheros
    echo "<p>El segundo alumno tiene el nombre: ".$tupla[1]."</p>"; 

    // ARRAY ASOCIATIVO Y ESCALAR
    $tupla = mysqli_fetch_array($resultado);
    echo "<p>El tercer alumno tiene el nombre: ".$tupla["nombre"]."</p>"; 
    echo "<p>El tercer alumno tiene el nombre: ".$tupla[1]."</p>"; 

    // Para ir al principio o a la tupla que queramos
    mysqli_data_seek($resultado, 1);

    // OBJECTO
    $tupla = mysqli_fetch_object($resultado);
    echo "<p>El tercer alumno tiene el nombre: ".$tupla -> nombre."</p>"; 

    // Vamos a crear una tabla con todos los datos
    mysqli_data_seek($resultado, 0);

    echo "<table>";
    echo "<tr><th>Código</th><th>Nombre</th><th>Teléfono</th><th>Código postal</th></tr>";
    while ($tupla = mysqli_fetch_row($resultado)) {
        echo "<tr>";
        for ($i = 0; $i < count($tupla); $i++) {
            echo "<td>".$tupla[$i]."</td>";
        }
        echo "</tr>";
    }
    echo "</tr>";

    mysqli_close($conexion);
    ?>
</body>
</html>