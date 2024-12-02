<?php
require "../src/ctes_funciones.php";
session_name("Examen3_17_18");
session_start();

if(isset($_SESSION["usuario"])) {
    $salto="../index.php";
    require "../vistas/seguridad.php";
    if ($datos_usuario_logueado["tipo"]=="admin")
        require "../vistas/vista_admin.php";
    else{
        header("Location: ../index.php");
    }
}else{
    header("Location: ../index.php");
}
?>
