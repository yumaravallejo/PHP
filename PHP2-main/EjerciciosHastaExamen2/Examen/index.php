<?php
session_name("examen2Nerea");
session_start();

require "src/ctes_funciones.php";
require "vistas/vista_insertar.php";
require "vistas/vista_quitar.php";

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen2 PHP</title>
    <style>
        h3 {
            text-align: center;
        }

        table,
        th,
        td,
        tr {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
        }

        table {
            width: 50%;
            margin: 1rem;
        }

        table#horarios {
            width: 80%;
            margin: 0 auto;
        }

        th {
            background-color: #CCC;
        }

        .enlace {
            background: none;
            border: none;
            color: blue;
            cursor: pointer;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h1>Examen2 PHP</h1>
    <h2>Horario de los Profesores</h2>

    <?php
    // Conexión
    if (!isset($conexion)) {
        try {
            $conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
            mysqli_set_charset($conexion, "utf8");
        } catch (Exception $e) {
            session_destroy();
            die("<p>Ha habido un error: " . $e->getMessage() . "</p></body></html>");
        }
    }

    // Profesores
    try {
        $consulta = "select * from usuarios";
        $resultado = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        session_destroy();
        mysqli_close($conexion);
        die("<p>Ha habido un error: " . $e->getMessage() . "</p></body></html>");
    }

    if (mysqli_num_rows($resultado) > 0) {
    ?>
        <form action="index.php" method="post">
            <label for="profesores">Horario del Profesor: </label>
            <select name="profesores" id="profesores">
                <?php
                while ($tupla = mysqli_fetch_assoc($resultado)) {
                    if ((isset($_POST["profesores"]) && $_POST["profesores"] == $tupla["id_usuario"]) || (isset($_SESSION["profesores"]) && $_SESSION["profesores"] == $tupla["id_usuario"])) {
                        echo "<option selected value='" . $tupla["id_usuario"] . "'>" . $tupla["nombre"] . "</option>";
                        $cod_prof = $tupla["id_usuario"];
                        $nombre_prof = $tupla["nombre"];
                    } else
                        echo "<option value='" . $tupla["id_usuario"] . "'>" . $tupla["nombre"] . "</option>";
                }
                ?>
            </select>
            <button name="btnVerHorario" type="submit" value="<?php if (isset($cod_prof)) echo $cod_prof ?>">Ver Horario</button>
        </form>
    <?php
    } else {
        echo "<p>No hay profesores en la BD.</p>";
    }

    // Votón ver horario
    if (isset($_POST["profesores"]) || (isset($_SESSION["profesores"]))) {
        echo "<h3>Horario del Profesor: " . $nombre_prof . "</h3>";
        require "vistas/vista_tabla.php";

        // Botón editar
        if (isset($_POST["btnEditar"]) || (isset($_SESSION["profesores"])))
            require "vistas/vista_editar.php";
    }

    mysqli_free_result($resultado);
    mysqli_close($conexion);
    ?>
</body>

</html>