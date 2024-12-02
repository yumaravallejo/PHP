<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 - POO</title>
</head>
<body>
    <h1>Ejercicio 1 - PHP</h1>
    <?php
    require "class_fruta.php";
    $pera = new Fruta();
    $pera->set_color("verde");
    $pera->set_size("mediano");
    ?>
    <h2>Información de mi fruta pera</h2>
    <p>
        <strong>Color: </strong><?php echo $pera->get_color() ?> 
        <strong>Tamaño: </strong><?php echo $pera->get_size() ?>
    </p>
</body>
</html>