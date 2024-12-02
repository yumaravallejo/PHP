<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría Arrays</title>
</head>
<body>
    <?php 
    
        // $nota[0] = 5;
        // $nota[1] = 9;
        // $nota[2] = 8;
        // $nota[3] = 5;
        // $nota[4] = 6;
        // $nota[5] = 7;

        // $nota[] = 5;
        // $nota[] = 9;
        // $nota[] = 8;
        // $nota[] = 5;
        // $nota[] = 6;
        // $nota[] = 7;

        // Estas dos formas se resumen en:
        $nota = array(5,9,8,5,6,7);

        // Si quisieramos poner índices no correlativos se puede poner así:
        // $nota = array(0 => 5, 1 => 9);

        // print_r($nota); Escribe el contenido (tanto valores como indices)
        // echo "<br>";
        // var_dump($nota);

        echo "<h1>Recorrido de un array escalar con sus índices correlativos</h1>";
        for ($i = 0; $i < count($nota); $i++) {
            echo "<p> En la posición: ".$i." tiene el valor: ".$nota[$i]."</p>";
        }

        // $valor[0] = 18;
        // $valor[1] = "Hola";
        // $valor[2] = true;
        // $valor[3] = 3.4;

        // Si no ponemos los valores en los corchetes, se pone en orden
        // Y si ponemos por ejemplo un 3, el true va a ser posicion 4
        // Quedandose vacío el 1 y el 2

        // $valor[] = 18;
        // $valor[99] = "Hola";
        // $valor[] = true;
        // $valor[200] = 3.4;

        // Se puede poner en mayúsculas
        $valor = Array(18, 99 => "Hola", true, 200 => 3.4);
        
        // echo "<br>";
        // var_dump($valor);

        echo "<h1>Recorrido de un array escalar con sus índices NO correlativos</h1>";

        // Así tengo solo el contenido
        // foreach($valor as $contenido) {
        //     echo "<p> Contenido: ".$contenido."</p>";
        // }

        // Aí tambien tengo el indice
        foreach($valor as $indice => $contenido) {
            echo "<p> En la posición: ".$indice." tiene el valor: ".$contenido."</p>";
        }

        // ARRAY ASOCIATIVO
        $notas1["Antonio"] = 5;
        $notas1["Luis"] = 9;
        $notas1["Ana"] = 8;
        $notas1["Eloy"] = 5;
        $notas1["Gabriela"] = 6;
        $notas1["Berta"] = 7;

        echo "<h1> Notas de DWESE </h1>";

        foreach($notas1 as $nombre => $nota) {
            echo "<p>".$nombre." ha sacado un ".$nota.".</p>";
        }

        // ARRAY ASOCIATIVO MULTIDIMENSIONAL
        $notas["Antonio"]["DWESE"] = 5;
        $notas["Antonio"]["DWECL"] = 7;
        $notas["Luis"]["DWESE"] = 9;
        $notas["Luis"]["DWECL"] = 7;
        $notas["Ana"]["DWESE"] = 8;
        $notas["Ana"]["DWECL"] = 9;
        $notas["Eloy"]["DWESE"] = 5;
        $notas["Eloy"]["DWECL"] = 6;

        echo "<h1> Notas de los alumnos </h1>";

        foreach($notas as $nombre => $asignaturas) {
            echo "<p>".$nombre."</p>";
            echo "<ul>";
                foreach($asignaturas as $asignatura => $nota) {
                    echo "<li> <strong>".$asignatura."</strong> -> ".$nota."</li>";
                }
            echo "</ul>";
        }

        $capital = array("Castilla y León" => "Valladolid", "Asturias" => "Oviedo",
        "Aragón" => "Zaragoza");

        echo "<p> Último valor de un array: ".end($capital)."</p>"; // Último valor
        echo "<p> El valor al que está señalando el puntero: ".current($capital)."</p>"; // Actual (donde está el puntero)
        echo "<p> El índice al que está señalando el puntero: ".key($capital)."</p>"; // Indice del puntero
        echo "<p> Primer valor de un array: ".reset($capital)."</p>"; // Para apuntar al primer elemento
        echo "<p> Siguiente valor: ".next($capital)."</p>"; // Avanza el puntero a 1, te puedes pasar
        echo "<p> Valor anterior: ".prev($capital)."</p>"; // Retrasa el puntero a 1, te puedes pasar

        // Usando estas funciones podemos recorrer un array
        while(current($capital)) {
            echo "<strong>".current($capital)."</strong><br/>";
            next($capital);
        }

        // is_array(array) da true si es array
        // sort(array) ordena
    ?>
</body>
</html>