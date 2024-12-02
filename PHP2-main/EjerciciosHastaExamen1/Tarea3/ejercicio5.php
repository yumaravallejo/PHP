<?php

const VALOR = array("M" => 1000, "D" => 500, "C" => 100, "L" => 50, "X" => 10, "V" => 5, "I" => 1);

// Controlamos errores
if (isset($_POST['convertir'])) {
    $numero = trim($_POST["numero"]);
    $error_form = $numero == "" || !is_numeric($numero) || $numero >= 5000 || $numero <= 0 ;
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
        <form action="ejercicio5.php" method="post">
            <h2 class="centro">Árabes a romanos - Formulario</h2>
            <p>Dime un número y lo convertiré a números romanos</p>
            <p>
                <label for="numero">Número: </label>
                <input type="text" name="numero" id="numero" value="<?php if (isset($_POST["numero"])) echo $numero ?>">
                <?php
                if (isset($_POST["convertir"]) && $error_form) {
                    if ($numero== "") {
                        echo "<span class = 'error'> Campo vacío </span>";
                    } else if ($numero >= 5000 || $numero <= 0) {
                        echo "<span class = 'error'> El número tiene que ser menor de 5000 y mayor de 0</span>";
                    } else {
                        echo "<span class = 'error'> No has introducido un número </span>";
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
        $respuesta = "";
        $veces = array("M" => 4, "D" => 1, "C" => 4, "L" => 1, "X" => 4, "V" => 1, "I" => 4);
        for ($i = $numero; $i > 0; $i) {
            if ($i >= 1000 && $veces["M"] > 0) {
                $respuesta .= "M";
                $veces["M"] -= 1;
                $i -= 1000;
            } else if ($i >= 500 && $veces["D"] > 0) {
                $respuesta .= "D";
                $veces["D"] -= 1;
                $i -= 500;
            } else if ($i >= 100 && $veces["C"] > 0) {
                $respuesta .= "C";
                $veces["C"] -= 1;
                $i -= 100;
            } else if ($i >= 50 && $veces["L"] > 0) {
                $respuesta .= "L";
                $veces["L"] -= 1;
                $i -= 50;
            } else if ($i >= 10 && $veces["X"] > 0) {
                $respuesta .= "X";
                $veces["X"] -= 1;
                $i -= 10;
            } else if ($i >= 5 && $veces["V"] > 0) {
                $respuesta .= "V";
                $veces["V"] -= 1;
                $i -= 5;
            } else {
                $respuesta .= "I";
                $i -= 1;
            }
        }
        
    ?>
        <br /><br />
        <div class="form verde">
            <h2 class="centro">Romanos a árabes - Resultado</h2>
            <p><?php echo "El número <strong>".$numero?></strong> <?php echo " se escribe en números romanos ".$respuesta ?></p>
        </div>
    <?php

    }
    ?>

</body>

</html>