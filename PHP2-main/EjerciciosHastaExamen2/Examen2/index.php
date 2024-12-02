<?php
require "src/ctes_funciones.php";
session_name("Examen");
session_start();

if (isset($_POST["btnBorrar"])) {
    try {
        $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_exam_colegio");
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        session_destroy();
        die(error_page("Error", "<p>Ha habido un error" . $e->getMessage() . "</p>"));
    }

    try {
        $consulta = "delete from notas where cod_asig ='" . $_POST["btnBorrar"] . "' and cod_alu='" . $_POST["alumnos"] . "'";
        $resultado = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        session_destroy();
        die(error_page("Error", "<p>Ha habido un error: " . $e->getMessage() . "</p>"));
    }

    $_SESSION["mensaje"] = "¡¡ Asignatura descalificada con Éxito !!";
    $_SESSION["alumnos"] = $_POST["alumnos"];
    header("Location: index.php");
    exit();
}

if (isset($_POST["btnCambiar"])) {
    $error_form = $_POST["nota"] == "" || !is_numeric($_POST["nota"]) || $_POST["nota"] < 0 || $_POST["nota"] > 10;
    if (!$error_form) {
        try {
            $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_exam_colegio");
            mysqli_set_charset($conexion, "utf8");
        } catch (Exception $e) {
            session_destroy();
            die(error_page("Error", "<p>Ha habido un error" . $e->getMessage() . "</p>"));
        }

        try {
            $consulta = "update notas set nota=" . $_POST["nota"] . " where cod_asig ='" . $_POST["btnCambiar"] . "' and cod_alu='" . $_POST["alumnos"] . "'";
            $resultado = mysqli_query($conexion, $consulta);
        } catch (Exception $e) {
            session_destroy();
            die(error_page("Error", "<p>Ha habido un error: " . $e->getMessage() . "</p>"));
        }

        $_SESSION["mensaje"] = "¡¡ Nota cambiada con Éxito !!";
        $_SESSION["alumnos"] = $_POST["alumnos"];
        header("Location: index.php");
        exit();
    }
}

