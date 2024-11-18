<?php
session_start();
require "src/funciones_ctes.php";

if (isset($_POST['btnCerrarSesion'])) {
    session_destroy();
}

    if (isset($_SESSION['usuario'])) {
        //Por si me hubiesen baneado antes de mostrar hacemos un control de baneo
        
        require "src/seguridad.php";
        require "vistas/vista_logueada.php";
        mysqli_close($conexion);
    } else {
        require "vistas/vista_login.php";
    }
?>
