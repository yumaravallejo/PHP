<?php
// Controlamos errores
if (isset($_POST['comparar'])) {
    $primera = trim($_POST['primera']);
    $segunda = trim($_POST['segunda']);
    $l_primera = strlen($primera);
    $l_segunda = strlen($segunda);
    $error_primera = $primera == "" || $l_primera < 3;
    $error_segunda = $segunda == "" || $l_segunda < 3;
    $error_form = $error_primera || $error_segunda;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
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

        .rojo {
            color: red;
        }

        .verde {
            background-color: lightgreen;
        }
    </style>
</head>

<body>
    <div class="form celeste">
        <form action="ejercicio1.php" method="post">
            <h2 class="centro">Ripios - Formulario</h2>
            <p>
                <label for="primera">Primera palabra: </label>
                <input type="text" name="primera" id="primera" value="<?php if (isset($_POST["primera"])) echo $primera ?>">
                <?php
                if (isset($_POST["comparar"]) && $error_primera) {
                    if ($primera == '') {
                        echo "<span class = 'error'> Campo vacío </span>";
                    } else {
                        echo "<span class = 'error'> Debes teclear al menos tres caracteres </span>";
                    }
                }
                ?>
            </p>
            <p>
                <label for="segunda">Segunda palabra: </label>
                <input type="text" name="segunda" id="segunda" value="<?php if (isset($_POST["segunda"])) echo $segunda ?>">
                <?php
                if (isset($_POST["comparar"]) && $error_segunda) {
                    if ($segunda == '') {
                        echo "<span class = 'error'> Campo vacío </span>";
                    } else {
                        echo "<span class = 'error'> Debes teclear al menos tres caracteres </span>";
                    }
                }
                ?>
            </p>
            <p>
                <input type="submit" value="Comparar" name="comparar">
            </p>
        </form>
    </div>
    <?php
    if (isset($_POST["comparar"]) && !$error_form) {
        $primera_m = strtoupper($primera); // Para quitar mayusculas
        $segunda_m = strtoupper($segunda);

        $respuesta = "no riman";
        if (
            $primera_m[$l_primera - 1] == $segunda_m[$l_segunda - 1] &&
            $primera_m[$l_primera - 2] == $segunda_m[$l_segunda - 2]
        ) {
            $respuesta = "riman un poco";
            if ($primera_m[$l_primera - 3] == $segunda_m[$l_segunda - 3]) {
                $respuesta = "riman";
            }
        }
    ?>
        <br /><br />
        <div class="form verde">
            <h2 class="centro">Ripios - Respuesta</h2>
            <p>Las palabras <strong><?php echo $primera ?></strong> y <strong><?php echo $segunda ?></strong> <?php echo $respuesta ?></p>
        </div>
    <?php

    }
    ?>
</body>
</html>