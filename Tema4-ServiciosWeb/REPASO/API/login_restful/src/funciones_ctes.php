<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require 'Firebase/autoload.php';

define("SERVIDOR_BD", "localhost");
define("USUARIO_BD", "jose");
define("CLAVE_BD", "josefa");
define("NOMBRE_BD", "bd_foro");
define("PASSWORD_API","PASSWORD_DE_MI_APLICACION");

//Esta función nos la pasará Miguel Angel

function validateToken()
{
    //¿Existe la autorización?
    //Si no existe es que no hay autorización
    $headers = apache_request_headers();
    if(!isset($headers["Authorization"]))
        return false;//Sin autorizacion
    else
    {
        $authorization = $headers["Authorization"];
        $authorizationArray=explode(" ",$authorization); //Bearer, Tokken
        $token=$authorizationArray[1];
        try{
            $info=JWT::decode($token,new Key(PASSWORD_API,'HS256')); //Clave generada con semilla (pswrd) y hash
        }
        catch(\Throwable $th){
            //Si no logro decodificar es porque se ha pasado el tiempo
            return false;//Expirado
        }

        //Si todo va bien en info['data'] tengo la id, porque abajo lo llamé data

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
         
            //Creación del Tokken con información
            $payload['exp']=time()+3600;
            $payload['data'] = $respuesta["usuario"]["id_usuario"];
            $jwt = JWT::encode($payload,PASSWORD_API,'HS256');
            $respuesta["token"]=$jwt;
        }
            
        else
            //Te han baneado o te haN borrado de la BD
            $respuesta["mensaje"]="El usuario no se encuentra registrado en la BD";

        $sentencia=null;
        $conexion=null;
        return $respuesta;
    }
    
}

function obtener_usuarios()
{
    //Conexión a la BD
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No he podido conectarse a la base de batos: " . $e->getMessage();
        return $respuesta;
    }

    //Obtención de usuarios de la BD
    try {
        $consulta = "select * from usuarios";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
    } catch (PDOException $e) {
        //Cerramos conexión y sentencia con los errores
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No he podido realizarse la consulta: " . $e->getMessage();
        return $respuesta;
    }

    //Devolvemos los usuarios hecho array
    $respuesta["usuarios"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    //Cerramos conexión y sentencia
    $sentencia = null;
    $conexion = null;
    return $respuesta;
}

function insertar_usuario($datos_insert)
{
    //Conexión a la BD
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No he podido conectarse a la base de batos: " . $e->getMessage();
        return $respuesta;
    }

    //Obtención de usuarios de la BD
    try {
        $consulta = "INSERT INTO usuarios (nombre, usuario, clave, email) VALUES (?,?,?,?)";
        $sentencia = $conexion->prepare($consulta);
        //Estos datos son el array pasado por la api, debemos pasarlo en el orden de inserción
        $sentencia->execute($datos_insert);
    } catch (PDOException $e) {
        //Cerramos conexión y sentencia con los errores
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No he podido realizarse la consulta: " . $e->getMessage();
        return $respuesta;
    }

    //Devolvemos el último id (el recién insertado) --> porque lo pide el enunciado
    $respuesta["id_usuario"] = $conexion->lastInsertId();
    //Cerramos conexión y la sentencia
    $sentencia = null;
    $conexion = null;
    return $respuesta;
}


function login($datos_login)
{
    //Conexión a la BD
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No he podido conectarse a la base de batos: " . $e->getMessage();
        return $respuesta;
    }

    //Obtención de usuarios de la BD para saber si existe
    try {
        $consulta = "SELECT * FROM usuarios WHERE usuario=? AND clave=?";
        $sentencia = $conexion->prepare($consulta);
        //Estos datos son el array pasado por la api, debemos pasarlo en el orden de select
        $sentencia->execute($datos_login);
    } catch (PDOException $e) {
        //Cerramos conexión y sentencia con los errores
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No he podido realizarse la consulta: " . $e->getMessage();
        return $respuesta;
    }

    if ($sentencia->rowCount() <= 0)
        $respuesta['mensaje'] = "Este usuario no está registrado en la BD"; //Devolvemos un mensaje para saber que no existe
    else 
        $respuesta["usuario"] = $sentencia->fetch(PDO::FETCH_ASSOC);
        //Devolvemos los datos del usuario si existe

    //Cerramos conexión y la sentencia
    $sentencia = null;
    $conexion = null;
    return $respuesta;
    
}

