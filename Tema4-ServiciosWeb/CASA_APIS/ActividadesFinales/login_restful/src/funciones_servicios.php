<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require 'Firebase/autoload.php';

CONST SERVIDOR_BD = "localhost";
CONST NOMBRE_BD = "bd_foro";
CONST CLAVE_BD = "josefa";
CONST USUARIO_BD = "jose";

CONST PASSWORD_API = "MI_PASSWORD";

function validateToken()
{
    
    $headers = apache_request_headers();
    if(!isset($headers["Authorization"]))
        return false;//Sin autorizacion
    else
    {
        $authorization = $headers["Authorization"];
        $authorizationArray=explode(" ",$authorization);
        $token=$authorizationArray[1];
        try{
            $info=JWT::decode($token,new Key(PASSWORD_API,'HS256'));
        }
        catch(\Throwable $th){
            return false;//Expirado
        }

        try{
            $conexion= new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
        }
        catch(PDOException $e){
            
            $respuesta["error"]="Imposible conectar:".$e->getMessage();
            return $respuesta;
        }

        try{
            $consulta="select * from usuarios where id_usuario=?";
            $sentencia=$conexion->prepare($consulta);
            $sentencia->execute([$info->data]);
        }
        catch(PDOException $e){
            $respuesta["error"]="Imposible realizar la consulta:".$e->getMessage();
            $sentencia=null;
            $conexion=null;
            return $respuesta;
        }
        if($sentencia->rowCount()>0)
        {
            $respuesta["usuario"]=$sentencia->fetch(PDO::FETCH_ASSOC);
         
            $payload['exp']=time()+3600;
            $payload['data']= $respuesta["usuario"]["id_usuario"];
            $jwt = JWT::encode($payload,PASSWORD_API,'HS256');
            $respuesta["token"]=$jwt;
        }
            
        else
            $respuesta["mensaje_baneo"]="El usuario no se encuentra registrado en la BD";

        $sentencia=null;
        $conexion=null;
        return $respuesta;
    }
    
}


function obtener_usuarios() {
    try {
        $conexion = new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta['error'] = "Error. Imposible conectarse a la BD ".$e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "SELECT * FROM usuarios";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
    } catch (PDOException $e) {
        $sentencia=null;
        $conexion=null;
        $respuesta['error'] = "Error. Imposible realizar la consulta a la BD ".$e->getMessage();
        return $respuesta;
    }

    if ($sentencia->rowCount()>0) {
        $respuesta['usuarios'] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $respuesta['mensaje'] = "No existen usuarios en la BD";
    }

    $sentencia=null;
    $conexion=null;
    return $respuesta;
}

function obtener_detalles($id) {
    try {
        $conexion = new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta['error'] = "Error. Imposible conectarse a la BD ".$e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "SELECT * FROM usuarios WHERE id_usuario=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$id]);
    } catch (PDOException $e) {
        $sentencia=null;
        $conexion=null;
        $respuesta['error'] = "Error. Imposible realizar la consulta a la BD ".$e->getMessage();
        return $respuesta;
    }

    if ($sentencia->rowCount()>0) {
        $respuesta['usuario'] = $sentencia->fetch(PDO::FETCH_ASSOC);
    } else {
        $respuesta['mensaje'] = "No existe este usuario en la BD";
        
    }

    $sentencia=null;
    $conexion=null;
    return $respuesta;
}

function insertar_usuario($datos) {
    try {
        $conexion = new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta['error'] = "Error. Imposible conectarse a la BD ".$e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "INSERT INTO usuarios (nombre, usuario, clave, email) VALUES (?,?,?,?)";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute($datos);
    } catch (PDOException $e) {
        $sentencia=null;
        $conexion=null;
        $respuesta['error'] = "Error. Imposible realizar la consulta a la BD ".$e->getMessage();
        return $respuesta;
    }

    $last_id = $conexion->lastInsertId();
    $respuesta['ult_id'] = $last_id;

    $sentencia=null;
    $conexion=null;
    return $respuesta;
}

