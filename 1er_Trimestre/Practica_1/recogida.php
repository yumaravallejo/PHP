<?php
    if(!isset($_POST["guardar"])){ 
        header("Location: index.php"); //No poner nunca debajo de código HTML
        exit;
    } else {
        echo "<p><strong>Nombre: </strong>"; if(isset($_POST["nombre"]) && $_POST["nombre"] != "") echo $_POST["nombre"]; else echo "vacío"; "</p>";
        echo "<p><strong>Apellidos: </strong>"; if(isset($_POST["apellidos"]) && $_POST["apellidos"] != "") echo $_POST["apellidos"]; else echo "vacío"; "</p>";
        echo "<p><strong>Contraseña: </strong>".$_POST["contrasena"]."</p>";
        echo "<p><strong>DNI: </strong>".$_POST["dni"]."</p>";
        echo "<p><strong>Sexo: </strong>"; if(isset($_POST["sexo"])) echo $_POST["sexo"]; else echo "vacío"; "</p>";
        echo "<p><strong>Nacimiento: </strong>".$_POST["nacimiento"]."</p>";
        echo "<p><strong>Comentarios: </strong>"; if(isset($_POST["comentarios"]) && $_POST["comentarios"] != "") echo $_POST["comentarios"]; else echo "vacío"; "</p>";
        echo "<p><strong>Suscrito: </strong>";if(isset($_POST["suscripcion"]) && $_POST["suscripcion"] == 1 ) echo "Suscrito"; else echo "No suscrito"; "</p>";
    } 
        //var_dump($_POST); --> muestra el contenido de la variable
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recogida</title>
</head>
<body>
    <h1>Recogida de Datos</h1>
</body>
</html>