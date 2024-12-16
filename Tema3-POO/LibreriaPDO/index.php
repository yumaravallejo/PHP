<?php
session_name("examen2_24_25");
session_start();

require "src/funciones_ctes.php";


if(isset($_POST["btnCerrarSesion"]))
{
    session_destroy();
    header("Location:index.php");
    exit;
}

//Abro la conexion
try {  
    $conexion = new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD."", USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
} catch (PDOException $e) {
    die ("<p>No se ha podido conectar a la BD ".$e->getMessage()."</p></body></html>");
}



if(isset($_SESSION["lector"]))
{
    $salto_seg="index.php";
    require "src/seguridad.php";
    if($datos_lector_log["tipo"]=="normal")
        require "vistas/vista_normal.php";
    else
    {
        $sentencia = null;
        $conexion = null;
        header("Location:admin/gest_libros.php");
        exit;
    }

}
else
{
    require "vistas/vista_login.php";
}

$sentencia = null;
$conexion=null;

?>