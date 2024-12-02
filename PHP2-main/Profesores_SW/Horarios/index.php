<?php
session_name("Profesores_SW");
session_start();

require "src/ctes_funciones.php";
require "vistas/vista_quitar.php";
require "vistas/vista_insertar.php";

if (isset($_POST["btnSalir"])) {
    $datos = array("api_session" => $_SESSION["api_session"]);
    $url = DIR_SERV . "/salir";
    consumir_servicios_REST($url, "POST", $datos);
    session_destroy();
    header("Location:index.php");
    exit();
}

if (isset($_SESSION["usuario"])) {
    // Si estoy logueado
    // Seguridad
    require "src/seguridad.php";
    // Tipo
    if ($datos_usuario_logueado->tipo == "normal") {
        // Vista normal
        require "vistas/vista_normal.php";
    } else {
        // Vista admin
        require "vistas/vista_admin.php";
    }
} else {
    // Si no estoy logueado
    require "vistas/vista_login.php";
}
