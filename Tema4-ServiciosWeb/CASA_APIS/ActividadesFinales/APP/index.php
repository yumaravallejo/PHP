<?php
session_name('ejercicios_finales');
session_start();

require "src/functiones_ctes.php";

if (isset($_POST['btnSalir'])){
    session_destroy();
    header("Location:index.php");
    exit;
}

if (isset($_SESSION['token'])) {
    //Control de baneo
    require "src/seguridad.php";

    if($datos_usu_log["tipo"]=="admin")
        require "vistas/vista_admin.php";
    else
        require "vistas/vista_normal.php";

} else 
    require "vistas/vista_login.php";


