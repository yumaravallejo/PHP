<?php
try {
    @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    session_destroy();
    die(error_page("Primer Login", "<p>No se ha podido acceder a la base de datos: " . $e->getMessage() . "</p>"));
}

//Conexión correcta, seguimos
try {
    $consulta = "select * from usuarios where usuario='" . $_SESSION['usuario'] . "' AND clave = '" . $_SESSION['clave'] . "' ";
    $result = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    mysqli_close($conexion);
    session_destroy();
    die(error_page("Primer Login", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
}

if (mysqli_num_rows($result) <= 0) {
    mysqli_free_result($result);
    //No usamos destroy para que el usuario pueda ver el mensaje de baneo
    session_unset();
    $_SESSION['msj_seguridad'] = "Usted ya no se encuentra registrado en la base de datos";
    header("Location: index.php");
    exit;
} else {
    $datos_usuario_log = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
}

//He pasado el cntrol de baneo

if (time() - $SESSION['ult_accion'] > INACTIVIDAD * 60) {
    session_unset();
    $_SESSION['msj_seguridad'] = "Su tiempo de sesión ha expirado";
    header("Location: index.php");
    exit;
}

$SESSION['ult_accion'] = time();
?>
