<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 - Práctica arrays</title>
</head>
<body>
    <!-- Imprime en un array los 10 primeros números pares. Imprímelos cada uno
    en una línea -->
    <h1></h1>
    <?php
        const N_PARES = 10; //Constante

        for ($i = 0; $i < N_PARES; $i++){
            $pares[$i] = $i*2;
        }

        //Mostramos el resultado
        for ($i = 0; $i < N_PARES; $i++) {
            echo "<p>".$pares[$i]."</p>";
        }
    
    ?>

</body>
</html>