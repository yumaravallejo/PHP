<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>P00 - Ejercicio 6</title>
</head>
<body>
    <h1>POO - Ejercico 6</h1>
    <?php
    require_once('menu.php');

    $menu = new Menu();
    $menu->cargar("https://www.google.com/" , "Google");
    $menu->cargar("https://mail.google.com/" , "Mail");
    $menu->cargar("https://classroom.google.com/" , "Classroom");

    $menu->vertical();
    $menu->horizontal();

    ?>
</body>
</html>