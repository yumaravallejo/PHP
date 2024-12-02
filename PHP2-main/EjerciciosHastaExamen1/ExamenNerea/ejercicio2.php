<?php
// Funciones
function mi_explode($separador, $texto)
{
    $longitud = strlen($texto);
    $i = 0;
    $array = [];
    $resultado = [];
    $palabra = "";
    while ($texto[$i] == $separador && $i < $longitud) {
        $i++;
    }

    if ($i < $longitud) {
        while ($i < $longitud) {
            if (($texto[$i] == $separador && $texto[$i - 1] != $separador && $texto[$i + 1] != $separador) || $i == $longitud - 1) {
                if ($i == $longitud - 1) {
                    $palabra .= $texto[$i];
                }
                $array[] = $palabra;
                $palabra = "";
            } else {
                $palabra .= $texto[$i];
            }
            $i++;
        }
    }
    for ($i = 0; $i < count($array); $i++) {
        $palabra2 = "";
        for ($j = 0; $j < strlen($array[$i]); $j++) {
            if (
                $array[$i][$j] != "a" && $array[$i][$j] != "e" && $array[$i][$j] != "i" && $array[$i][$j] != "o" && $array[$i][$j] != "u" &&
                $array[$i][$j] != "A" && $array[$i][$j] != "E" && $array[$i][$j] != "I" && $array[$i][$j] != "O" && $array[$i][$j] != "U"
            ) {
                $palabra2 .= $array[$i][$j];
            } else {
                break;
            }
        }
        if (strlen($palabra2) == strlen($array[$i])) {
            $resultado[] = $palabra2;
        }
        $palabra2 = "";
    }
    return $resultado;
}
// Control de errores
if (isset($_POST["btnContar"])) {
    $error_form = $_POST["texto"] == "";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Ejercicio 2. Contar Palabras sin las vocales (a,e,i,o,u,A,E,I,O,U)</h1>
    <form action="ejercicio2.php" method="post">
        <p>
            <label for="texto">Introduzca un texto: </label>
            <input type="text" name="texto" id="texto" value="<?php if (isset($_POST["texto"])) echo $_POST["texto"] ?>">
            <?php
            if (isset($_POST["btnContar"]) && $error_form) {
                echo "<span class = 'error'> Campo vacío</span>";
            }
            ?>
        </p>
        <p>
            <label for="sep">Elija el Separador: </label>
            <select name="sep" id="sep">
                <option <?php if (isset($_POST["sep"]) && $_POST["sep"] == ",") echo "selected" ?> value=",">, (coma)</option>
                <option <?php if (isset($_POST["sep"]) && $_POST["sep"] == ";") echo "selected" ?> value=";">; (punto y coma)</option>
                <option <?php if (isset($_POST["sep"]) && $_POST["sep"] == " ") echo "selected" ?> value=" ">&nbsp; (espacio)</option>
                <option <?php if (isset($_POST["sep"]) && $_POST["sep"] == ":") echo "selected" ?> value=":">: (dos puntos)</option>
            </select>
        </p>
        <p>
            <button type="submit" name="btnContar">Contar</button>
        </p>
    </form>
    <?php
    if (isset($_POST["btnContar"]) && !$error_form) {
    ?>
        <h2>Respuesta</h2>
    <?php
        echo "<p>El texto " . $_POST["texto"] . " con el separador " . $_POST["sep"] . " contiene " . count(mi_explode($_POST["sep"], $_POST["texto"])) . " palabras sin vocales.</p>";
    }
    ?>
</body>

</html>