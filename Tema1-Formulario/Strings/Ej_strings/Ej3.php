<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 - Práctica con Strings</title>
</head>
<body>
<h1>Frases palíndromas - Formulario</h1>
    <p>Dime una frase y te diré si es una frase palíndroma</p>
    <form action="Ej3_resultado.php" method="post">
    <p>
            <label for="segunda">Frase: </label>
            <input type="text" id="texto" name="texto" value="" required>
        </p>

        <p>
            <input type="submit" id="comprobar" name="comprobador" value="Comprobar">
        </p>

    </form>
</body>
</html>