<?php
    function todo_l($texto) {
        //Función que comprobará que solo se hayan escrito letras 
        $todo_l = true;
        for ($i = 0; $i<strlen($texto); $i++) {
            if (ord($texto[$i])<ord("A") || ord($texto[$i])>ord("Z"))
            {
                $todo_l = false;
                break;
            }
        }
        return $todo_l;
    }

    function todo_n($texto) {
        //Función que comprobará que solo se hayan escrito letras 
        $todo_n = true;
        for ($i = 0; $i<strlen($texto); $i++) {
            if (ord($texto[$i])<ord("0") || ord($texto[$i])>ord(""))
            {
                $todo_n = false;
                break;
            }
        }
        return $todo_n;
    }

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


    if (isset($_POST['comprobador'])) {
        $error_texto = $_POST['texto']=="";
        $error_texto2 = strlen($_POST['texto']) < 3;
        $error_texto_palabras = todo_l($_POST['texto']) && todo_n($_POST['texto']) ;
        $errores_form = $error_texto || $error_texto2 || $error_texto_palabras;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2 - Práctica con Strings</title>
    <style>
        .centrado {text-align: center;}
        .formulario {background-color: lightblue; border: 1px solid black; padding: 10px}
        .respuestas {background-color: lightgreen; border: 1px solid black; padding: 10px; margin-top: 10px;}
        .error {color:red;}
    </style>
</head>
<body>
    <div class="formulario">
        <h1 class="centrado">Palíndromos / capícuas - Formulario</h1>
        <p>Dime una palabra o un número y te diré si es un palíndromo o un número capícua</p>
        <form action="Ej2.php" method="post">
            <p>
                <label for="segunda">Palabra o número: </label>
                <input type="text" id="texto" name="texto" value="">
                <?php
                if (isset($_POST['comprobador']) && $error_texto) {
                    echo "<span class='error'>* Debes rellenar este campo *</span>";
                } else if (isset($_POST['comprobador']) && $error_texto2) {
                    echo "<span class='error'>* Debes escribir más de 3 caracteres *</span>";
                } else if (isset($_POST['comprobador']) && $error_texto_palabras) {
                    echo "<span class='error'>* Debes escribir solo letras o números *</span>";
                }  
                
                ?> 
            </p>

            

            <p>
                <input type="submit" id="comprobar" name="comprobador" value="Comprobar">
            </p>

        </form>
    </div>

    <?php
    if (isset($_POST['comprobador']) && !$errores_form){
        $texto = trim($_POST['texto']);
        $mitad = floor(strlen($texto)/2);
        $tam = strlen($texto);
        $iguales = 1;

        echo "<div class='respuestas'>";
        echo "<h1 class'centrado'>Palíndromos / Capícuas - Resultado</h1>";
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
        echo "</div>";
    }
    ?>
</body>
</html>