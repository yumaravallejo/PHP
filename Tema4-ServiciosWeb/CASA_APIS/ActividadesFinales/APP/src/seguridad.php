<?php
$headers[] = "Authorization: Bearer ".$_SESSION['token'];
$url = DIR_SERV."/logueado";
$respuesta = consumir_servicios_JWT_REST($url, "GET", $headers);
$json_respuesta = json_decode($respuesta, true);

if (!$json_respuesta) {
    session_destroy();
    die(error_page("Actividad 8 - SW","<p>Error consumiendo el servicio Rest: <strong>".$url."</strong></p>"));
}
if (isset($json_respuesta['error'])) {
    session_destroy();
     die(error_page("Actividad 8 - SW","<p>".$json_respuesta['error']."</p>"));
}

if (isset($json_respuesta['no_auth'])) {
    session_unset();
    $_SESSION["mensaje_seguridad"]="El tiempo de sesión de la API ha expirado";
    header("Location:index.php");
    exit;
}

if (isset($json_respuesta['mensaje_baneo'])) {
    session_unset();
    $_SESSION["mensaje_seguridad"]="Usted ya no se encuentra registrado en al BD";
    header("Location:index.php");
    exit;
}

$datos_usu_log = $json_respuesta['usuario'];
$_SESSION['token'] = $json_respuesta['token'];

if(time()-$_SESSION['ult_acc']>INACTIVIDAD*60) {
    session_unset();
    $_SESSION["mensaje_seguridad"]="Su tiempo de sesión ha expirado";
    header("Location:index.php");
    exit;
}

?>