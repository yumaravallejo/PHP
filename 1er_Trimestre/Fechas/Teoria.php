<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría de fechas en PHP</title>
</head>
<body>
    <h1>Teoría de fechas</h1>
    <?php
        //Función time -> básica (devuelve segundos desde 1-1-1970)
        echo "<p>".time()."</p>"; //segundos

        echo "<p>Probando formatos de fecha</p>";
        $fecha = date("d/m/y",1728023143); //formato corto
        echo $fecha;

        echo "<br>";

        // Y -> 2024 y-> 24
        // M -> Oct m-> 10
        // D -> Fri d-> 04
        $fecha = date("D/M/Y",1728023143);
        echo $fecha;

        echo "<br>";

        // H-> hora
        // i -> minutos
        // s -> segundos
        $fecha = date("d-m-Y-H:i:s",1728023143);
        echo $fecha;

        echo "<br>";

        $fecha = date("d-m-Y-H:i:s",time()); //Hora actualizable
        echo $fecha;

        echo "<br>";

        //Si no le pongo segundo argumento me coge time directamente
        echo  date("d-m-Y-H:i:s");

        //Comprobar si una fecha existe
        // checkdate(m, d, y)
        echo "<p>Checkdate: ";

        if (checkdate(2,29,2005)) {
            echo "La fecha existe";
        } else {
            echo "La fecha no existe";
        }
        echo "</p>";
        //mktime(hora, minuto, segundo, mes, dia, año); (Si pongo 0,0,0 en horas y tal no pasa nada)
        // mktime te da el tiempo que ha pasado desde una fecha y 1970
        echo "<p>Mktime: ".mktime(0,0,0,7,30,2021)."</p>";

        echo "<p>Date del mktime: ".date("d-m-Y",1627596000)."</p>";

        //strtotime -> Y/m/d --- m/d/Y
        echo "<p>String to time: ".strtotime("2005/11/09")."</p>";
        echo "<p>Date del String to time: ".date("d/m/Y", 1131490800)."</p>";

        echo "<p>Valor absoluto: ".abs(-8)."</p>"; //valor absoluto
        echo "<p>Aproxima hacia abajo: ".floor(9.67)."</p>"; //aproxima hacia abajo
        echo "<p>Aproxima hacia arriba: ".ceil(9.67)."</p>"; //aproxima hacia arriba


    ?>
</body>
</html>