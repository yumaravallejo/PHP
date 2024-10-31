<?php
    if (isset($_POST['enviar'])) {
        $errores_form =  $_POST['texto'] == "";
    }

    function mi_strlen($texto) {
        $i = 0;
        while (isset($texto[$i])){
            $i++;
        }

        return $i;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>
    <h1>Ejercicio 1</h1>
    <form action="Ej1.php" method="post">
        <p>
            <label for="texto">Introduce un texto</label>
            <input type="text" name="texto" id="texto" value="<?php if(isset($_POST['texto'])) echo $_POST['texto']; ?>">
            <?php
                if(isset($_POST['enviar']) && $errores_form){
                    echo "<span class='error'>* Campo Vacío *</span>";
                }

                if(isset($_POST['enviar']) && !$errores_form){
                    echo "<span>Esta palabra tiene ".mi_strlen($_POST['texto'])." caracteres </span>";
                }
            ?>
        </p>
        <p>
            <button type="submit" name="enviar">Contar</button>
        </p>
    </form>
</body>
</html>