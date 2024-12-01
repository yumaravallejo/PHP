<h1>Librería</h1>
<?php
echo "<form action='index.php' method='post'><p>Bienvenido <strong>". $datos_usuario_logueado['lector']. "</strong> - ";
echo "<button class='enlace' type='submit' name='btnCerrarSesion'>Salir</button></p></form>";
require "vista_libros.php";
?>