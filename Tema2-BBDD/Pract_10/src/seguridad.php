<?php
    try {
        $sentencia = "SELECT * FROM alumnos WHERE usuario = '".$_SESSION['usuario']."' AND clave = md5('".$_SESSION['clave']."')";
        $resultado = mysqli_query($conexion, $sentencia);
    } catch (Exception $e) {
        session_destroy();
        mysqli_close($conexion);
        die("No se ha podido realizar la consulta " . $e->getMessage());
    }

    if (mysqli_num_rows($resultado) <= 0) {

        mysqli_free_result($resultado);
    
        mysqli_close($conexion);
        session_unset();
    
        $_SESSION["seguridad"] = "Usted ya no se encuentra registrado en la BD";
    
        header("Location:" . $salto);
        exit;
    }
    
    $datos_usuario_logueado = mysqli_fetch_assoc($resultado);
    mysqli_free_result($resultado);

    
    //Comprobamos le tiempo
    if (time()-$_SESSION['ultm_accion'] > INACTIVIDAD * 60) {
        mysqli_close($conexion);
        session_unset();
        $_SESSION["seguridad"] = "Su tiempo de sesión ha caducado";
        header("Location:" . $salto);
        exit;
    }

    $_SESSION['ultm_accion'] = time();
?>
