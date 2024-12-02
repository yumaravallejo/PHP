<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Club</title>
    <style>
        .enlace {
            background: none;
            border: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
        }
        th {
            background-color: #CCC;
        }
        img {
            width: 100px;
        }
    </style>
</head>

<body>
    <h1>Video Club</h1>
    <p>
    <form action="../index.php" method="post">
        Bienvenido <strong> <?php echo $_SESSION["usuario"]  ?></strong> -
        <button type="submit" name="btnSalir" class="enlace">Salir</button>
    </form>
    </p>
    <h3>Listado de Películas</h3>
    <?php
    try {
        $conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        session_destroy();
        die(error_page("ERROR", "<p>Ha habido un error: " . $e->getMessage() . "</p>"));
    }

    try {
        $consulta = "select * from peliculas";
        $resultado = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        session_destroy();
        mysqli_close($conexion);
        die("<p>Ha habido un error: " . $e->getMessage() . "</p></body></html>");
    }

    echo "<table>";
    echo "<tr><th>Id</th><th>Título</th><th>Carátula</th></tr>";
    while($tupla=mysqli_fetch_assoc($resultado)) {
        echo "<tr>
        <td>".$tupla["idPelicula"]."</td>
        <td>".$tupla["titulo"]."</td>
        <td><img src='../Img/".$tupla["caratula"]."' alt='Imagen de la película '".$tupla["titulo"]."></td>
        </tr>";
    }
    echo "</table>";
    mysqli_free_result($resultado);
    ?>

</body>

</html>