function actualizar_usuario($datos_update)
{
    //Conexión a la BD
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No he podido conectarse a la base de batos: " . $e->getMessage();
        return $respuesta;
    }

    //Obtención de usuarios de la BD para saber si existe
    try {
        $consulta = "UPDATE usuarios SET nombre=?, usuario=?, clave=?, email=? WHERE id_usuario = ?";
        $sentencia = $conexion->prepare($consulta);
        //Estos datos son el array pasado por la api, debemos pasarlo en el orden de actualización
        $sentencia->execute($datos_update);
    } catch (PDOException $e) {
        //Cerramos conexión y sentencia con los errores
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No he podido realizarse la consulta: " . $e->getMessage();
        return $respuesta;
    }

    $respuesta['mensaje'] = "El usuario (".end($datos_update).") ha sido actualizado correctamente";

    //Cerramos conexión y la sentencia
    $sentencia = null;
    $conexion = null;
    return $respuesta;
    
}

function borrar_usuario($id)
{
    //Conexión a la BD
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No he podido conectarse a la base de batos: " . $e->getMessage();
        return $respuesta;
    }

    //Obtención de usuarios de la BD para saber si existe
    try {
        $consulta = "DELETE FROM usuarios WHERE id_usuario=?";
        $sentencia = $conexion->prepare($consulta);
        //Estos datos son el array pasado por la api, debemos pasarlo en el orden de actualización
        $sentencia->execute($id);
    } catch (PDOException $e) {
        //Cerramos conexión y sentencia con los errores
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No he podido realizarse la consulta: " . $e->getMessage();
        return $respuesta;
    }

    $respuesta['mensaje'] = "El usuario (".$id.") ha sido eliminado correctamente";

    //Cerramos conexión y la sentencia
    $sentencia = null;
    $conexion = null;
    return $respuesta;
    
}

function repetido_insert($tabla, $columna, $valor)
{
    //Conexión a la BD
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No he podido conectarse a la base de batos: " . $e->getMessage();
        return $respuesta;
    }

    //Obtención de usuarios de la BD para saber si existe
    try {
        //Esto no puede ser porque el execute cambia por 'valor' con comillas
        // $consulta = "SELECT * FROM ? WHERE ? = ?";
        $consulta = "SELECT ".$columna." FROM ".$tabla." WHERE ".$columna." = ?";
        $sentencia = $conexion->prepare($consulta);
        //Estos datos son el array pasado por la api, debemos pasarlo en el orden de actualización
        $sentencia->execute($valor);
    } catch (PDOException $e) {
        //Cerramos conexión y sentencia con los errores
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No he podido realizarse la consulta: " . $e->getMessage();
        return $respuesta;
    }

    if ($sentencia->rowCount()  > 0)
        $respuesta['mensaje'] = "El usuario ya existe en la BD";

    //Cerramos conexión y la sentencia
    $sentencia = null;
    $conexion = null;
    return $respuesta;
    
}


function repetido_editar($tabla, $columna, $valor, $columna_id, $valor_id)
{
    //Conexión a la BD
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No he podido conectarse a la base de batos: " . $e->getMessage();
        return $respuesta;
    }

    //Obtención de usuarios de la BD para saber si existe
    try {
        //Esto no puede ser porque el execute cambia por 'valor' con comillas
        // $consulta = "SELECT * FROM ? WHERE ? = ?";
        $consulta = "SELECT ".$columna." FROM ".$tabla." WHERE ".$columna." = ? AND ".$columna_id." != ?";
        $sentencia = $conexion->prepare($consulta);
        //Estos datos son el array pasado por la api, debemos pasarlo en el orden de actualización
        $sentencia->execute($valor, $valor_id);
    } catch (PDOException $e) {
        //Cerramos conexión y sentencia con los errores
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No he podido realizarse la consulta: " . $e->getMessage();
        return $respuesta;
    }

    if ($sentencia->rowCount()  > 0)
        $respuesta['mensaje'] = "El usuario ya existe en la BD";

    //Cerramos conexión y la sentencia
    $sentencia = null;
    $conexion = null;
    return $respuesta;
    
}


