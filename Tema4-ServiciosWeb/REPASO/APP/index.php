<?php
session_name("Actividad8_24_25");
session_start();

require "src/funciones_ctes.php";

//Para saber si estoy logueado usaremos el servicio de logueado
// al loguearnos solo guardaremos el token y la ult_acc para el baneo

//Si existe este $_SESSION estaré logueado
if (isset($_SESSION['token'])) {
    require "src/seguridad.php";
    //Para pasar la seguridad tengo que llamar a logueado

    if ($datos_usu_log['tipo'] == 'admin') {
        require "vistas/vista_admin.php";
    } else {
        require "vistas/vista_normal.php";
    }
} else {
    require "vistas/vista_login.php";
}

?>