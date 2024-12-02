<?php
// Función para quitar espacios (replace) 
function replace($frase, $aReemplazar, $reemplazo) {
    $replace = "";
    for ($i = 0; $i < strlen($frase); $i++) {
        if ($frase[$i] == $aReemplazar) {
            $replace .= $reemplazo;
        } else {
            $replace .= $frase[$i];
        }
    }
    return $replace;
}
// Controlamos errores
if (isset($_POST['comparar'])) {
    $texto = replace($_POST["texto"], " ", "");
    $l_texto = strlen($texto);
    $error_form = $texto == "";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
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
        <form action="ejercicio3.php" method="post">
            <h2 class="centro">Frases palídromas - Formulario</h2>
            <p>Dime una frase y te diré si es una frase palíndroma</p>
            <p>
                <label for="texto">Frase: </label>
                <input type="text" name="texto" id="texto" value="<?php if (isset($_POST["texto"])) echo $texto ?>">
                <?php
                if (isset($_POST["comparar"]) && $error_form) {
                    echo "<span class = 'error'> Campo vacío </span>";
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
        $texto_m = strtoupper($texto); // Para quitar mayusculas

        $i = 0;
        $j = $l_texto - 1;
        $bien = true;

        while ($i < $j && $bien) {
            if ($texto_m[$i] == $texto_m[$j]) {
                $i++;
                $j--;
            } else {
                $bien = false;
            }
        }

        if ($bien) {
            if (!is_numeric($texto)) {
                $respuesta = "es un palíndromo";
            } else {
                $respuesta = "es un número capicúa";
            }
        } else {
            if (!is_numeric($texto)) {
                $respuesta = "no es un palíndromo";
            } else {
                $respuesta = "no es un número capicúa";
            }
        }

    ?>
        <br /><br />
        <div class="form verde">
            <h2 class="centro">Palíndromos / capicúas - Resultado</h2>
            <p><strong><?php echo $texto ?></strong> <?php echo $respuesta ?></p>
        </div>
    <?php

    }
    ?>
</body>

</html>