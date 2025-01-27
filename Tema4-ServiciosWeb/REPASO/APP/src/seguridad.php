<?php
    //Obtener datos  de usuario con token (datos desde arriba --> header)
    $headers[] = "Authorization: Bearer ".$_SESSION['token'];
    $url = DIR_SERV."/logueado";
    $respuesta = consumir_servicios_JWT_REST($url, "GET", $headers);
    $json_respuesta = json_decode($respuesta, true);
    if (!$json_respuesta) {
        session_destroy();
        die(error_page("",""));
    }
    if (isset($json_respuesta['error'])) {
        session_destroy();
        die(error_page("",""));
    }
    if (isset($json_respuesta['no_auth'])) {
        //Se te ha agotado el tiempo de sesión
        session_unset();
        $_SESSION['mensaje_seguridad'] = "El tiempo de sesión de la API ha expirado";
        header("Location:index.php");
        exit;
    }
    if (isset($json_respuesta['mensaje'])) {
        //Has sido baneado
        session_unset();
        $_SESSION['mensaje_seguridad'] = "Usted ya no se encuentra registrado en la BD";
        header("Location:index.php");
        exit;
    } 

    //Si no muero antes de esto todo está bien
    $datos_usu_log = $json_respuesta['usuario'];
    //Hay que cambiar el token porque se ha recibido uno nuevo
    $_SESSION['token'] = $json_respuesta['token'];

    //Si el tiempo que lleva inactivo es mayor de lo permitido cerramos su sesión
    if (time()-$_SESSION['ult_acc']>INACTIVIDAD*60) {
        session_unset();
        $_SESSION['mensaje_seguridad'] = "Su tiempo de sesión ha expirado";
        header("Location:index.php");
        exit;
    }
    //Renovamos el tiempo
    $_SESSION['ult_acc'] = time();
?>