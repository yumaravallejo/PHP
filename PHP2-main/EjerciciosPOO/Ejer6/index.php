<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6 - POO</title>
</head>
<body>
    <h1>Ejercicio 6 - PHP</h1>
    <?php
    require "class_menu.php";
    $menu = new Menu();
    $menu->cargar("https://classroom.google.com/", "Classroom");
    $menu->cargar("https://educacionadistancia.juntadeandalucia.es/centros/malaga/my/", "Moodle");
    $menu->cargar("https://github.com/", "Github");
    $menu->mostrarVertical();
    $menu->mostrarHorizontal();
    ?>
</body>
</html>