<?php
    /*
        ERRORES:
        - Formato de fecha correcto
        - 2numeros / 2numeros / 4numeros
        - que seleccione una fecha valida que exista
    */

    function separador_correcto($fecha) {
        return substr($fecha, 2, 1)=="/" && substr($fecha, 5, 1)=="/";
    }

    function numeros_correctos($fecha) {
        return is_numeric(substr($fecha,0,2)) && is_numeric(substr($fecha,3,2)) && is_numeric(substr($fecha,6,4)); 
    }           

    function validar_fecha($fecha) {
        //MM, DD, YYYY
        return checkdate(substr($fecha,3,2), substr($fecha,0, 2), substr($fecha,6,4));
    }


    if (isset($_POST['enviar'])) {
        $error_fecha1 = $_POST['fecha1'] == "" || strlen($_POST['fecha1']) != 10 ||
            !separador_correcto($_POST['fecha1']) || !numeros_correctos($_POST['fecha1']) ||
            !validar_fecha($_POST['fecha1']);
        $error_fecha2 = $_POST['fecha2'] == "" || strlen($_POST['fecha2']) != 10 ||
        !separador_correcto($_POST['fecha2']) || !numeros_correctos($_POST['fecha2']) ||
        !validar_fecha($_POST['fecha2']);
                        
        $errores_form = $error_fecha1 || $error_fecha2;
    }
?>  



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 - Práctica con fechas</title>
    <style>
        .formulario {background-color: lightblue; border: 1px solid black; padding: 10px;}
        .respuestas {background-color: lightgreen; border: 1px solid black; padding: 10px; margin-top: 10px}
        .centrado {text-align:center;}
        .error {color: red;}
    </style>
</head>
<body>
    <div class="formulario">
        <h1 class="centrado">Fechas - Formulario</h1>
        <form action="Ej1.php" method="post">
            <p>
                <label for="fecha1">Introduzca una fecha: (DD/MM/YYYY) </label><input type="text" id="fecha1" name="fecha1" value="<?php if(isset($_POST['fecha1']) && !$error_fecha1) echo $_POST['fecha1'];?>">
                <?php //Errores
                    if (isset($_POST['enviar']) && $errores_form) {
                        if (trim($_POST['fecha1'] == "")) {
                            echo "<span class='error'>* Rellena este campo *</span>";
                        } else if ($error_fecha1) {
                            echo "<span class='error'>* La fecha no es correcta *</span>";
                        } 
                    }
                ?>
            </p>
            <p>
                <label for="fecha2">Introduzca una fecha: (DD/MM/YYYY) </label><input type="text" id="fecha2" name="fecha2" value="<?php if(isset($_POST['fecha2']) && !$error_fecha2) echo $_POST['fecha2'];?>">
                <?php //Errores
                    if (isset($_POST['enviar']) && $errores_form) {
                        if (trim($_POST['fecha2'] == "")) {
                            echo "<span class='error'>* Rellena este campo *</span>";
                        } else if ($error_fecha2) {
                            echo "<span class='error'>* Fecha no válida *</span>";
                        } 
                    }
                ?>
            </p>
            <p>
                <input type="submit" value="Calcular" name="enviar">
            </p>
        </form>
    </div>
    <?php
    if (isset($_POST['enviar']) && !$errores_form) {
        //Explode -->
        $fecha1_arr = explode("/", $_POST['fecha1']);
        $fecha2_arr = explode("/", $_POST['fecha2']);

        $tiempo1=mktime(0,0,0,$fecha1_arr[1], $fecha1_arr[0], $fecha1_arr[2]);
        $tiempo2=mktime(0,0,0,$fecha2_arr[1], $fecha2_arr[0], $fecha2_arr[2]);

        $dif_segundos=abs($tiempo1 - $tiempo2);
        $segundos_a_dias = $dif_segundos/(60*60*24);
        
        echo "<div class='respuestas'>";
            echo "<h1 class='centrado'>Fechas - Respuestas</h1>";
            echo "<p>La diferencia en días entre las dos fechas introducidas es de: ".floor($segundos_a_dias)."</p>";

        echo "</div>";
    }
    ?>
</body>
</html>