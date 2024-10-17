<?php
    // function todo_l($texto) {
    //     // Expresión regular para letras mayúsculas y minúsculas con o sin tilde
    //     return preg_match('/^[a-zA-ZÁÉÍÓÚÑáéíóúñ]+$/u', $texto);
    // }

    function todo_l($texto) {
        $todo_l = true;
        
        for ($i = 0; $i < strlen($texto); $i++) {
            if (!($texto[$i] >= 'A' && $texto[$i] <= 'Z') || ($texto[$i] >= 'a' && $texto[$i] <= 'z') ||
                  $texto[$i] == 'Á' || $texto[$i] == 'É' || $texto[$i] == 'Í' || $texto[$i] == 'Ó' || $texto[$i] == 'Ú' ||
                  $texto[$i] == 'á' || $texto[$i] == 'é' || $texto[$i] == 'í' || $texto[$i] == 'ó' || $texto[$i] == 'ú' ) {

                $todo_l = false;
                break;
            }
        }
        
        return $todo_l;
    }

    if (isset($_POST['quitar'])) {
        $error_vacio = trim($_POST['texto']=="");
        $error_letras = todo_l($_POST['texto']);
        $errores_form = $error_vacio || $error_letras;
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6 - Práctica con Strings</title>
    <style>
        .formulario {
            background-color: lightblue; 
            padding:10px;
            border: 1px solid black;
        }

        .centrado {text-align: center;}

        .respuestas {
            background-color: lightgreen; 
            padding:10px;
            border: 1px solid black;
            margin-top: 10px;
        }

        .error {color:red;}
    </style>
</head>
<body>
    <div class="formulario">
        <h1 class="centrado">Quita acentos - Formulario</h1>
        <p>Escribe un texto y le quitaré los acentos</p>
        <form action="Ej6.php" method="post">
        <p>
            <label for="texto">Texto: </label>
            <textarea name="texto" id="texto"></textarea>
            <?php //Errores
            if (isset($_POST['texto']) && $errores_form) {
                if (trim($_POST['texto']=="")) {
                    echo "<span class='error'>* Rellena este campo *</span>";
                } else if (todo_l($_POST['texto'])) {
                    echo "<span class='error'>* Introduce solo texto *</span>";
                }
            } 
            ?>
        </p>
        <p>
            <input type="submit" value="Quitar acentos" name="quitar">
        </p>
        </form>
    </div>
    <?php
    if (isset($_POST['quitar']) && !$errores_form) {
        echo"<div class='respuestas'>";
        echo "<h1 class='centrado'>Quitar acentos - Resultado</h1>";

        $tildes = array("á"=>"a", "é"=>"e", "í"=>"i", "ó"=>"o", "ú"=>"u", 
        "Á"=>"A", "É"=>"E", "Í"=>"I", "Ó"=>"O", "Ú"=>"U");
        $texto = $_POST['texto'];
        $texto_sin_tilde = strtr($texto, $tildes); //Cambia el texto pasándole un array loquecambia=>porloquelocambia
        echo "<dl>";
            echo "<dt>Texto original</dt>";
                echo "<dd>".$texto."</dd>";

            echo "<dt>Texto sin acentos</dt>";
                echo "<dd>".$texto_sin_tilde."</dd>";
        
        echo "</dl>";
        echo"</div>";
    }
    ?>
</body>
</html>