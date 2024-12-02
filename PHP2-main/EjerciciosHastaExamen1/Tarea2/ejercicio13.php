<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 12</title>
</head>
<body>
    <h1>3 arrays juntos con función array_push()</h1>
    <?php
        $array1 = array("Lagartija","Araña", "Perro", "Gato", "Ratón");
        $array2 = array("12", "34", "45", "52", "12");
        $array3 = array("Sauce", "Pino", "Naranjo", "Chopo", "Perro", "34");

        $array = array();

        foreach ($array1 as $elemento) {
            array_push($array, $elemento);
        }

        foreach ($array2 as $elemento) {
            array_push($array, $elemento);
        }

        foreach ($array3 as $elemento) {
            array_push($array, $elemento);
        }

        foreach (array_reverse($array) as $elemento) {
            echo "<p>$elemento</p>";
        }
    ?>
</body>
</html>