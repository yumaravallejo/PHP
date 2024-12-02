<?php
    function enArray($valor, $arr) {
        $esta = false;
        for ($i = 0; $i < count($arr); $i++) {
            if ($arr[$i] == $valor) {
                $esta = true;
                break;
            }
        }
        return $esta;
    }

    // Compruebo errores
    if(isset($_POST["enviar"])) {
        $error_nombre = $_POST["nombre"] == "";
        $error_sexo = !isset($_POST["sexo"]);
        $error_form = $error_nombre ||  $error_sexo;
    }

    if (isset($_POST["enviar"]) && !$error_form) {

        require "vistas/vista_respuestas.php";
    } else {
        require "vistas/vista_formulario.php";
    }
 ?>