
<?php
if ($n_tupla > 0) {
    echo "<h2>Detalle usuario: ".$detalle_usuario['nombre']." </h2>";
    echo "<p><strong>Nombre: </strong>".$detalle_usuario['nombre']."</p>";
    echo "<p><strong>Usuario: </strong>".$detalle_usuario['usuario']."</p>";
    echo "<p><strong>Email: </strong>".$detalle_usuario['email']."</p>";
    echo "<p><strong>Clave: </strong></p>";

    echo "<form method='post' action='index.php'><button type='submit'>Atrás</button></form>";
} else {
    echo "Este usuario ya no se encuenrta registrado en la base de datos";
}
?>
