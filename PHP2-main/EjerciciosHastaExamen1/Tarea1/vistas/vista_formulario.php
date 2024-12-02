<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi primera página PHP</title>
</head>
<body>
    <h1>Esta es mi super página</h1>
    <form action="index.php" method="post">
        <p>
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" id="nombre" 
            value="<?php if(isset($_POST["nombre"])) { echo $_POST["nombre"];}?>">
            <?php
            if (isset($_POST["enviar"]) && $error_nombre) {
                echo "<span class='error'> * Campo obligatorio *</span>";
            }
            ?>
        </p>
        <p>
            <label for="nacido">Nacido en: </label>
            <select name="nacido" id="nacido">
                <option value="Málaga" 
                <?php if(isset($_POST["nacido"]) && $_POST["nacido"] == "Málaga") 
                { echo "selected";}?>>Málaga</option>
                <option value="Marbella" 
                <?php if(isset($_POST["nacido"]) && $_POST["nacido"] == "Marbella") 
                { echo "selected";}?>>Marbella</option>
                <option value="Estepona"
                <?php if(isset($_POST["nacido"]) && $_POST["nacido"] == "Estepona") 
                { echo "selected";}?>>Estepona</option>
            </select>
        </p>
        <p>
            <label>Sexo: </label>
            <label for="hombre">Hombre </label>
            <input type="radio" name="sexo" id="hombre" value="hombre"
            <?php if(isset($_POST['sexo']) && $_POST['sexo'] == 'hombre') {echo 'checked'; }?>>
            <label for="mujer"> Mujer </label>
            <input type="radio" name="sexo" id="mujer" value="mujer"
            <?php if(isset($_POST['sexo']) && $_POST['sexo'] == 'mujer') {echo 'checked'; }?>>
            <?php
            if (isset($_POST["enviar"]) && $error_sexo) {
                echo "<span class='error'> * Campo obligatorio *</span>";
            }
            ?>
        </p>
        <p>
            <label>Aficiones: </label>
            <label for="deportes">Deportes </label>
            <input type="checkbox" name="aficiones[]" id="deportes" value="deportes"
            <?php if(isset($_POST['aficiones']) && enArray("deportes", $_POST["aficiones"])) {
                echo 'checked'; }?>>
            <label for="lectura"> Lectura </label>
            <input type="checkbox" name="aficiones[]" id="lectura" value="lectura"
            <?php if(isset($_POST['aficiones']) && enArray("lectura", $_POST["aficiones"])) {
                echo 'checked'; }?>>
            <label for="otros"> Otros </label>
            <input type="checkbox" name="aficiones[]" id="otros" value="otros"
            <?php if(isset($_POST['aficiones']) && enArray("otros", $_POST["aficiones"])) {
                echo 'checked'; }?>>
        </p>
        <p>
            <label for="comentarios">Comentarios: </label>
            <textarea name="comentarios" id="comentarios" cols="30" rows="5"><?php 
            if(isset($_POST["comentarios"])) { echo $_POST["comentarios"];} 
            ?></textarea>
        </p>
        <p>
            <input type="submit" name="enviar" value="Enviar">
        </p>
    </form>
</body>
</html>