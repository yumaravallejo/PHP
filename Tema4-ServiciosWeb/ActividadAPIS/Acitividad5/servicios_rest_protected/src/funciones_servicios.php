<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require "../Firebase/autoload.php";

define("SERVIDOR_BD","localhost");
define("USUARIO_BD","jose");
define("CLAVE_BD","josefa");
define("NOMBRE_BD","bd_tienda");
define("PASSWORD_API", "PASSWORD_DE_MI_APLICACIÓN");

function validateToken() {
    $headers = apache_request_headers();
    if (!isset($headers['Authorization'])){
        return false;
    } else {
        $authorization = $headers['Authorization'];
        $authorizationArray = explode(" ", $authorization);
        $token = $authorizationArray[1];
        try {
            $info = JWT::decode($token, new Key('PASSWORD_DE_MI_APLICACION', 'H256')) ;
        } catch (\Throwable $th) {
            return false; //Expirado
        }

        try{
            $conexion=new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        }
        catch(PDOException $e)
        {
            $respuesta["error"]="No he podido conectarse a la base de batos: ".$e->getMessage();
            return $respuesta;
        }
    
        try{
            $consulta="select * from usuarios where usuario=?";
            $sentencia=$conexion->prepare($consulta);
            $sentencia->execute([$info->data]);
        }
        catch(PDOException $e)
        {
            $sentencia=null;
            $conexion=null;
            $respuesta["error"]="No he podido realizarse la consulta: ".$e->getMessage();
            return $respuesta;
        }

        if($sentencia->rowCount()>0){
            $respuesta["usuario"]=$sentencia->fetch(PDO::FETCH_ASSOC);
            $payload =  ['exp'=>strtotime("now")+3600,'data=>']
        } else
            $respuesta["mensanje"]="El usuario no se encuentra registrado en la BD";
    
        $sentencia=null;
        $conexion=null;
        return $respuesta;
    }
}

function login($usuario,$clave)
{
    try{
        $conexion=new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }
    catch(PDOException $e)
    {
        $respuesta["error"]="No he podido conectarse a la base de batos: ".$e->getMessage();
        return $respuesta;
    }

    try{
        $consulta="select * from usuarios where usuario=? and clave=?";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute([$usuario,$clave]);

    }
    catch(PDOException $e)
    {
        $sentencia=null;
        $conexion=null;
        $respuesta["error"]="No he podido realizarse la consulta: ".$e->getMessage();
        return $respuesta;
    }

    if($sentencia->rowCount()>0){
        $respuesta["usuario"]=$sentencia->fetch(PDO::FETCH_ASSOC);
    } else
        $respuesta["mensanje"]="El usuario no se encuentra registrado en la BD";

    $sentencia=null;
    $conexion=null;
    return $respuesta;
}


?>