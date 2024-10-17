<?php
     
    function todo_l ($texto) {
        $todo_l = true;
        for ($i = 0; $i<strlen($texto); $i++) {
            if (ord($texto[$i])<ord("A") || ord($texto[$i])>ord("z")) {
                $todo_l = false;
                break;
            }
        }
        return $todo_l;
    }

    if (isset($_POST['comprobar'])) {
        $texto_sin_espacio = strtoupper(str_replace(" ", "", $_POST['texto']));
        $error_texto = trim($_POST['texto'] == "");
        $error_texto2 = strlen($_POST['texto']) < 3;
        $errores_form = $error_texto || $error_texto2 || !todo_l($texto_sin_espacio);
      
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frases palíndromos</title>
    <style>
        .centrado  {
            text-align:center;
        }
        .form {
            background-color: lightblue;
            padding: 10px;
            border: 1px solid black;
        }

        .resultado {
            margin-top: 10px;
            border: 1px solid black;
            background-color: lightgreen;
            padding: 10px;
        }

        .error {
            color: red;
        }

    </style>
</head>
<body>
    <div class="form">
        <h1 class="centrado">Frases palíndromas - Formulario</h1>
        <p>Dime una frase y te diré si es una frase palíndroma</p>

        <form action="Ej3.php" method="post">
            <p>
                <label for="texto">Frase:</label>
                <input type="text" name="texto" value="" id="texto">
                <?php
                    if (isset($_POST['comprobar']) && $errores_form){
                        if ($_POST['texto']=="") {
                            echo "<span class='error'>* Debes rellenar este campo *</span>";
                        } else if (strlen($_POST['texto']) < 3) {
                            echo "<span class='error'>* Debes escribir más de 3 caracteres *</span>";
                        } else if (!todo_l($texto_sin_espacio)) {
                            echo "<span class='error'>* Introduce valores correctos *</span>";
                        } else {
                            echo "<span class='error'>* Algo has hecho *</span>";
                        }
                    } 
                ?>
            </p>

            <p>
                <input type="submit" name="comprobar" value="Comprobar">
            </p>
        </form>
    </div>

    <?php
        //Forma 1 - con bucles
        if (isset($_POST['comprobar']) && !$errores_form){
            echo "<div class='resultado'>";
            echo "<h1 class'centrado'>Palíndromos / Capícuas - Resultado</h1>";
            
            // //Creamos las variables que vamos a usar
            $texto = $texto_sin_espacio;
            // //Variables de posición del texto
            // $i = 0;
            // $j=strlen($texto)-1;
            // //Variable que verá si son iguales o no
            // $iguales = true;
            // while ($i < $j) {
            //     if ($texto[$i] != $texto[$j]) {
            //         //Si entra en el if será que no son iguales y cambiará
            //         $iguales = false;
            //         break;
            //     }
            //     $i++;
            //     $j--;
            // }

            // if ($iguales) {
            //     echo "<p>Esta frase es un a frase palíndroma</p>";
            // } else {
            //     echo "<p>Esta frase no es un a frase palíndroma</p>";
            // }

            //Forma 2 - con funciones de string
            $texto_al_reves = strrev($texto);
            // echo $texto;
            // echo "<br>";
            // echo $texto_al_reves;
            if ($texto == $texto_al_reves) {
                echo "<p>Esta frase es un a frase palíndroma</p>";
            } else {
                echo "<p>Esta frase no es una frase palíndroma</p>";
            }
    
            echo "</div>";
        }

        
    ?>

    <!-- <div class="resultado"></div> -->
</body>
</html>