<?php
$url = DIR_SERV . "/producto/borrar/" . $_POST["btnBorrar"];
$respuesta = consumir_servicios_REST($url, "DELETE");
$obj = json_decode($respuesta);
if (!$obj) {
    session_destroy();
    die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
}

if (isset($obj->error)) {
    session_destroy();
    die("<p>" . $obj->error . "</select></p></body></html>");
}

if (isset($obj->mensaje))
    $_SESSION["mensaje"] = $obj->mensaje;
