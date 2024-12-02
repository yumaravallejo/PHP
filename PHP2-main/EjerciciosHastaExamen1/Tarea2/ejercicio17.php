<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 17</title>
</head>
<body>
    <h1>Familias</h1>
    <?php
        $familias = array('Los Simpsons' => array('Padre' => 'Homer', 'Madre' => 'Merge', 
        'Hijos' => array('Hijo1' => 'Bart', 'Hijo2' => 'Lisa', 'Hijo3' => 'Maggie')),
        'Los Griffin' => array('Padre' => 'Peter', 'Madre' => 'Lois', 
        'Hijos' => array('Hijo1' => 'Chris', 'Hijo2' => 'Meg', 'Hijo3' => 'Stewie')));

        echo "<ul>";
        foreach ($familias as $familia => $miembros) {
            echo "<li>
                    $familia
                    <ul>";
                    foreach ($miembros as $miembro => $nombres) {
                        if (is_array($nombres)) {
                            echo "<ul>";
                                foreach ($nombres as $hijo => $n) {
                                    echo "<li>$hijo: $n</li>";
                                }
                                echo "</ul></li>";
                        } else {
                            echo "<li>$miembro: $nombres</li>";
                        }
                    }
                echo "</ul>
                </li>";
        }
        echo "</ul>";
    ?>
</body>
</html>