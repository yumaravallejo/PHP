<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2 - Práctica de arrays</title>
</head>
<body>
    <h1>Mostrar array con índices asociativos y numéricos</h1>

    <!-- Imprime los valores del array asociativo siguiente usando 
     la estructura del control foreach -->

     <?php
        $v[1]=90;
        $v[30]=7;
        $v['e']=99;
        $v['hola']=43;

        foreach ($v as $index=>$valor) {
            echo "<p>índice: ".$index." --> Valor: ".$valor."</p>";
        }


    ?>
</body>
</html>