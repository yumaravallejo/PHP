<?php
if(isset($_POST["borrar"])) {
    unset($_POST);
    // header("Location:index.php");
    // exit;
}
    $error_form = false;

    // Compruebo errores
    if(isset($_POST["enviar"])) {
        $error_nombre = $_POST["nombre"] == "";
        $error_apellidos = $_POST["apellidos"] == "";
        $error_clave = $_POST["clave"] == "";
        $error_sexo = !isset($_POST["sexo"]);
        $error_comentarios = $_POST["comentario"] == "";
        $error_form = $error_nombre || $error_apellidos ||
        $error_clave || $error_sexo || $error_comentarios;
    }

    if (isset($_POST["enviar"]) && !$error_form) {
        require "vistas/vista_respuesta.php";
    } else {
        require "vistas/vista_formulario.php";
    }
?>