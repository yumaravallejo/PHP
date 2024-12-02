<?php

// Control de baneo
$url = DIR_SERV . "/logueado";
$datos = array("api_key" => $_SESSION["api_key"]);
$respuesta = consumir_servicios_REST($url, "POST", $datos);
$obj = json_decode($respuesta);
if (!$obj) {
    session_destroy();
    die(error_page("ERROR", "<p>No has recibido un json </p>" . $respuesta));
}

if (isset($obj->error)) {
    session_destroy();
    die(error_page("ERROR", "<p>" . $obj->error . "</p>"));
}

if (isset($obj->mensaje)) {
    session_unset();
    $_SESSION["seguridad"] = "Usted ya no se encuentra registrado en la base de datos";
    header("Location: index.php");
    exit();
}

if (isset($obj->no_login)) {
    session_unset();
    $_SESSION["seguridad"] = "Su tiempo de sesión de la api ha caducado.";
    header("Location: index.php");
    exit();
}

if (time() - $_SESSION["ult_acc"] > MINUTOS * 60) {
    session_unset();
    $_SESSION["seguridad"] = "Su tiempo de sesión ha caducado.";
    header("Location: index.php");
    exit();
}

$datos_usuario_logueado = $obj->usuario;
$_SESSION["ult_acc"] = time();
