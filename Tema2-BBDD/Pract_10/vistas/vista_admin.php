<?php

try {
    $sentencia = "SELECT * FROM alumnos";
    $alumnos = mysqli_query($conexion, $sentencia);
} catch (Exception $e) {
    mysqli_close($conexion);
    session_destroy();
    die("No se ha podido realizar la consulta");
}
?>

<h1>Notas de los alumnos</h1>
<?php
if (mysqli_num_rows($alumnos) > 0) {
?>
    <form action="admin.php" method="post">
        <label for="alumno">Seleccione un alumno: </label>

        <select name="alumno" id="alumno">
            <?php
            while ($tupla = mysqli_fetch_assoc($alumnos)) {
                $selected = (isset($_POST['alumno']) && $_POST['alumno'] == $tupla['cod_alu']) ? "selected" : "";
                echo "<option value='" . $tupla['cod_alu'] . "' $selected>" . $tupla['nombre'] . "</option>";
            }
            ?>
        </select>
        <button type="submit" name="verNotas">Ver Notas</button>
        <button class="enlace" type="submit" name="btnCerrarSesion">Salir</button>
    </form>

    <?php
    if (isset($_POST['verNotas'])) {
        try {
            $sentencia1 = "SELECT * FROM alumnos WHERE cod_alu = '" . $_POST['alumno'] . "'";
            $consult = mysqli_query($conexion, $sentencia1);
            $usuario_elegido = mysqli_fetch_assoc($consult);
            mysqli_free_result($consult);
        } catch (Exception $e) {
            mysqli_close($conexion);
            session_destroy();
            die("No se ha podido realizar la consulta");
        }

        try {
            $sentencia2 = "SELECT * 
                       FROM asignaturas";
            $consulta = mysqli_query($conexion, $sentencia2);
            $cantidad = mysqli_num_rows($consulta);
        } catch (Exception $e) {
            mysqli_close($conexion);
            session_destroy();
            die("No se ha podido realizar la consulta");
        }

        try {
            $sentencia = "SELECT asignaturas.denominacion, notas.nota 
                      FROM notas
                      JOIN asignaturas on notas.cod_asig = asignaturas.cod_asig
                      JOIN alumnos on notas.cod_alu = alumnos.cod_alu
                      WHERE notas.cod_alu = '" . $_POST['alumno'] . "'";
            $consultilla = mysqli_query($conexion, $sentencia);
        } catch (Exception $e) {
            mysqli_close($conexion);
            session_destroy();
            die("No se ha podido realizar la consulta " . $e->getMessage());
        }

        try {
            $consulta = "
            SELECT *
            FROM asignaturas
            WHERE cod_asig NOT IN (
                                SELECT cod_asig
                                FROM notas
                                WHERE cod_alu='" . $_POST["alumno"] . "
                                ')";
            $result_asignaturas_faltan = mysqli_query($conexion, $consulta);
        } catch (Exception $e) {
            session_destroy();
            mysqli_close($conexion);
            die(error_page("Examen2 PHP", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
        }
    }

    if (isset($_POST['btnCalificar'])) {
        try {
            $cali = "INSERT INTO notas (cod_asig, cod_alu) VALUES ('" . $_POST['asignatura'] . "', '" . $_POST['btnCalificar'] . "')";
            $insercion = mysqli_query($conexion, $cali);
            if ($insercion) $_SESSION['mensaje'] = "Se ha agregado la nota con éxito";
        } catch (Exception $e) {
            session_destroy();
            mysqli_close($conexion);
            die(error_page("Examen2 PHP", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
        }
    }

    if (isset($_POST['btnBorrar'])) {
        
    }

    if (isset($_POST['alumno'])) {
        echo "<h2>Notas del Alumno " . $usuario_elegido['nombre'] . "</h2>";
    ?>
        <table>
            <tr>
                <th>Asignatura</th>
                <th>Nota</th>
                <th>Acción</th>
            </tr>
            <?php
            while ($tup_asig = mysqli_fetch_assoc($consultilla)) {
                echo "<tr>";
                echo "<td>" . $tup_asig['denominacion'] . "</td>";
                echo "<td>" . $tup_asig['nota'] . "</td>";
                echo "<td>
                <form method='post' action='admin.php'>
                    <input type='hidden' name='asignatura' value='".$tup_asig['denominacion']."'>
                    <input type='hidden' name='nota' value='".$tup_asig['nota']."'>
                    <button class='enlace' name='btnEditar' type='submit' value='".$usuario_elegido['nombre']."'>Editar</button>
                    -
                    <button class='enlace' name='btnBorrar' type='submit' value='".$usuario_elegido['nombre']."'>Borrar</button>
                </form>
                </td>";
                echo "</tr>";
            }
            ?>
        </table>
        <?php
        if (mysqli_num_rows($consultilla) < $cantidad) {
        ?>
            <form method='post' action="admin.php">
                <p>
                    <label for="asignatura">
                        Asignaturas que a <?php echo $usuario_elegido['nombre']; ?> aún le quedan por calificar:
                    </label>
                    <select name="asignatura" id="asignatura">
                        <?php
                        while ($tupla = mysqli_fetch_assoc($result_asignaturas_faltan)) {
                            echo "<option  value='" . $tupla["cod_asig"] . "'>" . $tupla["denominacion"] . "</option>";
                        }
                        mysqli_free_result($result_asignaturas_faltan);
                        ?>
                    </select>
                    <?php echo "<button type='submit' name='btnCalificar' value='" . $_POST["alumno"] . "'>Calificar</button>"  ?>
                </p>
            </form>
<?php
        } else {
            echo "<p>A <strong>" . $usuario_elegido['nombre'] . "</strong> no le quedan asignaturas por calificar.</p>";
        }

    }

    if (isset($_POST['btnEditar'])) {
        
    }

    if (isset($_POST['btnBorrar'])) {
        echo "<p>¿Quieres borrar la nota de <strong>".$_POST['btnBorrar']."</strong> en <strong>".$_POST['asignatura']."</strong>?</p>";
        ?>
        <form action="admin.php" method="post">
            <?php echo "<button type='submit' name='btnContBorrar' value=''>Borrar</button>"; ?>
            <button type="submit">Volver</button>
        </form>
        <?php
    }
} else {
    echo "<p>En estos momentos no tenemos ningún alumno registrado en la BD</p>";
}

?>