<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 19</title>
</head>

<body>
    <h1>Ejercicio 19</h1>
    <?php
    $amigos = array(
        'Madrid' => array(
            array('Nombre' => 'Pedro', 'Edad' => 32, 'Teléfono' => '91-9999999'),
            array('Nombre' => 'Antonio', 'Edad' => 32, 'Teléfono' => '00-9999999'),
            array('Nombre' => 'Alguien', 'Edad' => 32, 'Teléfono' => '00-9999999')
        ),
        'Barcelona' => array(
            array('Nombre' => 'Pedro', 'Edad' => 32, 'Teléfono' => '91-9999999')
        ),
        'Toledo' => array(
            array('Nombre' => 'Nombre', 'Edad' => 42, 'Teléfono' => '9525954548'),
            array('Nombre' => 'Nombre2', 'Edad' => 43, 'Teléfono' => '9521235548'),
            array('Nombre' => 'Nombre3', 'Edad' => 41, 'Teléfono' => '9525004548')
        )
    );

    foreach ($amigos as $ciudad => $amigos) {
        echo "<p>Amigos en $ciudad: </p>";
        echo "<ol>";
        foreach ($amigos as $amigo => $datos) {
            echo "<li>";
            foreach ($datos as $indice => $contenido) {
                echo "$indice: $contenido. ";
            }
            echo "</li>";
        }
        echo "</ol>";
    }
    ?>
</body>

</html>