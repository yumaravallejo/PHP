

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 - Práctica con Strings</title>
</head>
<body>
    <h1>Ripios - Formulario</h1>
    <p>Dime dos palabras y te diré si riman o no</p>
    <form action="Ej1_resultado.php" method="post">
        
        <p>
            <label for="primera">Primera palabra: </label>
            <input type="text" id="primera" name="primera" value="" required>
        </p>
        
        <p>
            <label for="segunda">Segunda palabra: </label>
            <input type="text" id="segunda" name="segunda" value="" required>
        </p>

        <p>
            <input type="submit" id="comparar" name="comparador" value="Comparar">
        </p>

    </form>
</body>
</html>