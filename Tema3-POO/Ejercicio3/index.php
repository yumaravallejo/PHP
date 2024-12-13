<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POO - Ejercicio 3</title>
</head>
<body>
    <h1>POO - Ejercicio 3</h1>

    <?php
        require_once('class_fruta.php');

        echo "<h2>Información de mis frutas</h2>";
        echo "<p>Frutas creadas: ".Fruta::cuantaFruta()."</p>";
        $pera = new Fruta("pera","verde", "mediano");
        echo "<p>Creando una pera...</p>";
        echo "<p>Frutas creadas: ".Fruta::cuantaFruta()."</p>";
        $limon = new Fruta("limon","amarillo", "mediano");
        echo "<p>Creando un limón...</p>";
        echo "<p>Frutas creadas: ".Fruta::cuantaFruta()."</p>";

        //Destruimos una fruta, este unset ti no tiene un destructor se hace el por defect
        //En nuestro caso al tenerlo creado se usará el nuestro
        unset($limon);
        echo "<p>Destruyendo un limón...</p>";
        echo "<p>Frutas creadas: ".Fruta::cuantaFruta()."</p>";

    ?>
</body>
</html>