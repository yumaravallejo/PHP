<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>P00 - Ejercicio 5</title>
</head>
<body>
    <h1>POO - Ejercico 5</h1>
    <?php
    require_once('empleado.php');

    $e1 = new Empleado("Pepe", 2500);
    $e2 = new Empleado("Jose", 3001);

    $e1->imprimir();
    $e2->imprimir();
    ?>
</body>
</html>