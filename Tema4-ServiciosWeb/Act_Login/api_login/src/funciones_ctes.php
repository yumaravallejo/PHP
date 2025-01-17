<?php
define("SERVIDOR_BD", "localhost");
define("USUARIO_BD", "jose");
define("CLAVE_BD", "josefa");
define("NOMBRE_BD", "bd_cv");

function login($usuario, $clave)
{
    //Cuando haya varios parámetros se pasa siempre un array al execute
    $datos[] = $usuario;
    //La clave ya viene encriptada
    $datos[] = $clave;

    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No he podido conectarse a la base de batos: " . $e->getMessage();
        return $respuesta;
    }
    try {
        $consulta = "SELECT * FROM usuarios WHERE usuario=? AND clave=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute($datos);

        //Otra forma
        // Asignar valores a los parámetros
        // $sentencia->bindParam(':usuario', $_POST['usuario']);
        // $sentencia->bindParam(':clave', md5($_POST['clave']));
        // $sentencia->execute();

    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No he podido realizarse la consulta: " . $e->getMessage();
        return $respuesta;
    }

    if ($sentencia->rowCount() > 0)
        $respuesta["usuario"] = $sentencia->fetch(PDO::FETCH_ASSOC);
    else
        return $respuesta['mensaje'] = "El usuario no se encuentra registrado en la BD";

    $sentencia = null;
    $conexion = null;
    return $respuesta;
}
