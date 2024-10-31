<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays Multidimensionales</title>
</head>
<body>

    <?php
    //Con arrays asociativos (que su indice no es un numero) --> FOREACH
    //Bucles for básicos solo con cardinales en orden y sin saltarse números
        $evaluacion["Nerea"]["DWESE"] = 9;
        $evaluacion["Nerea"]["DWECLI"] = 10;
        $evaluacion["Edu"]["DWESE"] = 3.5;
        $evaluacion["Edu"]["DWECLI"] = 5;
        $evaluacion["Javi"]["DWESE"] = 6;
        $evaluacion["Javi"]["DWECLI"] = 2;

        echo "<h1>Notas de los alumnos de 2º DAW</h1>";
        //$key -> será el valor de un array (primer [])
        //$valor -> será el valor de otro array (segundo [])
        // foreach($notas as $key=>$valor)

        echo "<ol>";
        foreach($evaluacion as $alumno=>$asignaturas) {
            echo "<li>".$alumno;
            echo"<ul>";
                foreach ($asignaturas as $modulo=>$nota) {
                    echo "<li>".$modulo.": ".$nota."</li>";
                }
            echo "</ul>";
            echo "</li>";            
        }
        echo "</ol>";

    ?>
    
</body>
</html>