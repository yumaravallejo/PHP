<?php
    function comprobar($array) {
        if ($array[0] == 1 | $array[0] == 2 | $array[0] == 3
         | $array[0] == 4 | $array[0] == 5 | $array[0] == 6 |
         $array[0] == 7 | $array[0] == 8 | $array[0] == 9 | $array[0] == 0 )
        return true;
        else
            return false;
    }

    function comparar ($i, $array, $j) {
        if ($array[$i]===$array[$j]) {
            return true;
        } else {
            return false;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercico 2 - Práctica con Strings</title>
</head>
<body>
    <?php
        if (isset($_POST['comprobador'])) {
            $error_texto = $_POST['texto']=="";
            $error_texto2 = strlen($_POST['texto']) < 3;
            $errores_form = $error_texto || $error_texto2;
        }


        if (isset($_POST['comprobador']) && !$errores_form){
            $texto = trim($_POST['texto']);
            $mitad = floor(strlen($texto)/2);
            $tam = strlen($texto);
            $iguales = 1;

            echo "<h1>Palíndromos / Capícuas - Resultado</h1>";
            for ($i = 0; $i < $mitad ; $i){
                for ($j = $tam-1; $j > $mitad ; $j) {
                    if (comprobar($texto)){
                        //Si es true es número
                        if(comparar($i, $texto, $j)) {
                            $iguales = 1;
                            $i++;
                            $j--;
                        } else {
                            $iguales = 0;
                            echo "<p>No es un número capícua</p>";
                            exit;
                        }
                    } else {
                        //Si es false es letra
                        if(comparar($i, $texto, $j)) {
                            $iguales = 2;
                            $i++;
                            $j--;
                        } else {
                            $iguales = 0;
                            echo "<p>No es un palíndromo</p>";
                            exit;
                        }
                    }
                }  
            }

            if ($iguales == 1) {
                echo "<p>Es un número capícua</p>";
            } else if ($iguales == 2) {
                echo "<p>Es un palíndromo</p>";
            }
        }
    ?>
</body>
</html>