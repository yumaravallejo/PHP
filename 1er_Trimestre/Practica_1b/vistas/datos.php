<?php
    echo "<p><strong>Nombre: </strong>"; if(isset($_POST["nombre"]) && $_POST["nombre"] != "") echo $_POST["nombre"]; else echo "vacío"; "</p>";
    echo "<p><strong>Apellidos: </strong>"; if(isset($_POST["apellidos"]) && $_POST["apellidos"] != "") echo $_POST["apellidos"]; else echo "vacío"; "</p>";
    echo "<p><strong>Contraseña: </strong>".$_POST["contrasena"]."</p>";
    echo "<p><strong>DNI: </strong>".$_POST["dni"]."</p>";
    echo "<p><strong>Sexo: </strong>"; if(isset($_POST["sexo"])) echo $_POST["sexo"]; else echo "vacío"; "</p>";
    echo "<p><strong>Nacimiento: </strong>".$_POST["nacimiento"]."</p>";
    echo "<p><strong>Comentarios: </strong>"; if(isset($_POST["comentarios"]) && $_POST["comentarios"] != "") echo $_POST["comentarios"]; else echo "vacío"; "</p>";
    echo "<p><strong>Suscrito: </strong>";if(isset($_POST["suscripcion"]) && $_POST["suscripcion"] == 1 ) echo "Suscrito"; else echo "No suscrito"; "</p>";
?>