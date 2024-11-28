<?php
    echo "<h1>¡Hola ".$_SESSION['usuario']['usuario']."!</h1>";
    echo "<h2>Este es tu horario</h2>";
?>

<!-- Mostrar su horario -->

<form action="index.php" method="post">
    <p>
        <button type="submit" name="btnCerrarSesion">Cerrar Sesión</button>
    </p>
</form>