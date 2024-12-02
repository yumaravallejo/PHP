<?php
function mi_strlen($texto) {
    $cont = 0;
    while (isset($texto[$cont])) {
        $cont++;
    }
    return $cont;
}

function mi_explode($separador, $texto) {
    $array=array();
    $j=0;
    $long_texto=mi_strlen($texto);
    while($j<$long_texto && $texto[$j]==$separador)
        $j++;

    if($j<$long_texto)
    {  
        $cont=0;
        $array[$cont]=$texto[$j];
        $j++;
        while($j<$long_texto)
        {
            if($texto[$j]!=$separador)
            {
                $array[$cont].=$texto[$j];
                $j++;
            }
            else
            {
                $j++;
                while($j<$long_texto && $texto[$j]==$separador)
                    $j++;
                    
                if($j<$long_texto)
                {
                    $cont++;
                    $array[$cont]=$texto[$j];
                    $j++;
                } 
            }
        }
    }
    return $array;
}
if (isset($_POST["btnContar"])) {
    $error_form = $_POST["texto"] == "";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Ejercicio 2. Longitud de las palabras extraídas</h1>
    <form action="ejercicio2.php" method="post">
        <p>
            <label for="texto">Introduzca un Texto: </label>
            <input type="text" name="texto" id="texto" value="<?php if (isset($_POST["texto"])) echo $_POST["texto"] ?>">
            <?php
            if (isset($_POST["btnContar"]) && $error_form) {
                echo "<span class = 'error'> Campo vacío </span>";
            }
            ?>
        </p>
        <p>
            <label for="sep">Elija el Separador: </label>
            <select name="sep" id="sep">
                <option <?php if (isset($_POST["btnContar"]) && $_POST["sep"] == ",") echo "selected" ?> value=",">, (coma)</option>
                <option <?php if (isset($_POST["btnContar"]) && $_POST["sep"] == ";") echo "selected" ?> value=";">; (punto y coma)</option>
                <option <?php if (isset($_POST["btnContar"]) && $_POST["sep"] == " ") echo "selected" ?> value=" ">&nbsp; (espacio)</option>
                <option <?php if (isset($_POST["btnContar"]) && $_POST["sep"] == ":") echo "selected" ?> value=":">: (dos puntos)</option>
            </select>
        </p>
        <p>
            <button type="submit" name="btnContar">Contar</button>
        </p>
    </form>
    <?php
    if (isset($_POST["btnContar"]) && !$error_form) {
        echo "<h1>Respuesta</h1>";
        $partes = mi_explode($_POST["sep"], $_POST["texto"]);
        echo "<ol>";
        for ($i = 0; $i < count($partes); $i++) {
            echo "<li>".$partes[$i]." (".mi_strlen($partes[$i]).")</li>";
        }
        echo "</ol>";
    }
    ?>
</body>

</html>