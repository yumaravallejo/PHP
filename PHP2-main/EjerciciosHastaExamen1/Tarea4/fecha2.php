<?php
// Controlamos errores
if (isset($_POST['calcular'])) {
    $error_fecha1 = !checkdate($_POST['mes1'], $_POST['dia1'], $_POST['year1']);
    $error_fecha2 = !checkdate($_POST['mes2'], $_POST['dia2'], $_POST['year2']);
    $error_form = $error_fecha1 || $error_fecha2;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fecha 2</title>
    <style>
        .form {
            border: solid;
            padding: 5px;
        }

        .celeste {
            background-color: lightblue;
        }

        .centro {
            text-align: center;
        }

        .error {
            color: red;
        }

        .verde {
            background-color: lightgreen;
        }
    </style>
</head>

<body>
    <div class="form celeste">
        <form action="fecha2.php" method="post">
            <h2 class="centro">Fechas - Formulario</h2>
            <p>Introduzca una fecha</p>
            <p>
                <label for="dia1">Día: </label>
                <select name="dia1" id="dia1">
                    <?php
                    for ($i = 1; $i <= 31; $i++) {
                        if (isset($_POST['calcular']) && $_POST['dia1'] == $i) {
                            echo '<option selected value=' . $i . '>' . sprintf('%02d', $i) . '</option>';
                        } else {
                            echo '<option value=' . $i . '>' . sprintf('%02d', $i) . '</option>';
                        }
                    }
                    ?>
                </select>
                <label for="mes1">Mes: </label>
                <select name="mes1" id="mes1">
                    <?php
                    $array_mes[1] = 'Enero';
                    $array_mes[] = 'Febrero';
                    $array_mes[] = 'Marzo';
                    $array_mes[] = 'Abril';
                    $array_mes[] = 'Mayo';
                    $array_mes[] = 'Junio';
                    $array_mes[] = 'Julio';
                    $array_mes[] = 'Agosto';
                    $array_mes[] = 'Septiembre';
                    $array_mes[] = 'Octubre';
                    $array_mes[] = 'Noviembre';
                    $array_mes[] = 'Diciembre';
                    
                    for ($i = 1; $i <= 12; $i++) {
                        if (isset($_POST['calcular']) && $_POST['mes1'] == $i) {
                        echo '<option selected value=' . $i . '>' . $array_mes[$i] . '</option>';
                        } else {
                            echo '<option value=' . $i . '>' . $array_mes[$i] . '</option>';
                        }
                    }
                    ?>
                </select>
                <label for="year1">Año: </label>
                <select name="year1" id="year1">
                    <?php
                    $anio_actual = date('Y');
                    define('N_ANIOS', 50);
                    for ($i = $anio_actual - N_ANIOS; $i <= $anio_actual; $i++) {
                        if (isset($_POST['calcular']) && $_POST['year1'] == $i) {
                        echo '<option selected value=' . $i . '>' . $i . '</option>';
                        } else {
                            echo '<option value=' . $i . '>' . $i . '</option>';
                        }
                    }
                    ?>
                </select>
                <?php
                    if (isset($_POST['calcular']) && $error_fecha1) {
                        echo "<span class='error'> Fecha no válida </span>";
                    }
                ?>
            </p>
            <p>Introduzca otra fecha</p>
            <p>
                <label for="dia2">Día: </label>
                <select name="dia2" id="dia2">
                    <?php
                    for ($i = 1; $i <= 31; $i++) {
                        if (isset($_POST['calcular']) && $_POST['dia2'] == $i) {
                        echo '<option selected value=' . $i . '>' . sprintf('%02d', $i) . '</option>';
                        } else {
                            echo '<option value=' . $i . '>' . sprintf('%02d', $i) . '</option>';
                        }
                    }
                    ?>
                </select>
                <label for="mes2">Mes: </label>
                <select name="mes2" id="mes2">
                    <?php
                    for ($i = 1; $i <= 12; $i++) {
                        if (isset($_POST['calcular']) && $_POST['mes2'] == $i) {
                        echo '<option selected value=' . $i . '>' . $array_mes[$i] . '</option>';
                        } else {
                            echo '<option value=' . $i . '>' . $array_mes[$i] . '</option>';
                        }
                    }
                    ?>
                </select>
                <label for="year2">Año: </label>
                <select name="year2" id="year2">
                    <?php
                    for ($i = $anio_actual - N_ANIOS; $i <= $anio_actual; $i++) {
                        if (isset($_POST['calcular']) && $_POST['mes2'] == $i) {
                        echo '<option selected value=' . $i . '>' . $i . '</option>';
                        } else {
                            echo '<option value=' . $i . '>' . $i . '</option>';
                        }
                    }
                    ?>
                </select>
                <?php
                    if (isset($_POST['calcular']) && $error_fecha2) {
                        echo "<span class='error'> Fecha no válida </span>";
                    }
                ?>
            </p>
            <p>
                <input type="submit" value="Calcular" name="calcular">
            </p>
        </form>
    </div>
    <?php
    // Resuelvo el problema
    if (isset($_POST["calcular"]) && !$error_form) {
        $tiempo1 = strtotime($_POST['year1'].'/'.$_POST['mes1'].'/'.$_POST['dia1']);
        $tiempo2 = strtotime($_POST['year2'].'/'.$_POST['mes2'].'/'.$_POST['dia2']);

        $dif_segundos = abs($tiempo1 - $tiempo2);
        $dias_pasados = $dif_segundos/(60*60*24);
    ?>
    <br /><br />
        <div class="form verde">
            <h2 class="centro">Fechas - Respuesta</h2>
            <p>La diferencia en días entre las dos fechas es de : <?php echo floor($dias_pasados) ?></p>
        </div>
    <?php
    }
    ?>
</body>

</html>