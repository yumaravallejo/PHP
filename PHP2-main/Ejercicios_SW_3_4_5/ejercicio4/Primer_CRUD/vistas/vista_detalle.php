<?php
echo "<h3>Detalles del usuario con id: " . $_POST["btnDetalle"] . "</h3>";

$url = DIR_SERV . "/usuario/" . $_POST["btnDetalle"];
$respuesta = consumir_servicios_REST($url, "GET");
$obj = json_decode($respuesta);
if (!$obj) {
    session_destroy();
    die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
}

if (isset($obj->error)) {
    session_destroy();
    die("<p>" . $obj->error . "</select></p></body></html>");
}

if (isset($obj->usuario)) {
    echo "<p>";
    echo "<strong>Nombre: </strong>" . $obj->usuario->nombre . "<br>";
    echo "<strong>Usuario: </strong>" . $obj->usuario->usuario . "<br>";
    echo "<strong>Email: </strong>" . $obj->usuario->email;
    echo "</p>";
} else
    echo "<p>" . $obj->mensaje . "</p>";


echo "<form action='index.php' method='post'>";
echo "<p><button type='submit'>Volver</button></p>";
echo "</form>";
