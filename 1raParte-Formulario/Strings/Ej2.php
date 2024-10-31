<?php
    function todo_l($texto) {
        //Función que comprobará que solo se hayan escrito letras 
        $todo_l = true;
        for ($i = 0; $i<strlen($texto); $i++) {
            if ($texto[$i]<ord("A") || ord($texto[$i])>ord("z"))
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
            if (!is_numeric($texto[$i]))
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
        $errores_form = $error_texto || $error_texto2 || (!todo_l($_POST['texto']) && !todo_n($_POST['texto']));
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
                if (isset($_POST['comprobador']) && $errores_form){
                    if ($_POST['texto']=="") {
                        echo "<span class='error'>* Debes rellenar este campo *</span>";
                    } else if (strlen($_POST['texto']) < 3) {
                        echo "<span class='error'>* Debes escribir más de 3 caracteres *</span>";
                    } else if ((!todo_l($_POST['texto']) && !todo_n($_POST['texto']))) {
                        echo "<span class='error'>* Debes escribir solo letras o números *</span>";
                    }  
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
        echo "<div class='respuestas'>";
        echo "<h1 class'centrado'>Palíndromos / Capícuas - Resultado</h1>";
        
        //Creamos las variables que vamos a usar
        $texto = trim($_POST['texto']);
        //Variables de posición del texto
        $i = 0;
        $j=strlen($texto)-1;
        //Variable que verá si son iguales o no
        $iguales = true;
        while ($i < $j) {
            if ($texto[$i] != $texto[$j]) {
                //Si entra en el if será que no son iguales y cambiará
                $iguales = false;
                break;
            }
            $i++;
            $j--;
        }

        if ($iguales && todo_n($texto)) {
            echo "<p>Es un número capícua</p>";
        } else if ($iguales && todo_l($texto)) {
            echo "<p>Es un palíndromo</p>";
        } else if (!$iguales && todo_l($texto)) {
            echo "<p>No es un palíndromo</p>";
        } else {
            echo "<p>No es un número capícua</p>";
        }
        echo "</div>";
    }
    ?>
</body>
</html>