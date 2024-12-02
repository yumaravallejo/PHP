<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7 - POO</title>
</head>
<body>
    <h1>Ejercicio 7 - PHP</h1>
    <?php
    require "class_pelicula.php";
    $pelicula = new Pelicula("El Padrino", 1970, "Francis Ford Coppola", 20.5, true, "2020/12/10");
    echo "<p><strong>Título: </strong>".$pelicula->getNombre()."<br>";
    echo "<strong>Año: </strong>".$pelicula->getAño()."<br>";
    echo "<strong>Director: </strong>".$pelicula->getDirector()."<br>";
    echo "<strong>Precio: </strong>".$pelicula->getPrecio()."€<br>";
    if($pelicula->getAlquilada()) echo "<strong>Estado: </strong>Alquilada<br>";
    else echo "<strong>Estado: </strong>Disponible<br>";
    echo "<strong>Fecha prevista de devolución: </strong>".$pelicula->getFecha_prev_devolucion()."<br>";
    echo "<strong>Recargo actual: </strong>".$pelicula->calcularRecargo()."€</p>";
    ?>
    
</body>
</html>
