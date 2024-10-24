<?php
    if (isset($_POST['enviar'])) {
        $errores_form = $_POST['texto'] == "" ;
    }

    function mi_explode($delimitador, $texto){
        $array = [];
        $palabra = "";
        for ($i = 0; $i<strlen($texto); $i++) {
            if ($texto[$i]!=$delimitador){
                $palabra .= $texto[$i];
            } else if ($texto[$i]==$delimitador && $i>0) {
                $array[] = $palabra;
                $palabra = "";
            }
        }

        if ($palabra != ""){
            $array[] = $palabra;
        }

        return $array;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
    <style>
        .error{color:red;}
    </style>
</head>
<body>
    <h1>Ejercicio 3</h1>
    <form action="Ej3.php" method="post">
        <p>
            <label for="texto">Introduce un texto</label>
            <input type="text" name="texto" id="texto" value="<?php if (isset($_POST['texto'])) echo $_POST['texto'];?>">
            <?php
                if (isset($_POST['enviar']) && $errores_form) {
                    echo "<span class='error'>* Campo vacío *</span>";
                }
            ?>
        </p>

        <p>
            <label for="separador">Escoge un separador</label>
            <select name="separador" id="separador">
                <option value="," <?php if (isset($_POST['separador']) && $_POST['separador']==",") echo 'selected';?>>Coma</option>
                <option value=";" <?php if (isset($_POST['separador']) && $_POST['separador']==";") echo 'selected'; ?>>Punto y coma</option>
                <option value=":" <?php if (isset($_POST['separador']) && $_POST['separador']==":") echo 'selected'; ?>>Dos puntos</option>
                <option value=" " <?php if (isset($_POST['separador']) && $_POST['separador']==" ") echo 'selected'; ?>>Espacio</option>
            </select>
        </p>

        <p>
            <button type="submit" name="enviar">Contar</button>
        </p>
    </form>

    <?php
        if (isset($_POST['enviar']) && !$errores_form) {
            $arr_texto = mi_explode($_POST['separador'], $_POST['texto']);
            echo "<h2>Respuesta</h2>";
            echo "<p>El texto <strong>".$_POST['texto']."</strong> separado mediante ' ".$_POST['separador']." ' tiene ".count($arr_texto)." palabras</p>";
        }
    ?>
</body>
</html>