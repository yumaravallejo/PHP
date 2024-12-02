<?php
session_name("Examen3_17_18");
session_start();
require "src/ctes_funciones.php";

if(isset($_POST["btnSalir"])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

if (isset($_SESSION["usuario"])) {
    
    // Estoy logueado
    // seguridad
    require "vistas/seguridad.php";
    // Vista oportuna
    if ($datos_usuario_logueado["tipo"] == "admin") {
        mysqli_close($conexion);
        header("Location: admin/index.php");
        exit();
    } else {
        require "vistas/vista_examen.php";
    }
    

    mysqli_close($conexion);
} else {
    // No estoy logueado
    require "vistas/vista_login.php";
}
?>
