<?php
// Control de errores
$error_nombre_corto = $_POST["nombre_corto"] == '';
$error_pvp = $_POST["pvp"] == '' || !is_numeric($_POST["pvp"]) || $_POST["pvp"] <= 0;
$error_form = $error_nombre_corto || $error_pvp;

// Si no hay errores
if (!$error_form) {
    // Insertamos el producto
    $url = DIR_SERV . "/producto/actualizar/" . $_POST["btnContEditar"];
    if ($_POST["nombre"] == "") $_POST["nombre"] = NULL;
    if ($_POST["descripcion"] == "") $_POST["descripcion"] = NULL;
    $datos = array("nombre" => $_POST["nombre"], "nombre_corto" => $_POST["nombre_corto"], "descripcion" => $_POST["descripcion"], "PVP" => number_format($_POST["pvp"], 2, '.', ''), "familia" => $_POST["familia"]);
    $respuesta = consumir_servicios_REST($url, "PUT", $datos);
    $obj = json_decode($respuesta);
    if (!$obj) {
        session_destroy();
        die(error_page("ERROR", "<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta));
    }

    if (isset($obj->error)) {
        session_destroy();
        die(error_page("ERROR", "<p>" . $obj->error . "</select></p>"));
    }
    if (isset($obj->mensaje))
        $_SESSION["mensaje"] = $obj->mensaje;

    header("Location:index.php");
    exit();
}
