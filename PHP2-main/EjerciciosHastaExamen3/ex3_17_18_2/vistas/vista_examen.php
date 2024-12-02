
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen3_17_18</title>
    <style>
        table,
        td,
        th {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
            text-align: center;
            width: 90%;
            margin: 0 auto
        }

        th {
            background-color: #CCC
        }

        table img {
            width: 100px;
        }

        .enlinea {
            display: inline
        }

        .enlace {
            border: none;
            background: none;
            text-decoration: underline;
            color: blue;
            cursor: pointer
        }
    </style>
</head>

<body>
    <h1>Video Club - Vista Usuario</h1>
    <div>Bienvenido <strong><?php echo $datos_usuario_logueado["usuario"]; ?></strong> -
        <form class='enlinea' action="index.php" method="post">
            <button class='enlace' type="submit" name="btnSalir">Salir</button>
        </form>
    </div>

    <h3>Listado de películas</h3>
    <?php
    // if (!isset($conexion))$conexion=conectarBD();
    if (!isset($conexion)) {
        $conexion = conectarBD();
    }

    //No error page,
    //$resultado=consultarBD($conexion,$consulta);
    try {
        $consulta = "select * from peliculas";
        $resultado = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        session_destroy();
        mysqli_close($conexion);
        die("<p>No se ha podido conectar con la base de datos: " . $e->getMessage() . "</p></body></html>");
    }

    echo "<table>";
    echo "<tr><th>id</th><th>Título</th><th>Carátula</th></tr>";

    //tantas filas como peliculas haya
    while ($tupla = mysqli_fetch_assoc($resultado)) {

        echo "<tr>";
        echo "<td>" . $tupla["idPelicula"] . "</td>";
        echo "<td>" . $tupla["titulo"] . "</td>";
        echo "<td><img src='img/" . $tupla["caratula"] . "' alt='Caratula' title='Caratula'></td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_free_result($resultado);


    ?>
</body>

</html>