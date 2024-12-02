<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5 - POO</title>
</head>
<body>
    <h1>Ejercicio 5 - PHP</h1>
    <?php
    require "class_empleado.php";
    $manolo = new Empleado("Manolo", 4500);
    $manolo->impuestos();
    $paco = new Empleado("Paco", 1400);
    $paco->impuestos();
    ?>
</body>
</html>