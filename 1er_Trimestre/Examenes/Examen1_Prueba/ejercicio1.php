<?php
    function mi_strlen($texto) {
        $cont = 0;
        $letra_ult = substr($texto, -1, 1);
        while (isset($texto[$cont])) {
            $cont++;
        }
        return $cont;
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
    <form action="ejercicio1.php" method="post">
        <p>
            <label for="text">Introduce un texto</label>
            <input type="text" name="texto" value="<?php if (isset($_POST['texto'])) echo $_POST ['texto'];?>">
            <?php
            if (isset($_POST['enviar']))
                echo "<span>Este texto tiene ".mi_strlen($_POST['texto'])."</span>"
            ?>
        </p>

        <p>
            <button type="submit" name="enviar">Calcular</button>
        </p>
    </form>

    
</body>
</html>