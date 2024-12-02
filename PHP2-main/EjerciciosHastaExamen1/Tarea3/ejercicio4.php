<?php

const VALOR = array("M" => 1000, "D" => 500, "C" => 100, "L" => 50, "X" => 10, "V" => 5, "I" => 1);

// Función para controlar que las letras son romanas
function letras_bien($texto)
{
    $bien = true;
    for ($i = 0; $i < strlen($texto); $i++) {
        if (!isset(VALOR[$texto[$i]])) {
            $bien = false;
            break;
        }
    }
    return $bien;
}

// Función para controlar el orden romano
function orden_bueno($texto)
{
    $bien = true;
    for ($i = 0; $i < strlen($texto) - 1; $i++) {
        if (VALOR[$texto[$i]] < VALOR[$texto[$i + 1]]) {
            $bien = false;
            break;
        }
    }
    return $bien;
}

// Función para controlar la repetición de cada letra romana
function repite_bien($texto)
{
    $bien = true;
    $veces = array("M" => 4, "D" => 1, "C" => 4, "L" => 1, "X" => 4, "V" => 1, "I" => 4);
    for ($i = 0; $i < strlen($texto); $i++) {
        $veces[$texto[$i]]--;
        if ($veces[$texto[$i]] == -1) {
            $bien = false;
            break;
        }
    }
    return $bien;
}

// Función para controlar escritura romana
function es_correcto_romano($texto)
{
    return letras_bien($texto) && orden_bueno($texto) && repite_bien($texto);
}

// Controlamos errores
if (isset($_POST['convertir'])) {
    $numero = trim($_POST["numero"]);
    $numero_m = strtoupper($numero);
    $error_form = $numero == "" || !es_correcto_romano($numero_m);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
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
        <form action="ejercicio4.php" method="post">
            <h2 class="centro">Romanos a árabes - Formulario</h2>
            <p>Dime un número en números romanos y lo convertiré a cifras árabes</p>
            <p>
                <label for="numero">Número: </label>
                <input type="text" name="numero" id="numero" value="<?php if (isset($_POST["numero"])) echo $numero ?>">
                <?php
                if (isset($_POST["convertir"]) && $error_form) {
                    if ($numero_m == "") {
                        echo "<span class = 'error'> Campo vacío </span>";
                    } else {
                        echo "<span class = 'error'> El número introducido no está escrito correctamente </span>";
                    }
                }
                ?>
            </p>
            <p>
                <input type="submit" value="Convertir" name="convertir">
            </p>
        </form>
    </div>
    <?php
    if (isset($_POST["convertir"]) && !$error_form) {
        $respuesta = 0;
        for ($i = 0; $i < strlen($numero); $i++) {
            $respuesta += VALOR[$numero_m[$i]];
        }
    ?>
        <br /><br />
        <div class="form verde">
            <h2 class="centro">Romanos a árabes - Resultado</h2>
            <p><?php echo "El número <strong>".$numero?></strong> <?php echo " se escribe en cifras árabes ".$respuesta ?></p>
        </div>
    <?php

    }
    ?>

</body>

</html>