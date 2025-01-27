<?php
CONST SERVIDOR_BD = "localhost";
CONST NOMBRE_BD = "bd_tienda";
CONST USER_BD = "jose";
CONST CLAVE_BD = "josefa";
CONST PASSWORD_API = "PASSWORD_DE_MI_APLICACION";

function obtener_productos() {
    //Nos conectamos a la BD
    try {
        $conexion= new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta['error'] = "Imposible conectar con la BD ".$e->getMessage();
        return $respuesta;
    }

    //Si funciona hacemos la consulta
    try {
        $consulta = "SELECT * FROM producto";
        $sentencia = $conexion -> prepare($consulta);
        $sentencia->execute();
    } catch (PDOException $e) {
        $conexion = null;
        $sentencia = null;
        $respuesta['error'] = "Imposible realizar la sentencia ".$e->getMessage();
        return $respuesta;
    }

    //Si llega hasta aquí significará que todo está correcto
    $respuesta['productos'] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    $conexion = null;
    $sentencia = null;
    return $respuesta;
}

function obtener_producto($id) {
    //Nos conectamos a la BD
    try {
        $conexion= new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta['error'] = "Imposible conectar con la BD ".$e->getMessage();
        return $respuesta;
    }

    //Si funciona hacemos la consulta
    try {
        $consulta = "SELECT * FROM producto WHERE cod=?";
        $sentencia = $conexion -> prepare($consulta);
        $sentencia->execute($id);
    } catch (PDOException $e) {
        $conexion = null;
        $sentencia = null;
        $respuesta['error'] = "Imposible realizar la sentencia ".$e->getMessage();
        return $respuesta;
    }

    //Si llega hasta aquí significará que todo está correcto
    if($sentencia->rowCount()>0){
        $respuesta['producto'] = $sentencia->fetch(PDO::FETCH_ASSOC);
    } else {
        $respuesta['mensaje'] = "No existe este producto";
    }
    
    $conexion = null;
    $sentencia = null;
    return $respuesta;
}

function insertar_producto($datos) {
    //Nos conectamos a la BD
    try {
        $conexion= new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta['error'] = "Imposible conectar con la BD ".$e->getMessage();
        return $respuesta;
    }

    //Si funciona hacemos la consulta
    try {
        $consulta = "INSERT INTO producto (cod, nombre, nombre_corto, descripcion, PVP, familia) VALUES (?,?,?,?,?,?)";
        $sentencia = $conexion -> prepare($consulta);
        $sentencia->execute($datos);
    } catch (PDOException $e) {
        $conexion = null;
        $sentencia = null;
        $respuesta['error'] = "Imposible realizar la sentencia ".$e->getMessage();
        return $respuesta;
    }

    //Si llega hasta aquí significará que todo está correcto
    $respuesta['mensaje'] = "El producto (".$datos['nombre_corto'].") se ha insertado correctamente";
    
    $conexion = null;
    $sentencia = null;
    return $respuesta;
}


function actualizar_producto($datos) {
    //Nos conectamos a la BD
    try {
        $conexion= new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta['error'] = "Imposible conectar con la BD ".$e->getMessage();
        return $respuesta;
    }

    //Si funciona hacemos la consulta
    try {
        $consulta = "UPDATE producto SET nombre=?, nombre_corto=?, descripcion=?, PVP=?, familia=? WHERE cod=?";
        $sentencia = $conexion -> prepare($consulta);
        $sentencia->execute($datos);
    } catch (PDOException $e) {
        $conexion = null;
        $sentencia = null;
        $respuesta['error'] = "Imposible realizar la sentencia ".$e->getMessage();
        return $respuesta;
    }

    //Si llega hasta aquí significará que todo está correcto
    $respuesta['mensaje'] = "El producto (".$datos['nombre_corto'].") se ha actualizado correctamente";
    
    $conexion = null;
    $sentencia = null;
    return $respuesta;
}

function borrar_producto($codigo) {
    //Nos conectamos a la BD
    try {
        $conexion= new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta['error'] = "Imposible conectar con la BD ".$e->getMessage();
        return $respuesta;
    }

    //Si funciona hacemos la consulta
    try {
        $consulta = "DELETE FROM producto WHERE cod=?";
        $sentencia = $conexion -> prepare($consulta);
        $sentencia->execute($codigo);
    } catch (PDOException $e) {
        $conexion = null;
        $sentencia = null;
        $respuesta['error'] = "Imposible realizar la sentencia ".$e->getMessage();
        return $respuesta;
    }

    //Si llega hasta aquí significará que todo está correcto
    $respuesta['mensaje'] = "El producto (".$codigo.") se ha eliminado correctamente";
    
    $conexion = null;
    $sentencia = null;
    return $respuesta;
}

function obtener_familias() {
    //Nos conectamos a la BD
    try {
        $conexion= new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta['error'] = "Imposible conectar con la BD ".$e->getMessage();
        return $respuesta;
    }

    //Si funciona hacemos la consulta
    try {
        $consulta = "SELECT * FROM familia";
        $sentencia = $conexion -> prepare($consulta);
        $sentencia->execute();
    } catch (PDOException $e) {
        $conexion = null;
        $sentencia = null;
        $respuesta['error'] = "Imposible realizar la sentencia ".$e->getMessage();
        return $respuesta;
    }

    //Si llega hasta aquí significará que todo está correcto
    $respuesta['familias'] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    $conexion = null;
    $sentencia = null;
    return $respuesta;
}

function repetido_insertar($tabla, $columna, $valor) {
    //Nos conectamos a la BD
    try {
        $conexion= new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta['error'] = "Imposible conectar con la BD ".$e->getMessage();
        return $respuesta;
    }

    //Si funciona hacemos la consulta
    try {
        $consulta = "SELECT ".$columna." FROM ".$tabla." WHERE ".$columna."=? ";
        $sentencia = $conexion -> prepare($consulta);
        $sentencia->execute($valor);
    } catch (PDOException $e) {
        $conexion = null;
        $sentencia = null;
        $respuesta['error'] = "Imposible realizar la sentencia ".$e->getMessage();
        return $respuesta;
    }

    //Si llega hasta aquí significará que todo está correcto
    if ($sentencia->rowCount() > 0) return true;
    else return false;

    $conexion = null;
    $sentencia = null;
    return $respuesta;
}

function repetido_editar($tabla, $columna, $valor, $columna_id, $valor_id) {
    //Nos conectamos a la BD
    try {
        $conexion= new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta['error'] = "Imposible conectar con la BD ".$e->getMessage();
        return $respuesta;
    }

    //Si funciona hacemos la consulta
    try {
        $consulta = "SELECT ".$columna." FROM ".$tabla." WHERE ".$columna."=? AND ".$columna_id."=?";
        $sentencia = $conexion -> prepare($consulta);
        $sentencia->execute($valor, $valor_id);
    } catch (PDOException $e) {
        $conexion = null;
        $sentencia = null;
        $respuesta['error'] = "Imposible realizar la sentencia ".$e->getMessage();
        return $respuesta;
    }

    //Si llega hasta aquí significará que todo está correcto
    if ($sentencia->rowCount() > 0) return true;
    else return false;

    $conexion = null;
    $sentencia = null;
    return $respuesta;
}



?>