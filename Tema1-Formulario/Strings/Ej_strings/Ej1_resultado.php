<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 - Práctica con Strings</title>
</head>
<body>
        <?php

        if (isset($_POST['comparador'])) {
            $error_primera = $_POST['primera']=="";
            $error_segunda = $_POST['segunda']=="";
            $errores_form = $error_primera || $error_segunda;
        }

            if (isset($_POST['comparador']) && !$errores_form) {
                //Si se ha pulsado el botón de comparar
                $palabra1 = $_POST['primera'];
                $palabra2 = $_POST['segunda'];

                // $string1="Este es el texto de prueba";
                // $string1[6]="X";
                // echo $string1;
                //CUENTAN LOS ESPACIOS

                $tam1 = strlen($palabra1) - 1;
                $tam2 = strlen($palabra2) - 1;

                if ($palabra1[$tam1] == $palabra2[$tam2]){
                    //La última es igual
                    if ($palabra1[$tam1-1] === $palabra2[$tam2-1]){
                        //La penúltima también es igual
                        if ($palabra1[$tam1-2] === $palabra2[$tam2-2]){
                            echo "<p>".$palabra1." y ".$palabra2." riman mucho</p>";

                        } else {
                            //Coinciden las dos últimas
                            echo "<p>".$palabra1." y ".$palabra2." riman un poco</p>";

                        }
                    } else {
                        echo "<p>".$palabra1." y ".$palabra2." no riman</p>";
                        //Solo 1 coincide
                    }
                } else {
                    echo "<p>".$palabra1." y ".$palabra2." no riman</p>";
                    //No coincide ninguna
                }
                
            } 
        ?>
</body>
</html>