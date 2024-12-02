<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primera página</title>
</head>
<body>
    <h1>Mi primera páfina Curso 23-24</h1>
    <h2>Fecha de hoy: <?php echo date("d-m-Y"); ?></h2>
    <?php
        echo "<p> Hola a todos </p>";
        define("PI", 3.1415);
        $a = 8;
        $b = 9;
        $c = $b + $a;
        echo "<p> El resultado de sumar ".$a." + ".$b." es: ".$c."</p>";

        // Sentencia con if
        if (3 > $c) {
            echo "<p> 3 es mayor que ".$c." </p>";
        } else if (3 == $c) {
            echo "<p> 3 es igual que ".$c." </p>";
        }else {
            echo "<p> 3 es menor que ".$c." </p>";
        }

        // Sentencia con switch
        $d = 3;
        switch ($d) {
            case 1:
                $c = $a - $b;
                break;

            case 1:
                $c = $a / $b;
                break;
            
            case 3:
                $c = $a * PI;
                break;

            default:
                $c = $a + $b;
                break;
        }

        echo "<p> El resultado del switch es: ".$c." </p>";

        // Bucle for
        for($i = 0;$i < 8;$i++){
            echo "<p>".($i+1)." Hola</p>";
        }

        // Bule while
        $i = 0;
        while ($i < 8) {
            echo "<p>".($i+1)." Hola</p>";
            $i++;
        }


    ?>
</body>
</html>