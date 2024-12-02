<?php
require "config_bd.php";

function conexion_pdo()
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

        $respuesta["mensaje"] = "Conexi&oacute;n a la BD realizada con &eacute;xito";

        $conexion = null;
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
    }
    return $respuesta;
}

// Login
function login($usuario, $clave)
{
    // Conexión
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        return array("error" => "Imposible conectar:" . $e->getMessage());
    }

    // Consulta
    try {
        $consulta = "select * from usuarios where usuario = ? and clave = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$usuario, $clave]);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        return array("error" => "Imposible realizar la consulta:" . $e->getMessage());
    }

    if ($sentencia->rowCount() > 0) {
        // Si está en la bd, lo logueamos
        $respuesta["usuario"] = $sentencia->fetch(PDO::FETCH_ASSOC);
        session_name("Examen_SW_22_23");
        session_start();
        $_SESSION["usuario"] = $respuesta["usuario"]["usuario"];
        $_SESSION["clave"] = $respuesta["usuario"]["clave"];
        $_SESSION["tipo"] = $respuesta["usuario"]["tipo"];
        $respuesta["api_session"] = session_id();
    } else {
        // Si no le decimos que no está en la bd
        $respuesta["mensaje"] = "El usuario no se encuentra registrado en la BD";
    }

    $sentencia = null;
    $conexion = null;
    return $respuesta;
}

// Logueado
function logueado($usuario, $clave)
{
    // Conexión
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        return array("error" => "Imposible conectar:" . $e->getMessage());
    }

    // Consulta
    try {
        $consulta = "select * from usuarios where usuario = ? and clave = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$usuario, $clave]);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        return array("error" => "Imposible realizar la consulta:" . $e->getMessage());
    }

    if ($sentencia->rowCount() > 0) {
        // Si está en la bd, devolvemos sus datos
        $respuesta["usuario"] = $sentencia->fetch(PDO::FETCH_ASSOC);
    } else {
        // Si no le mostramos un mensaje de que no se encuentra en la bd
        $respuesta["mensaje"] = "El usuario no se encuentra registrado en la BD";
    }

    $sentencia = null;
    $conexion = null;
    return $respuesta;
}



// Obtener profesores
function obtener_profesores()
{
    // Conexión
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        return array("error" => "Imposible conectar:" . $e->getMessage());
    }

    // Consulta
    try {
        $consulta = "select * from usuarios where tipo =?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute(["normal"]);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        return array("error" => "Imposible realizar la consulta:" . $e->getMessage());
    }

    if ($sentencia->rowCount() > 0) {
        // Si está en la bd, devolvemos sus datos
        $respuesta["profesores"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // Si no le mostramos un mensaje de que no se encuentra en la bd
        $respuesta["mensaje"] = "No hay profesores registrados en la BD";
    }

    $sentencia = null;
    $conexion = null;
    return $respuesta;
}

// Obtener horario
function obtener_horario($id_profesor)
{
    // Conexión
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        return array("error" => "Imposible conectar:" . $e->getMessage());
    }

    // Consulta
    try {
        $consulta = "select usuario, dia, hora, grupo, nombre from grupos, horario_lectivo where id_grupo=grupo and usuario=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$id_profesor]);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        return array("error" => "Imposible realizar la consulta:" . $e->getMessage());
    }

    // Devolvemos el horario
    $respuesta["horario"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    $sentencia = null;
    $conexion = null;
    return $respuesta;
}

// Obtener grupos que tiene un profesor a un dia y una hora concreta
function obtener_grupos($profesores, $dia, $hora)
{
    // Conexión
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        return array("error" => "Imposible conectar:" . $e->getMessage());
    }

    // Consulta
    try {
        $consulta = "select id_grupo, nombre from grupos, horario_lectivo where id_grupo=grupo and usuario=? and dia=? and hora=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$profesores, $dia, $hora]);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        return array("error" => "Imposible realizar la consulta:" . $e->getMessage());
    }

    // Devolvemos los grupos
    $respuesta["grupos"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    $sentencia = null;
    $conexion = null;
    return $respuesta;
}


// Obtener grupos que no tiene el profesor tal dia a tal hora
function obtener_no_grupos($profesores, $dia, $hora)
{
    // Conexión
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        return array("error" => "Imposible conectar:" . $e->getMessage());
    }

    // Consulta
    try {
        $consulta = "select id_grupo, nombre from grupos where id_grupo not in (select id_grupo from grupos, horario_lectivo where id_grupo=grupo and usuario=? and dia=? and hora=?)";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$profesores, $dia, $hora]);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        return array("error" => "Imposible realizar la consulta:" . $e->getMessage());
    }

    // Devolvemos los grupos
    $respuesta["grupos"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    $sentencia = null;
    $conexion = null;
    return $respuesta;
}


// Borrar grupo de un profesor a tal dia y tal hora
function borrar_grupo($profesores, $dia, $hora, $grupo)
{
    // Conexión
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        return array("error" => "Imposible conectar:" . $e->getMessage());
    }

    // Consulta
    try {
        $consulta = "delete from horario_lectivo where usuario=? and dia=? and hora=? and grupo=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$profesores, $dia, $hora, $grupo]);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        return array("error" => "Imposible realizar la consulta:" . $e->getMessage());
    }

    // Devolvemos confirmación
    $respuesta["mensaje"] = "Grupo borrado con éxito";

    $sentencia = null;
    $conexion = null;
    return $respuesta;
}


// Insertar grupo de un profesor a tal dia y tal hora
function insertar_grupo($profesores, $dia, $hora, $grupo)
{
    // Conexión
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        return array("error" => "Imposible conectar:" . $e->getMessage());
    }

    // Consulta
    try {
        $consulta = "INSERT INTO horario_lectivo (usuario, dia, hora, grupo) VALUES (?,?,?,?)";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$profesores, $dia, $hora, $grupo]);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        return array("error" => "Imposible realizar la consulta:" . $e->getMessage());
    }

    // Devolvemos confirmación
    $respuesta["mensaje"] = "Grupo insertado con éxito";

    $sentencia = null;
    $conexion = null;
    return $respuesta;
}
