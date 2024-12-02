<?php
// Controlamos errores
if (isset($_POST['calcular'])) {
    $primera = trim($_POST['primera']);
    $segunda = trim($_POST['segunda']);

    $buenos_separadores1 = substr($primera, 2, 1) == "/" && substr($primera, 5, 1) == "/";
    $array_primera = explode('/', $primera);
    $numeros_buenos1 = is_numeric($array_primera[0]) && is_numeric($array_primera[1]) && is_numeric($array_primera[2]);
    
    $buenos_separadores2 = substr($segunda, 2, 1) == "/" && substr($segunda, 5, 1) == "/";
    $array_segunda = explode('/', $segunda);
    $numeros_buenos2 = is_numeric($array_segunda[0]) && is_numeric($array_segunda[1]) && is_numeric($array_segunda[2]);

    $error_primera = $primera == "" || strlen($primera) != 10 || !$buenos_separadores1 || !$numeros_buenos1 || !checkdate($array_primera[1], $array_primera[0], $array_primera[2]);
    $error_segunda = $segunda == "" || strlen($segunda) != 10 || !$buenos_separadores2 || !$numeros_buenos2 || !checkdate($array_segunda[1], $array_segunda[0], $array_segunda[2]);
    $error_form = $error_primera || $error_segunda;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fecha 1</title>
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
        <form action="fecha1.php" method="post">
            <h2 class="centro">Fechas - Formulario</h2>
            <p>
                <label for="primera">Introduzca una fecha (DD/MM/YYYY): </label>
                <input type="text" name="primera" id="primera" value="<?php if (isset($_POST["primera"])) echo $primera ?>">
                <?php
                if (isset($_POST["calcular"]) && $error_primera) {
                    if ($primera == '') {
                        echo "<span class = 'error'> Campo vacío </span>";
                    } else {
                        echo "<span class = 'error'> Debes teclear una fecha válida </span>";
                    }
                }
                ?>
            </p>
            <p>
                <label for="segunda">Introduzca una fecha (DD/MM/YYYY): </label>
                <input type="text" name="segunda" id="segunda" value="<?php if (isset($_POST["segunda"])) echo $segunda ?>">
                <?php
                if (isset($_POST["calcular"]) && $error_segunda) {
                    if ($segunda == '') {
                        echo "<span class = 'error'> Campo vacío </span>";
                    } else {
                        echo "<span class = 'error'> Debes teclear una fecha válida </span>";
                    }
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
        $fecha1=explode("/",$_POST["primera"]);
        $fecha2=explode("/",$_POST["segunda"]);

        $tiempo1 = mktime(0,0,0,$fecha1[1],$fecha1[0],$fecha1[2]);
        $tiempo2 = mktime(0,0,0,$fecha2[1],$fecha2[0],$fecha2[2]);

        $dif_segundos = abs($tiempo1 - $tiempo2);
        $dias_pasados = floor($dif_segundos/(60*60*24));
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