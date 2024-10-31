<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5 - Práctica con arrays</title>
</head>
<body>
    <h1>Mostrar array asociativo con su valor</h1>

    <?php
        $persona["Nombre"] = "Pedro Torres";
        $persona["Dirección"] = "C/Mayor, 37";
        $persona["Teléfono"] = "123456789";

        foreach($persona as $dato=>$valor) {
            echo "<p>".$dato.": ".$valor."</p>";
        }
    ?>
</body>
</html>