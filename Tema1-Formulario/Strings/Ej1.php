<?php
    if (isset($_POST['comparar'])) {
        $error_primera = trim($_POST['primera'] == "") || strlen($_POST['primera']) < 3 ;
        $error_segunda = trim($_POST['segunda'] == "") || strlen($_POST['segunda']) < 3;
        $errores_form = $error_primera || $error_segunda;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pruebas de apunte</title>
    <style>
        .formulario {background-color: lightblue; border: 1px solid black; padding: 10px;}
        .respuestas {background-color: lightgreen; border: 1px solid black; padding: 10px; margin-top: 10px}
        .centrado {text-align:center;}
        .error {color: red;}
    </style>
</head>
<body>
    <form action="Ej1.php" method="post" class="formulario">
    <h1 class="centrado">Ripios - Formulario</h1>
    <p>Dime dos palabras y te diré si riman o no</p>
        <p>
            <label for="primera">Primera palabra:</label>
            <input type="text" name="primera" id="primera" value="<?php if(isset($_POST['primera'])) echo $_POST['primera'];?>">
            <?php
            if (isset($_POST['primera']) && $errores_form){
                if ($_POST['primera']=="")
                    echo "<span class='error'>* Campo Vacío *</span>";
                elseif (strlen($_POST['primera'])<3)
                    echo "<span class='error'>* Necesitas una palabra de 3 letras mínimo *</span>";
                else
                    echo "No has tecleado solo letras";
            }
            ?>
        </p>

        <p>
            <label for="segunda">Segunda palabra:</label>
            <input type="text" name="segunda" id="segunda" value="<?php if(isset($_POST['segunda'])) echo $_POST['segunda'];?>">
            <?php
                if (isset($_POST['segunda']) && $errores_form){
                    if ($_POST['segunda']=="")
                        echo "<span class='error'>* Campo Vacío *</span>";
                    elseif (strlen($_POST['segunda']) < 3 )
                        echo "<span class='error'>* Necesitas una palabra de 3 letras mínimo *</span>";
                    else
                        echo "No has tecleado solo letras";
                }
            ?>
            </p>

        <p>
            <input type="submit" name="comparar" id="comparar" value="Comparar">
        </p>
    </form>
    <?php
        function riman ($palabra1, $palabra2) {
            $tamano1 = strlen($palabra1);
            $tamano2 = strlen($palabra2);

            if (substr($palabra1 , $tamano1-1) == substr($palabra2 , $tamano2-1)) {
                if (substr($palabra1 , $tamano1-2) == substr($palabra2 , $tamano2-2)){
                    if (substr($palabra1 , $tamano1-3) == substr($palabra2 , $tamano2-3)){
                        return "<p>".$palabra1." y ".$palabra2." riman mucho</p>";
                    } else {
                        return "<p>".$palabra1." y ".$palabra2." riman un poco</p>";
                    }
                } else {
                    return "<p>".$palabra1." y ".$palabra2." no riman nada</p>";
                }
            } else {
                return "<p>".$palabra1." y ".$palabra2." no riman nada</p>";
            }
        }


        if (isset($_POST['comparar']) && !$errores_form) {
            echo "<div class='respuestas'><h1 class='centrado'>Ripios - Resultado</h1>".riman($_POST['primera'], $_POST['segunda'])."</div>";
        }


    ?>
</body>
</html>