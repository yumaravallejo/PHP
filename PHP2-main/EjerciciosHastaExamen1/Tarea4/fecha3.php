<?php
// Controlamos errores
if (isset($_POST['calcular'])) {
    $error_primera = $_POST['primera'] == '';
    $error_segunda = $_POST['segunda'] == '';
    $error_form = $error_primera || $error_segunda;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fecha 3</title>
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
        <form action="fecha3.php" method="post">
            <h2 class="centro">Fechas - Formulario</h2>
            <p>
                <label for="primera">Introduzca una fecha: </label>
                <input type="date" name="primera" id="primera" value="<?php if (isset($_POST["primera"])) echo $_POST["primera"] ?>">
                <?php
                if (isset($_POST["calcular"]) && $error_primera) {
                        echo "<span class = 'error'> No has seleccionado una fecha </span>";
                }
                ?>
            </p>
            <p>
                <label for="segunda">Introduzca una fecha: </label>
                <input type="date" name="segunda" id="segunda" value="<?php if (isset($_POST["segunda"])) echo $_POST["segunda"] ?>">
                <?php
                if (isset($_POST["calcular"]) && $error_segunda) {
                        echo "<span class = 'error'> No has seleccionado una fecha </span>";
                }
                ?>
            </p>
            <p>
                <input type="submit" value="Calcular" name="calcular">
            </p>
        </form>
    </div>
    <?php
    if (isset($_POST["calcular"]) && !$error_form) {
        $tiempo1 = strtotime($_POST['primera']);
        $tiempo2 = strtotime($_POST['segunda']);

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