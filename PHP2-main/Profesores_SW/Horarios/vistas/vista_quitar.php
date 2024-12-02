<?php
// Botón quitar
if (isset($_POST["btnQuitar"])) {

    // Eliminar grupo de una hora y dia concreto de un profesor
    $url = DIR_SERV . "/borrarGrupo";
    $datos = array("api_session" => $_SESSION["api_session"], "profesores" => $_POST["profesores"], "dia" => $_POST["dia"], "hora" => $_POST["hora"], "grupo" => $_POST["btnQuitar"]);
    $respuesta = consumir_servicios_REST($url, "DELETE", $datos);
    $obj = json_decode($respuesta);
    if (!$obj) {
        session_destroy();
        die(error_page("ERROR", "<p>Error al consumir el servicio: " . $url . "</p>"));
    }

    // Creamos sesiones
    $_SESSION["mensaje"] = $obj->mensaje;
    $_SESSION["profesores"] = $_POST["profesores"];
    $_SESSION["hora"] = $_POST["hora"];
    $_SESSION["dia"] = $_POST["dia"];

    header("Location:index.php");
    exit();
}
