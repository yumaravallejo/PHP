<?php
session_name("Ex3_17_18_2");
session_start();
require "src/ctes_func.php";

//salir de todas las vistas
if (isset($_POST["btnSalir"])) {
    session_destroy();
    header("Location:index.php");
    exit;
}



//si estoy logueado 
if (isset($_SESSION["usuario"])) {

    //estoy logueado

    require "src/seguridad.php";
    //usuario, clave, ultimo acceso

    //vista oportuna
    require "vistas/vista_examen.php";

    mysqli_close($conexion);
}else {
    //No estoy logueado
    //vista home
    require "vistas/vista_login.php";
}
