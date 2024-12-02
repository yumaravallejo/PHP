<?php
    function LetraNIF($dni) {
        return substr('TRWAGMYFPDXBNJZSQVHLCKEO', $dni % 23, 1);
    }

    function dni_bien_escrito($texto) {
        return strlen($texto) == 9 && is_numeric(substr($texto, 0, 8)) && substr($texto,-1)>='A'
        && substr($texto, -1) <= 'Z';
    }

    function dni_valido($texto) {
        $numero = substr($texto, 0, 8);
        $letra = substr($texto, -1);
        $valido = LetraNif($numero) == $letra;
        return $valido;
    }

    if (isset($_POST['borrar'])) {
        unset($_POST);
    }

    if (isset($_POST['enviar'])) {
        $error_nombre = $_POST['nombre'] == '';
        $error_usuario = $_POST['usuario'] == '';
        $error_clave = $_POST['clave'] == '';
        $error_dni = $_POST['dni'] == '' || !dni_bien_escrito(strtoupper($_POST['dni'])) ||
        !dni_valido($_POST['dni']);
        $error_sexo = !isset($_POST['sexo']);
        if ($_FILES['archivo']['name'] != '' && !$_FILES['archivo']['error']) {
            $error_archivo= !getimagesize($_FILES['archivo']['tmp_name'])
            || $_FILES['archivo']['size'] > 500*1024 ;
        } else {
            $error_archivo= false;
        }
        $error_form = $error_nombre || $error_usuario || $error_clave || $error_dni || 
        $error_sexo || $error_archivo;
    }

    if (isset($_POST['enviar']) && !$error_form) {
        require "vistas/vista_recogida.php";
    } else {
        require 'vistas/vista_formulario.php';
    }
