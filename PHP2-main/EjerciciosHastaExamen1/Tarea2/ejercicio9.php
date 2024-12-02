<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 9</title>
</head>
<body>
    <h1>Lenguajes</h1>
    <?php
        $lenguaje_cliente = array("LC1" => "Lenguaje cliente 1", "LC2" => "Lenguaje cliente 2",
        "LC3" => "Lenguaje cliente 3");
        $lenguaje_servidor = array("LS1" => "Lenguaje servidor 1", "LS2" => "Lenguaje servidor 2",
        "LS3" => "Lenguaje servidor 3");

        $lenguajes = $lenguaje_cliente + $lenguaje_servidor;
        echo "<table>";
        echo "<tr><th>Lenguajes</th></tr>";
        foreach ($lenguajes as $leng => $de) {
            echo "<tr><td>$de</td></tr>";
        }
        echo "</table>";
    ?>
</body>
</html>