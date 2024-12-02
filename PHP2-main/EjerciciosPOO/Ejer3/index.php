<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 - POO</title>
</head>
<body>
    <h1>Ejercicio 3 - PHP</h1>
    <?php
    require "class_fruta.php";
    echo "<h2>Información de mis frutas:</h2>";
    echo "<p>Frutas creadas hasta el momento: ".Fruta::cuantaFruta()."</p>";
    echo "<p>Creando una pera...</p>";
    $pera = new Fruta("verde", "mediano");
    echo "<p>Frutas creadas hasta el momento: ".Fruta::cuantaFruta()."</p>";
    echo "<p>Creando un melon...</p>";
    $melon = new Fruta("amarillo", "grande");
    echo "<p>Frutas creadas hasta el momento: ".Fruta::cuantaFruta()."</p>";
    echo "<p>Destruyendo el melon...</p>";
    unset($melon);
    // $melon = null; También vale
    echo "<p>Frutas creadas hasta el momento: ".Fruta::cuantaFruta()."</p>";
    ?>
</body>
</html>