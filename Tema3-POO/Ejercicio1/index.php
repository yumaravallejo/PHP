<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POO - Ejercicio 1</title>
</head>
<body>
    <h1>POO - Ejercicio 1</h1>

    <?php
        require_once('class_fruta.php');

        $pera = new Fruta("pera", "verde", "mediano");
        

        echo "<h2>Información de mi fruta pera</h2>";
        echo "<p><strong>Color: </strong>".$pera->getColor()."</p>";
        echo "<p><strong>Tamaño: </strong>".$pera->getTamanio()."</p>";
    ?>
</body>
</html>