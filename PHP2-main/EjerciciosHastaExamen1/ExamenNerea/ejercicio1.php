<?php
// Funciones
function primeraLinea()
{
    $texto = "Letra/Desplazamiento;";
    for ($i = 1; $i <= 26; $i++) {
        $texto .= $i . ";";
    }
    return $texto;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>

<body>
    <h1>Ejercicio 1. Generador de "claves_cesar.txt"</h1>
    <form action="ejercicio1.php" method="post">
        <button type="submit" name="btnGenerar">Generar</button>
    </form>
    <?php
    if (isset($_POST["btnGenerar"])) {
        @$fd = fopen("claves_cesar.txt", "w+");

        if (!$fd) {
            echo "<p>Error al generar el fichero</p>";
        }

        $linea = fwrite($fd, primeraLinea());
        $letras = [];
        for ($i = ord("A"); $i <= ord("Z"); $i++) {
            $letras[] = chr($i);
        }
        for ($i = 0; $i < count($letras); $i++) {
            $linea = fwrite($fd, PHP_EOL . $letras[$i] . ";");
            if ($i < count($letras) - 1) {
                $k = $i + 1;
            } else {
                $k = 0;
            }

            for ($j = 0; $j <= count($letras); $j++) {
                if ($j == ((count($letras) - 1) - ($i))) {
                    $k = 0;
                } else {
                    $linea = fwrite($fd, $letras[$k] . ";");
                    $k++;
                }
            }
        }


        $respuesta = "";
        fseek($fd, 0);
        while ($linea1 = fgets($fd)) {
            $respuesta .= $linea1;
        }


        fclose($fd);

    ?>
        <h2>Respuesta</h2>
        <textarea name="texto" id="texto" cols="30" rows="10"><?php echo $respuesta ?></textarea>
    <?php

    }
    ?>
</body>

</html>