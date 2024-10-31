<?php
// Funciones
function mi_explode($separador, $texto)
{
    $array = array();
    $j = 0;
    $long_texto = mi_strlen($texto);
    while ($j < $long_texto && $texto[$j] == $separador)
        $j++;

    if ($j < $long_texto) {
        $cont = 0;
        $array[$cont] = $texto[$j];
        $j++;
        while ($j < $long_texto) {
            if ($texto[$j] != $separador) {
                $array[$cont] .= $texto[$j];
                $j++;
            } else {
                $j++;
                while ($j < $long_texto && $texto[$j] == $separador)
                    $j++;

                if ($j < $long_texto) {
                    $cont++;
                    $array[$cont] = $texto[$j];
                    $j++;
                }
            }
        }
    }
    return $array;
}
function mi_strlen($texto)
{
    $cont = 0;
    while (isset($texto[$cont])) {
        $cont++;
    }
    return $cont;
}
/*
function decodifica($texto)
{
    $resultado = "";
    $num = [];
    for ($i = 0; $i < mi_strlen($texto); $i++) {
        if (count($num) == 2) {
            $resultado .= decodifica2($num);
            $num = [];
            $i--;
        } else if ($texto[$i] >= '0' && $texto[$i] <= '5' && count($num) < 2) {
            $num[] = $texto[$i];
        } else {
            $resultado .= $texto[$i];
        }
    }
    return $resultado;
}

function decodifica2($num)
{
    if ($num != 00) {
        @$fd = fopen($_FILES["archivo"]["tmp_name"], "r");
        $fila = $num[0];
        $i = 0;
        $linea = fgets($fd);
        while ($i != $fila) { // Mientras esa asignación tenga éxito (no sea false)
            $linea = fgets($fd);
            $i++;
        }
        $letras = explode(";", $linea);
        $columna = $letras[$num[1]];
        fclose($fd);
        return $columna;
    } else {
        return "J";
    }
}
    */

    function todo_numeros($texto) {
        $correcto = true;
        for ($i=0; $i<strlen($texto); $i++) {
            if (!is_numeric($texto[$i])) {
                $correcto = false;
            } 
        }
        return $correcto;
    }

    function decodificar($texto) {
        $texto_descodificado = "";
        $array_numeros = [];
        $contador = 0;
        $posicion = "";
        for ($i=0; $i<strlen($texto); $i++){
            if ($contador != 2) {
                $posicion.=$texto[$i];
                $contador++;
            } else {
                $array_numeros[] = $posicion;
                $posicion = "";
                $contador = 0;
                $posicion.=$texto[$i];
                $contador++;
            }
        }

        if ($posicion != "") {
            $array_numeros[] = $posicion;
        }

        //Si queda algo en posición significa que no es par, así que no hay que añadirlo porque nos falta una coordenada
        
        @$archivo = fopen("claves_polybios.txt", "r") or die("No se ha podido abrir el fichero 'claves_polybios.txt'");

        for ($i = 0; $i < count($array_numeros); $i++) {
            //Nos posicionamos al principio
            fseek($archivo, 0);
            //Nos saltamos la primera línea
            $linea = fgets($archivo);

            $contenido = $array_numeros[$i];
            for ($j = 1; $j <= $contenido[0]; $j++){
                //Nos posicionamos en la línea del archivo
                $linea = fgets($archivo);
            }

            $arr_linea = mi_explode(";", $linea);

            $texto_descodificado.=$arr_linea[$contenido[1]];
            
        }

        fclose($archivo);
        return $texto_descodificado;

    }
// Control de errores
if (isset($_POST["btnDecodificar"])) {
    $error_texto = $_POST["texto"] == "";
    $error_tama = mi_strlen($_POST['texto']) < 2;
    $error_fichero = $_FILES["archivo"]["type"] != "text/plain" || $_FILES["archivo"]["size"] >= 125000000
        || $_FILES["archivo"]["name"] == "";
    $error_form = $error_texto || $error_fichero || $error_tama || !todo_numeros($_POST['texto']);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Ejercicio 3. Decodifica una frase</h1>
    <form action="ejercicio3.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="texto">Introduzca un Texto: </label>
            <input type="text" name="texto" id="texto" value="<?php if (isset($_POST["texto"])) echo $_POST["texto"] ?>">
            <?php
            if (isset($_POST["btnDecodificar"]) && $error_texto) {
                echo "<span class = 'error'> Campo vacío</span>";
            }
            ?>
        </p>
        <p>
            <label for="archivo">Seleccione el archivo de claves (.txt y menor de 1'25MB) </label>
            <input type="file" name="archivo" id="archivo" accept=".txt">
            <?php
            if (isset($_POST["btnDecodificar"]) && $error_fichero) {
                if ($_FILES["archivo"]["name"] == "") {
                    echo "<span class = 'error'> *</span>";
                } else if ($_FILES["archivo"]["type"] != "text/plain") {
                    echo "<span class = 'error'> El archivo seleccionado no es un texto plano.</span>";
                } else {
                    echo "<span class = 'error'> El archivo seleccionado es mayor o igual a 1'25.</span>";
                }
            }
            ?>
        </p>
        <p>
            <button type="submit" name="btnDecodificar">Decodificar</button>
        </p>
    </form>
    <?php
    if (isset($_POST["btnDecodificar"]) && !$error_form) {
        echo "<h2>Respuesta</h2>";
        echo "<p>El texto introducido decodificado sería:</p>";
        echo "<p>" . decodificar($_POST["texto"]) . "</p>";
    }
    ?>
</body>

</html>