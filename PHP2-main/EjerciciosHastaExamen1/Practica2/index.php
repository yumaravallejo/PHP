<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esta es mi súper página</title>
</head>
<body>
    <h1>Esta es mi súper página</h1>
    <form action="recogida.php" method="post">
        <p>
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" id="nombre">
        </p>
        <p>
            <label for="nacido">Nacido en: </label>
            <select name="nacido" id="nacido">
                <option value="Málaga">Málaga</option>
                <option value="Marbella">Marbella</option>
                <option value="Estepona">Estepona</option>
            </select>
        </p>
        <p>
            <label>Sexo: </label>
            <label for="hombre">Hombre </label>
            <input type="radio" name="sexo" id="hombre" value="hombre">
            <label for="mujer"> Mujer </label>
            <input type="radio" name="sexo" id="mujer" value="mujer">
        </p>
        <p>
            <label>Aficiones: </label>
            <label for="deportes">Deportes </label>
            <input type="checkbox" name="aficiones[]" id="deportes" value="deportes">
            <label for="lectura"> Lectura </label>
            <input type="checkbox" name="aficiones[]" id="lectura" value="lectura">
            <label for="otros"> Otros </label>
            <input type="checkbox" name="aficiones[]" id="otros" value="otros">
        </p>
        <p>
            <label for="comentarios">Comentarios: </label>
            <textarea name="comentarios" id="comentarios" cols="30" rows="5"></textarea>
        </p>
        <p>
            <input type="submit" name="enviar" value="Enviar">
        </p>
    </form>
</body>
</html>