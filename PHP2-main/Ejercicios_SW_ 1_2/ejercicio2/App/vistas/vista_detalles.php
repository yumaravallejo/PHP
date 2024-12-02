<?php
// Obtenemos el producto clicado
$url = DIR_SERV . "/producto/" . $_POST["btnDetalles"];
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

$detalles = $obj->producto;
echo "<h2>Detalles del producto con id <strong>" . $detalles->cod . "</strong></h2>";
echo "<p><strong>Código: </strong>" . $detalles->cod . "</p>";
if ($detalles->nombre)
    echo "<p><strong>Nombre: </strong>" . $detalles->nombre . "</p>";
else
    echo "<p><strong>Nombre: </strong>No tiene.</p>";

echo "<p><strong>Nombre corto: </strong>" . $detalles->nombre_corto . "</p>";
if ($detalles->descripcion)
    echo "<p><strong>Descripción: </strong>" . $detalles->descripcion . "</p>";
else
    echo "<p><strong>Descripción: </strong> No tiene.</p>";
echo "<p><strong>PVP: </strong>" . str_replace(".", ",", $detalles->PVP) . "€</p>";

$url = DIR_SERV . "/familia/" . $detalles->familia;
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

echo "<p><strong>Familia: </strong>" . $detalles->familia . "</p>";
