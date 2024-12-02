<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4 - POO</title>
</head>
<body>
    <h1>Ejercicio 4 - PHP</h1>
    <?php
    require "class_uva.php";
    echo "<h2>Información de mi uva creada:</h2>";
    
    $uva = new Uva("morada", "mediana", true);
    if ($uva->tieneSemilla()) 
        echo "<p>Esta uva tiene semillas</p>";
    else 
        echo "<p>Esta uva NO tiene semillas</p>";
    ?>
</body>
</html>