if (isset($_POST["btnCalificar"])) {
    try {
        $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_exam_colegio");
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        session_destroy();
        die(error_page("Error", "<p>Ha habido un error" . $e->getMessage() . "</p>"));
    }

    try {
        $consulta = "insert into notas (cod_asig, cod_alu, nota) values ('".$_POST["asignaturas"]."', '".$_POST["alumnos"]."', '0.0')";
        $resultado = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        session_destroy();
        die(error_page("Error", "<p>Ha habido un error: " . $e->getMessage() . "</p>"));
    }

    $_SESSION["mensaje"] = "¡¡ Asignatura calificada con un 0. Cambie la nota si lo estima necesario. !!";
    $_SESSION["alumnos"] = $_POST["alumnos"];
    $_SESSION["asig"] = $_POST["asignaturas"];
    header("Location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen 2</title>
    <style>
        table,
        tr,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th {
            background-color: #CCC;
        }

        .enlace {
            background: none;
            text-decoration: underline;
            color: blue;
            border: none;
            cursor: pointer;
        }

        .mensaje {
            font-size: 2rem;
            color: blue;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Notas de los alumnos</h1>
    <?php
    if (!isset($conexion)) {
        try {
            $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_exam_colegio");
            mysqli_set_charset($conexion, "utf8");
        } catch (Exception $e) {
            session_destroy();
            die(error_page("Error", "<p>Ha habido un error" . $e->getMessage() . "</p>"));
        }
    }

    try {
        $consulta = "select * from alumnos";
        $resultado = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        session_destroy();
        mysqli_close($conexion);
        die(error_page("Error", "<p>Ha habido un error" . $e->getMessage() . "</p>"));
    }

    if (mysqli_num_rows($resultado) <= 0) {
        echo "<p>En estos momentos no tenemos ningún alumno registrado en la BD.</p>";
    } else {
    ?>
        <form action="index.php" method="post">
            <p>
                <label for="alumnos">Selecciones un Alumno: </label>
                <select name="alumnos" id="alumnos">
                    <?php
                    while ($array_alumnos =  mysqli_fetch_assoc($resultado)) {
                        if ((isset($_POST["alumnos"]) && $_POST["alumnos"] == $array_alumnos["cod_alu"]) || (isset($_SESSION["alumnos"]) && $_SESSION["alumnos"] == $array_alumnos["cod_alu"])) {
                            echo "<option selected value='" . $array_alumnos["cod_alu"] . "' >" . $array_alumnos["nombre"] . "</option>";
                            $nombre_alumno = $array_alumnos["nombre"];
                        } else {
                            echo "<option value='" . $array_alumnos["cod_alu"] . "' >" . $array_alumnos["nombre"] . "</option>";
                        }
                    }
                    ?>
                </select>
                <button type="submit" name="btnVerNotas"> Ver notas</button>
            </p>
        </form>
    <?php
        if (isset($_POST["alumnos"]) || isset($_SESSION["alumnos"])) {

            if (isset($_SESSION["alumnos"])) {
                $cod_alu = $_SESSION["alumnos"];
            } else {
                $cod_alu = $_POST["alumnos"];
            }

            echo "<h2>Notas del alumno " . $nombre_alumno . "</h2>";
            try {
                $consulta = "select notas.cod_asig, asignaturas.denominacion, notas.nota from notas,asignaturas where notas.cod_asig=asignaturas.cod_asig and notas.cod_alu='" . $cod_alu . "'";
                $resultado = mysqli_query($conexion, $consulta);
            } catch (Exception $e) {
                mysqli_close($conexion);
                die(error_page("Error", "<p>Ha habido un error" . $e->getMessage() . "</p>"));
            }

            echo "<table>";
            echo "<tr><th>Asignatura</th><th>Nota</th><th>Acción</th></tr>";
            if (mysqli_num_rows($resultado) > 0) {
                while ($tupla =  mysqli_fetch_assoc($resultado)) {
                    echo "<tr><td>" . $tupla["denominacion"] . "</td>";
                    if ((isset($_POST["btnEditar"]) && $_POST["btnEditar"] == $tupla["cod_asig"]) || (isset($_POST["btnCambiar"]) && $_POST["btnCambiar"] == $tupla["cod_asig"]) || (isset($_SESSION["asig"]) && $_SESSION["asig"] == $tupla["cod_asig"])) {

                        if (isset($_POST["btnEditar"]) || isset($_SESSION["asig"])) {
                            $nota = $tupla["nota"];
                        } else {
                            $nota = $_POST["nota"];
                        }

                        echo "<td><form action='index.php' method='post'><input type='text' name='nota' value='" . $nota . "'><br>";
                        if (isset($_POST["nota"]) && $error_form) {
                            echo "<span class='error'>* No has introducido un valor válido de Nota *</span>";
                        }
                        echo "</td>";
                        echo "<td><input type='hidden' name='alumnos' value='" . $cod_alu . "' ><button type='submit' class='enlace' name='btnCambiar' value='" . $tupla["cod_asig"] . "'>Cambiar</button> - <button type='submit' class='enlace' name='btnAtras'>Atrás</button></form></td>";
                    } else {
                        echo "<td>" . $tupla["nota"] . "</td>
                        <td><form action='index.php' method='post'><input type='hidden' name='nom_alu' value='" . $nombre_alumno . "' ><input type='hidden' name='alumnos' value='" . $cod_alu . "' ><button type='submit' class='enlace' name='btnEditar' value='" . $tupla["cod_asig"] . "'>Editar</button> - <button type='submit' class='enlace' name='btnBorrar' value='" . $tupla["cod_asig"] . "'>Borrar</button></form></td>
                        ";
                    }
                    echo "</tr>";
                }
            }
            echo "</table>";
            mysqli_free_result($resultado);

            if (isset($_SESSION["mensaje"])) {
                echo "<p class='mensaje'>" . $_SESSION["mensaje"] . "</p>";
                session_destroy();
            }

            try {
                $consulta = "select * from asignaturas where cod_asig not in (select notas.cod_asig from notas,asignaturas where notas.cod_asig=asignaturas.cod_asig and notas.cod_alu='" . $cod_alu . "')";
                $resultado = mysqli_query($conexion, $consulta);
            } catch (Exception $e) {
                mysqli_close($conexion);
                die(error_page("Error", "<p>Ha habido un error: " . $e->getMessage() . "</p>"));
            }

            if (mysqli_num_rows($resultado) > 0) {
                echo "<form action='index.php' method='post'><p><label for='asignaturas'>Asignaturas que a <strong>" . $nombre_alumno . "</strong> aún quedan por calificar: </label>";
                echo "<select name='asignaturas' id='asignaturas'>";
                while ($tupla =  mysqli_fetch_assoc($resultado)) {
                    echo "<option value='" . $tupla["cod_asig"] . "' >" . $tupla["denominacion"] . "</option>";
                }
                echo "</select>";
                echo "<input type='hidden' name='alumnos' value='" . $cod_alu . "' ><button name='btnCalificar' type='submit'>Calificar</button>";
                echo "</p></form>";
            } else {
                echo "<p>A <strong>" . $nombre_alumno . "</strong> no le quedan asignaturas por calificar.</p>";
            }
        }
    }
    mysqli_free_result($resultado);
    mysqli_close($conexion);
    ?>
</body>

</html>