<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 - Práctica con Strings</title>
</head>
<body>
    <?php
        if (isset($_POST['comprobador'])) {
            $error_texto = $_POST['texto']=="";
            $errores_form = $error_texto;
        }


        if (isset($_POST['comprobador']) && !$errores_form){
            $texto = $_POST['texto'];
            $texto_sin_espacios = str_replace(' ', '', $texto); //Quita los espacios (los reemplaza por sin espacio)
            $texto_al_reves = strrev($texto_sin_espacios); //Le da la vuelta al texto sin espacios
            echo "<h1Frases palíndromas - Resultado</h1>";

            if ($texto_sin_espacios == $texto_al_reves) {
                echo "<p>".$texto." es una frase palíndroma</p>";
            } else {
                echo "<p>".$texto." no es una frase palíndroma</p>";
            }
        }
    ?>
</body>
</html>