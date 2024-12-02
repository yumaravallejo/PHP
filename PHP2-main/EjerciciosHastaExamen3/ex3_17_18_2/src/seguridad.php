<?php
//hago un control de baneo
    // $conexion=conectarBD_error_page();
    try {
        $conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        session_destroy();
        // mysqli_close($conexion);
        die(error_page("Examen3 ", "<h1>Examen3</h1><p>No se ha podido conectar con la base de datos: " . $e->getMessage() . "</p>"));
    }

    

    try{
        $consulta="select * from usuarios where usuario='".$_SESSION["usuario"]."' and clave='".$_SESSION["clave"]."'";
        $resultado=mysqli_query($conexion, $consulta);

    }catch(Exception $e){
        session_destroy();
        mysqli_close($conexion);
        die(error_page("Examen3", "<h1>Examen3</h1><p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));

    }

    //$resultado=consultarBD_error_page($conexion,$consulta);

    //si no me conecto
    if(mysqli_num_rows($resultado)<=0){
        mysqli_free_result($resultado);
        mysqli_close($conexion);
        session_unset(); //destruyo TODAS LAS VARIABLES DE SESION
        $_SESSION["seguridad"]="Usted ya no se encuentra registrado en la BD";
        header("Location:index.php");
        exit;
    }

    $datos_usuario_logueado=mysqli_fetch_assoc($resultado);
    mysqli_free_result($resultado);
    //Control de inactividad****
    if(time()-$_SESSION["ultima_accion"]>MINUTOS_INACT*60){
        mysqli_close($conexion);
        session_unset();
        $_SESSION["seguridad"]="Su tiempo de sesión ha caducado";
        header("Location:index.php");
        exit;
    }
    //actualización del tiempo
    $_SESSION["ultima_accion"]=time();

?>