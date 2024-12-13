<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POO - Ejercicio 4</title>
</head>
<body>
    <h1>POO - Ejercicio 4</h1>

    <?php
        require_once('uva.php');

        $uva=new Uva("morada", "pequeña", "sí");

        echo "<h2>Información de mi uva</h2>";
        
        if ($uva->tieneSemilla()){
            $uva->imprimir();
        } else {
            echo "<p>No tiene semilla</p>";
        }
        
    ?>
</body>
</html>