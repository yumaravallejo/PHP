<?php
//Constantes de la BD
const SERVIDOR_BD = "localhost";
const USUARIO_BD = "jose";
const CLAVE_BD = "josefa";
const NOMBRE_BD = "bd_tienda";

function repetido ($cod) {
    //Conectamos con la bd
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD . "", USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
    } catch (PDOException $e) {
        //Mostramos el mensaje de error sin cerrar nada porque no se ha llegado a abrir
        $respuesta["error"] = "No se ha podido conectar a la BD: " . $e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "SELECT * FROM producto WHERE cod=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute($cod);
    } catch (PDOException $e) {
        //Cerramos conexiones y sentencias
        $sentencia = null;
        $conexion = null;
        //Mostramos el mensaje de error
        $respuesta["error"] = "No se ha podido conectar a la BD: " . $e->getMessage();
        return $respuesta;
    }

    if ($sentencia->rowCount()<=0) return false; 
    else return true;
}

function existe($familia) {
    //Conectamos con la bd
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD . "", USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
    } catch (PDOException $e) {
        //Mostramos el mensaje de error sin cerrar nada porque no se ha llegado a abrir
        $respuesta["error"] = "No se ha podido conectar a la BD: " . $e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "SELECT * FROM familia WHERE nombre=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute($familia);
    } catch (PDOException $e) {
        //Cerramos conexiones y sentencias
        $sentencia = null;
        $conexion = null;
        //Mostramos el mensaje de error
        $respuesta["error"] = "No se ha podido conectar a la BD: " . $e->getMessage();
        return $respuesta;
    }

    if ($sentencia->rowCount()<=0) return false; 
    else return true;
}

function obtener_productos()
{
    //Conectamos con la bd
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD . "", USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
    } catch (PDOException $e) {
        //Mostramos el mensaje de error sin cerrar nada porque no se ha llegado a abrir
        $respuesta["error"] = "No se ha podido conectar a la BD: " . $e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "SELECT * FROM producto";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
    } catch (PDOException $e) {
        //Cerramos conexiones y sentencias
        $sentencia = null;
        $conexion = null;
        //Mostramos el mensaje de error
        $respuesta["error"] = "No se ha podido conectar a la BD: " . $e->getMessage();
        return $respuesta;
    }

    //Con la sentencia devolvemos el resultado
    $respuesta['productos'] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia = null;
    $conexion = null;

    return $respuesta;
}

function obtener_producto($codigo)
{
    //Conectamos con la bd
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD . "", USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
    } catch (PDOException $e) {
        //Mostramos el mensaje de error sin cerrar nada porque no se ha llegado a abrir
        $respuesta["error"] = "No se ha podido conectar a la BD: " . $e->getMessage();
        return $respuesta;
    }

    try {
        $consulta = "SELECT * FROM producto WHERE cod=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute($codigo);
    } catch (PDOException $e) {
        //Cerramos conexiones y sentencias
        $sentencia = null;
        $conexion = null;
        //Mostramos el mensaje de error
        $respuesta["error"] = "No se ha podido conectar a la BD: " . $e->getMessage();
        return $respuesta;
    }

    if ($sentencia->rowCount()<=0)
        $respuesta['mensaje'] = "El producto con código ".$codigo." no se encuentra en la BD";
     else 
        $respuesta['productos'] = $sentencia->fetchAll(PDO::FETCH_ASSOC);


    //Con la sentencia devolvemos el resultado
    $sentencia = null;
    $conexion = null;

    return $respuesta;
}

function insertar_producto($datos)
{
    //Conectamos con la bd
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD . "", USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        //Mostramos el mensaje de error sin cerrar nada porque no se ha llegado a abrir
        $respuesta["error"] = "No se ha podido conectar a la BD: " . $e->getMessage();
        return $respuesta;
    }


    //Insertamos el producto
    try {
        $consulta = "INSERT producto (cod, nombre, nombre_corto, descripcion, PVP, familia) VALUES(?,?,?,?,?,?)";
        $sentencia = $conexion->prepare($consulta);
        //Si pasamos un array debemos asegurar que el orden sea el correcto
        $sentencia->execute($datos);
    } catch (PDOException $e) {
        //Cerramos conexiones y sentencias
        $sentencia = null;
        $conexion = null;
        //Mostramos el mensaje de error
        $respuesta["error"] = "No se ha podido insertar el producto: " . $e->getMessage();
        return $respuesta;
    }

        $respuesta['mensaje'] = "El producto con código ".$datos[0]." se ha insertado correctamente";
     


    //Con la sentencia devolvemos el resultado
    $sentencia = null;
    $conexion = null;

    return $respuesta;
}

function actualizar_producto($datos)
{
    //Conectamos con la bd
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD . "", USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        //Mostramos el mensaje de error sin cerrar nada porque no se ha llegado a abrir
        $respuesta["error"] = "No se ha podido conectar a la BD: " . $e->getMessage();
        return $respuesta;
    }


    //Insertamos el producto
    try {
        $consulta = "UPDATE producto SET nombre=?, nombre_corto=?, descripcion=?, PVP=?, familia=? WHERE cod=?";
        $sentencia = $conexion->prepare($consulta);
        //Si pasamos un array debemos asegurar que el orden sea el correcto
        $sentencia->execute($datos);
    } catch (PDOException $e) {
        //Cerramos conexiones y sentencias
        $sentencia = null;
        $conexion = null;
        //Mostramos el mensaje de error
        $respuesta["error"] = "No se ha podido insertar el producto: " . $e->getMessage();
        return $respuesta;
    }

        $respuesta['mensaje'] = "El producto con código ".end($datos)." se ha insertado correctamente";
     


    //Con la sentencia devolvemos el resultado
    $sentencia = null;
    $conexion = null;

    return $respuesta;
}
?>