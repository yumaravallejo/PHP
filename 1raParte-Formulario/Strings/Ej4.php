<?php
    function solo_romanos($texto) {
        $todo_n = false;
        $texto = strtoupper($texto);
        for ($i = 0; $i<strlen($texto); $i++){
            if ($texto[$i]=="M") {
                $todo_n = true;
            } else if ($texto[$i]=="D") { 
                $todo_n = true;
            } else if ($texto[$i]=="C") {
                $todo_n = true;
            } else if ($texto[$i]=="L") {
                $todo_n = true;
            } else if ($texto[$i]=="X") {
                $todo_n = true;
            } else if ($texto[$i]=="V") {
                $todo_n = true;
            } else if ($texto[$i]=="I") {
                $todo_n = true;
            } else {
                $todo_n = false;
                break;
            }
        }
        return $todo_n;
    }

    function orden_romanos($texto) {
        if ($texto != "") {
            $orden = true;
            $array_numeros;
            for ($i = 0; $i<strlen($texto); $i++) {
                //Metemos en un array todos los valores para comprobar si son mayores o no
                $array_numeros[] = valores_asignados(strtoupper($texto[$i]));
            }
            
            for ($i = 0; $i < count($array_numeros)-1; $i){
                if ($array_numeros[$i]>=$array_numeros[$i+1]) {
                    $i++;
                } else {
                    $orden=false;
                    break;
                }
            }
            return $orden;
        } else {
            return 0;
        }
        
    }

    function valores_asignados($letra) {
        if ($letra=="M") {
            return 1000;
        } else if ($letra=="D") {
            return 500;
        } else if ($letra=="C") {
            return 100;
        } else if ($letra=="L") {
            return 50;
        } else if ($letra=="X") {
            return 10;
        } else if ($letra=="V") {
            return 5;
        } else if ($letra=="I") {
            return 1;
        } else {
            return 0;
        }

        

    }

    function repite_bien($texto) {
        $texto = strtoupper($texto);
        $cont = array("M"=>4, "D"=>1, "C"=>4, "L"=>1, "X"=>4, "V"=>1, "I"=>4);

        $correcto = true;
        for ($i = 0; $i<strlen($texto); $i++) {
            if (isset($cont[$texto[$i]])) {
                $cont[$texto[$i]]--;
                if ($cont[$texto[$i]]<0) {
                    $bueno = false;
                    break;
                }
            }
        }
        return $correcto;
    }


    if (isset($_POST['convertir'])) {
        $error_vacio = trim($_POST['numero']=="");
        $error_no_numeros = !solo_romanos($_POST['numero']);
        $error_no_orden = !orden_romanos($_POST['numero']);
        $cantidad_num = !repite_bien($_POST['numero']);
        $errores_form = $error_vacio || $error_no_numeros || $error_no_orden || $cantidad_num; 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4 - Práctica con strings</title>
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
        <h1 class="centrado">Romanos a árabes - Formulario</h1>
        <p>Dime un número en números romanos y lo convertiré a cifras árabes</p>
        <form action="Ej4.php" method="post">
        <p>
            <label for="numero">Número: </label>
            <input type="text" name="numero" value="" id="numero">
            <?php //Errores
            if (isset($_POST['numero']) && $errores_form) {
                if (trim($_POST['numero'] == "")) {
                    echo "<span class='error'>* Rellena este campo *</span>";
                } else if (!solo_romanos($_POST['numero'])) {
                    echo "<span class='error'>* Debes escribir solo números romanos *</span>";
                } else if (!orden_romanos($_POST['numero'])) {
                    echo "<span class='error'>* Debes escribirlo en el orden correcto *</span>";
                } else if (!repite_bien($_POST['numero'])) {
                    echo "<span class='error'>* Debes escribir una cantidad correcta *</span>";
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
        echo "<h1 class='centrado'>Romanos a árabes - Respuestas</h1>";
        $valor_final = 0;
        $numeros = $_POST['numero'];
        for ($i = 0; $i<strlen($numeros); $i++) {
            $valor_final += valores_asignados($numeros[$i]);
        }
        echo "<p>El número romano ".$numeros." corresponde con el número árabe ".$valor_final."</p>";
        echo"</div>";
    }
    ?>
</body>
</html>