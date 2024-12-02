<?php
    function mi_strlen($texto) {
        $cont = 0;
        while (isset($texto[$cont])) {
            $cont++;
        }
        return $cont;
    }

    function mi_explode($separador, $texto) {
        $array = [];
        $longitud = mi_strlen($texto);
        $i = 0;
        while ($i < $longitud && $texto[$i] == $separador) {
            $i++;
        }

        if($i < $longitud) {
            $j = 0;
            
            for ($i ; $i < $longitud; $i++) {
                $array[$j] = '';
                if ($texto[$i] != $separador) {
                    $array[$j] .= $texto[$i];
                } else {
                    while ($i < $longitud && $texto[$i] == $separador) {
                        $i++;
                    }
                    $j++;
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
    <title>Ejercicio 3</title>
    <style>
        .error {color: red;}
    </style>
</head>
<body>
    <h1>Ejercicio 3</h1>
    <form action="ejercicio3.php" method="post">
    <p>
        <label for="sep">Elija Separador</label>
        <select name="sep" id="sep">
            <option <?php if(isset($_POST["btnContar"]) && $_POST["sep"] == ",") echo "selected";?> value=",">, (coma)</option>
            <option <?php if(isset($_POST["btnContar"]) && $_POST["sep"] == ";") echo "selected";?> value=";">; (punto y coma)</option>
            <option <?php if(isset($_POST["btnContar"]) && $_POST["sep"] == " ") echo "selected";?> value=" ">&nbsp; (espacio)</option>
            <option <?php if(isset($_POST["btnContar"]) && $_POST["sep"] == ":") echo "selected";?> value=":">: (dos puntos)</option>
        </select>
    </p>
    <p>
        <label for="texto">Introduzca una frase</label>
        <input type="text" name="texto" id="texto" value="<?php if(isset($_POST["texto"])) echo $_POST["texto"] ?>">
        <?php
            if (isset($_POST["btnContar"]) && $error_form) {
                echo "<span class = 'error'> Campo vacío </span>";
            }
        ?>
    </p>
    <p>
        <button type="submit" name="btnContar">Contar</button>
    </p>
    </form>
    <?php
        if (isset($_POST["btnContar"]) && !$error_form) {
            echo "<h2>Respuesta</h2>";
            echo "<p>El número de palabras separadas por el separador es de: ".count(mi_explode($_POST["sep"], $_POST["texto"]))."</p>";
        }
    ?>
</body>
</html>