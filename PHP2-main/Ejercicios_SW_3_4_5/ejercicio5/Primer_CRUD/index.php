<?php
session_name("EjercicioSW5");
session_start();
require "src/ctes_funciones.php";

if (isset($_POST["btnSalir"])) {
    $url = DIR_SERV . "/salir";
    $datos = array("api_key" => $_SESSION["api_key"]);
    consumir_servicios_REST($url, "POST", $datos);
    session_destroy();
    header("Location: index.php");
    exit();
}

if (isset($_SESSION["usuario"])) {
    $salto = "index.php";
    require "src/seguridad.php";

    if ($datos_usuario_logueado->tipo == "admin") {
        // vista admin
        require "vistas/vista_admin.php";
    } else {
        // Vista normal
        require "vistas/vista_normal.php";
    }
} else {
    require "vistas/vista_login.php";
}
