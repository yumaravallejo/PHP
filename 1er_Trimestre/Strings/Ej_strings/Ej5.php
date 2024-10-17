<?php 
    /*
        Comprobar errores:
        - Número inferior a 5000;
        - Que todo sean números;
        - Que no se quede en blanco;
    */

    function todo_n($texto) {
        return ctype_digit($texto);
    }

    if (isset($_POST['convertir'])) {
        $error_vacio = $_POST['numero']=="";
        $error_numeros = !todo_n($_POST['numero']);
        $error_numero_mayor = $_POST['numero']>=5000;
        $errores_form = $error_vacio || $error_numeros || $error_numero_mayor;
    }    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5 - Práctica con strings</title>
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
        <h1 class="centrado">Árabes a romanos - Formulario</h1>
        <p>Dime un número y lo convertiré a números romanos</p>
        <form action="Ej5.php" method="post">
        <p>
            <label for="numero">Número: </label>
            <input type="text" name="numero" value="" id="numero">
            <?php //Errores
            if (isset($_POST['numero']) && $errores_form) {
                if (trim($_POST['numero'] =="")) {
                    echo "<span class='error'>* Rellena este campo *</span>";
                } else if (!todo_n($_POST['numero'])) {
                    echo "<span class='error'>* Debes escribir solo números *</span>";
                } else if ($_POST['numero']>5000) {
                    echo "<span class='error'>* El número debe ser menor de 5000 *</span>";
                } else {
                    //Saber que algo va mal con los errores, si esto pasa la he cagado yo xd
                    echo "<span class='error'>* Todo mal *</span>";
                }
            } 
            ?>
        </p>
        <p>
            <input type="submit" value="Convertir" name="convertir">
        </p>
        </form>

    </div>
    
    <?php
    if (isset($_POST['convertir']) && !$errores_form) {
        echo"<div class='respuestas'>";
        echo "<h1 class='centrado'>Árabes a romanos - Resultado</h1>";
        $array_romanos = [];
        $texto = $_POST['numero'];
        $resultado = $texto;
        while ($resultado > 0) {
            if ($resultado>=1000) {
                $array_romanos[] = "M";
                $resultado -= 1000;
            } else if ($resultado>=500) {
                $array_romanos[] = "D";
                $resultado -= 500;
            } else if ($resultado>=100) {
                $array_romanos[] = "C";
                $resultado -= 100;
            } else if ($resultado>=50) {
                $array_romanos[] = "L";
                $resultado -= 50;
            } else if ($resultado>=10) {
                $array_romanos[] = "X";
                $resultado -= 10;
            } else if ($resultado>=5) {
                $array_romanos[] = "V";
                $resultado -= 5;
            } else if ($resultado>=1) {
                $array_romanos[] = "I";
                $resultado -= 1;
            }
        }

        $numero_romano = implode("", $array_romanos);

        echo "<p>El número ".$texto." en números romanos es ".$numero_romano."</p>";
        echo"</div>";
    }
    ?>
</body>
</html>