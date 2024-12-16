<?php
/// Control de Baneo
try{
    $consulta="SELECT * FROM usuarios WHERE lector=? and clave=?";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute([$_SESSION['lector'], $_SESSION['clave']]);
    
} catch(Exception $e){
    session_destroy();
    $sentencia=null;
    $conexion=null;
    die(error_page("Examen2 Php","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
}

if($sentencia->rowCount()<=0) {
    session_unset();
    $_SESSION["seguridad"]="Usted ya no se encuentra registrado en la BD";
    $sentencia = null;
    $conexion = null;
    header("Location:".$salto_seg);
    exit;
}

$datos_lector_log=$sentencia->fetch(PDO::FETCH_ASSOC);


//He pasado el baneo 
//Ahora el control de tiempo

if(time()-$_SESSION["ultima_accion"]>INACTIVIDAD*60)
{
    session_unset();
    $_SESSION["seguridad"]="Su tiempo de sesión ha expirado";
    $conexion=null;
    header("Location:".$salto_seg);
    exit;
}

$_SESSION["ultima_accion"]=time();

?>