function comprobar_login($datos) {
    try {
        $conexion = new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta['error'] = "Error. Imposible conectarse a la BD ".$e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "SELECT * FROM usuarios WHERE usuario=? AND clave=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute($datos);
    } catch (PDOException $e) {
        $sentencia=null;
        $conexion=null;
        $respuesta['error'] = "Error. Imposible realizar la consulta a la BD ".$e->getMessage();
        return $respuesta;
    }

    if($sentencia->rowCount()>0)
    {
        $respuesta["usuario"]=$sentencia->fetch(PDO::FETCH_ASSOC);
        $payload['exp']=time()+3600;
        $payload['data']= $respuesta["usuario"]["id_usuario"];
        $jwt = JWT::encode($payload,PASSWORD_API,'HS256');
        $respuesta["token"]=$jwt;

    }
    else
        $respuesta["mensaje"]="El usuario no se encuentra en la BD";

    $sentencia=null;
    $conexion=null;
    return $respuesta;
}

function actualizar_usuario($datos) {
    try {
        $conexion = new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta['error'] = "Error. Imposible conectarse a la BD ".$e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "UPDATE usuarios SET nombre=?, usuario=?, clave=?, email=? WHERE id_usuario=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute($datos);
    } catch (PDOException $e) {
        $sentencia=null;
        $conexion=null;
        $respuesta['error'] = "Error. Imposible realizar la consulta a la BD ".$e->getMessage();
        return $respuesta;
    }
    
    $respuesta['mensaje'] = "El usuario ".end($datos)." ha sido actualizado con éxito";
    
    $sentencia=null;
    $conexion=null;
    return $respuesta;
}

function actualizar_usuario_sin($datos) {
    try {
        $conexion = new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta['error'] = "Error. Imposible conectarse a la BD ".$e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "UPDATE usuarios SET nombre=?, usuario=?, email=? WHERE id_usuario=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute($datos);
    } catch (PDOException $e) {
        $sentencia=null;
        $conexion=null;
        $respuesta['error'] = "Error. Imposible realizar la consulta a la BD ".$e->getMessage();
        return $respuesta;
    }
    
    $respuesta['mensaje'] = "El usuario ".end($datos)." ha sido actualizado con éxito";
    
    $sentencia=null;
    $conexion=null;
    return $respuesta;
}

function borrar_usuario($codigo) {
    try {
        $conexion = new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta['error'] = "Error. Imposible conectarse a la BD ".$e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "DELETE FROM usuarios WHERE id_usuario=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$codigo]);
    } catch (PDOException $e) {
        $sentencia=null;
        $conexion=null;
        $respuesta['error'] = "Error. Imposible realizar la consulta a la BD ".$e->getMessage();
        return $respuesta;
    }
    
    $respuesta['mensaje'] = "El usuario ".$codigo." ha sido borrado con éxito";
    
    $sentencia=null;
    $conexion=null;
    return $respuesta;
}

function repetido_insertar($tabla, $columna, $valor) {
    try {
        $conexion = new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta['error'] = "Error. Imposible conectarse a la BD ".$e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "SELECT ".$columna." FROM ".$tabla." WHERE ".$columna."=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$valor]);
    } catch (PDOException $e) {
        $sentencia=null;
        $conexion=null;
        $respuesta['error'] = "Error. Imposible realizar la consulta a la BD ".$e->getMessage();
        return $respuesta;
    }

    $respuesta["repetido"]=$sentencia->rowCount()>0;

    $sentencia=null;
    $conexion=null;
    return $respuesta;
}


function repetido_editar($tabla, $columna, $valor, $columna_id, $valor_id) {
    try {
        $conexion = new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta['error'] = "Error. Imposible conectarse a la BD ".$e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "SELECT ".$columna." FROM ".$tabla." WHERE ".$columna."=? AND ".$columna_id." <> ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$valor, $valor_id]);
    } catch (PDOException $e) {
        $sentencia=null;
        $conexion=null;
        $respuesta['error'] = "Error. Imposible realizar la consulta a la BD ".$e->getMessage();
        return $respuesta;
    }

    $respuesta["repetido"]=$sentencia->rowCount()>0;

    $sentencia=null;
    $conexion=null;
    return $respuesta;
}


?>