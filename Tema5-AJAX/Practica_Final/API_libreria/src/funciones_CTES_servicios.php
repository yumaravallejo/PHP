<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require 'Firebase/autoload.php';

define("PASSWORD_API", "Una_clave_para_usar_para_encriptar");
define("TIEMPO_MINUTOS_API", 60);
define("SERVIDOR_BD", "localhost");
define("USUARIO_BD", "jose");
define("CLAVE_BD", "josefa");
define("NOMBRE_BD", "bd_libreria_exam");

function validateToken() {
    $headers = apache_request_headers();
    if (!isset($headers["Authorization"]))
        return false; 
    else {
        $authorization = $headers["Authorization"];
        $authorizationArray = explode(" ", $authorization);
        $token = $authorizationArray[1];
        try {
            $info = JWT::decode($token, new Key(PASSWORD_API, 'HS256'));
        } catch (\Throwable $th) {
            return false;
        }
        
        try {
            $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, 
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        } catch (PDOException $e) {
            $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
            return $respuesta;
        }
        
        try {
            $consulta = "select * from usuarios where id_usuario=?";
            $sentencia = $conexion->prepare($consulta);
            $sentencia->execute([$info->data]);
        } catch (PDOException $e) {
            $respuesta["error"] = "Imposible realizar la consulta:" . $e->getMessage();
            $sentencia = null;
            $conexion = null;
            return $respuesta;
        }
        
        if ($sentencia->rowCount() > 0) {
            $respuesta["usuario"] = $sentencia->fetch(PDO::FETCH_ASSOC);
            $payload['exp'] = time() + TIEMPO_MINUTOS_API * 60;
            $payload['data'] = $respuesta["usuario"]["id_usuario"];
            $jwt = JWT::encode($payload, PASSWORD_API, 'HS256');
            $respuesta["token"] = $jwt;
        }
        else
            $respuesta["mensaje_baneo"] = "El usuario no se encuentra registrado en la BD";
        
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    }
}

function login($datos_login) {
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, 
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No he podido conectarse a la base de batos: " . $e->getMessage();
        return $respuesta;
    }
    
    try {
        $consulta = "select * from usuarios where lector=? and clave=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute($datos_login);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No he podido realizarse la consulta: " . $e->getMessage();
        return $respuesta;
    }
    
    if ($sentencia->rowCount() > 0) {
        $respuesta["usuario"] = $sentencia->fetch(PDO::FETCH_ASSOC);
        $payload['exp'] = time() + TIEMPO_MINUTOS_API * 60;
        $payload['data'] = $respuesta["usuario"]["id_usuario"];
        $jwt = JWT::encode($payload, PASSWORD_API, 'HS256');
        $respuesta["token"] = $jwt;
    }
    else
        $respuesta["mensaje"] = "El usuario no se encuentra en la BD";
    
    $sentencia = null;
    $conexion = null;
    return $respuesta;
}

function obtener_libros() {
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, 
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No he podido conectarse a la base de batos: " . $e->getMessage();
        return $respuesta;
    }
    
    try {
        $consulta = "select * from libros";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No he podido realizarse la consulta: " . $e->getMessage();
        return $respuesta;
    }
    
    $respuesta["libros"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia = null;
    $conexion = null;
    return $respuesta;
}

function obtener_libro($referencia) {
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, 
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No he podido conectarse a la base de batos: " . $e->getMessage();
        return $respuesta;
    }
    
    try {
        $consulta = "select * from libros where referencia=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$referencia]);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No he podido realizarse la consulta: " . $e->getMessage();
        return $respuesta;
    }
    
    $respuesta["libro"] = $sentencia->fetch(PDO::FETCH_ASSOC);
    $sentencia = null;
    $conexion = null;
    return $respuesta;
}

function crear_libro($referencia, $titulo, $autor, $descripcion, $precio) {
    $respuesta = array();
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, 
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar: " . $e->getMessage();
        return $respuesta;
    }
    
    try {
        $consulta = "SELECT referencia FROM libros WHERE referencia = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$referencia]);
        if ($sentencia->rowCount() > 0) {
            $respuesta["error"] = "La referencia ya existe.";
            return $respuesta;
        }
    } catch (PDOException $e) {
        $respuesta["error"] = "Error al verificar duplicidad: " . $e->getMessage();
        return $respuesta;
    }
    
    $portada = "no_imagen.jpg";
    if (isset($_POST["portada"]) && $_POST["portada"] != "")
        $portada = $_POST["portada"];
    else if (isset($_FILES["portada"]) && $_FILES["portada"]["error"] === 0 && $_FILES["portada"]["name"] != "") {
        $extension = pathinfo($_FILES["portada"]["name"], PATHINFO_EXTENSION);
        $nuevo_nombre = "img_" . $referencia . "." . $extension;
        $ruta_destino = __DIR__ . "/../../images/" . $nuevo_nombre;
        if (move_uploaded_file($_FILES["portada"]["tmp_name"], $ruta_destino))
            $portada = $nuevo_nombre;
        else
            $respuesta["error"] = "No se pudo mover el fichero, se usará no_imagen.jpg";
    }
    
    try {
        $consulta = "INSERT INTO libros (referencia, titulo, autor, descripcion, precio, portada) VALUES (?, ?, ?, ?, ?, ?)";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$referencia, $titulo, $autor, $descripcion, $precio, $portada]);
        $respuesta["mensaje"] = "Libro insertado correctamente en la BD";
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible realizar la consulta: " . $e->getMessage();
        return $respuesta;
    }
    return $respuesta;
}

function actualizar_libro($referencia, $titulo, $autor, $descripcion, $precio) {
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, 
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No he podido conectarse a la base de batos: " . $e->getMessage();
        return $respuesta;
    }
    
    try {
        $consulta = "UPDATE libros SET titulo = ?, autor = ?, descripcion = ?, precio = ? WHERE referencia = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$titulo, $autor, $descripcion, $precio, $referencia]);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No he podido realizarse la consulta: " . $e->getMessage();
        return $respuesta;
    }
    
    $respuesta["mensaje"] = "Libro actualizado correctamente en la BD";
    $sentencia = null;
    $conexion = null;
    return $respuesta;
}

function borrar_libro($referencia) {
    $respuesta = array();
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, 
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No he podido conectarme a la BD: " . $e->getMessage();
        return $respuesta;
    }
    
    try {
        $consulta = "SELECT portada FROM libros WHERE referencia = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$referencia]);
        $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
        $portada = (isset($resultado["portada"]) && $resultado["portada"] != "") ? $resultado["portada"] : "no_imagen.jpg";
    } catch (PDOException $e) {
        $respuesta["error"] = "Error al obtener la portada: " . $e->getMessage();
        return $respuesta;
    }
    
    if ($portada != "no_imagen.jpg") {
        $ruta_imagen = __DIR__ . "/../../images/" . $portada;
        if (file_exists($ruta_imagen)) {
            if (!unlink($ruta_imagen))
                $respuesta["error_img"] = "Error al eliminar la imagen asociada.";
        }
    }
    
    try {
        $consulta = "DELETE FROM libros WHERE referencia = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$referencia]);
    } catch (PDOException $e) {
        $respuesta["error"] = "No he podido realizar la consulta: " . $e->getMessage();
        return $respuesta;
    }
    
    $respuesta["mensaje"] = "Libro borrado correctamente en la BD";
    return $respuesta;
}

function actualizar_portada($referencia, $portada) {
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, 
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No he podido conectarse a la BD: " . $e->getMessage();
        return $respuesta;
    }
    
    try {
        $consulta = "UPDATE libros SET portada = ? WHERE referencia = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$portada, $referencia]);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No he podido realizarse la consulta: " . $e->getMessage();
        return $respuesta;
    }
    
    $respuesta["mensaje"] = "Portada cambiada correctamente en la BD";
    $sentencia = null;
    $conexion = null;
    return $respuesta;
}

function repetido_insertando($tabla, $columna, $valor) {
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, 
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No he podido conectarse a la base de datos: " . $e->getMessage();
        return $respuesta;
    }
    
    try {
        $consulta = "SELECT " . $columna . " FROM " . $tabla . " WHERE " . $columna . " = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$valor]);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No he podido realizarse la consulta: " . $e->getMessage();
        return $respuesta;
    }
    
    $respuesta["repetido"] = ($sentencia->rowCount() > 0);
    $sentencia = null;
    $conexion = null;
    return $respuesta;
}

function repetido_editando($tabla, $columna, $valor, $columna_id, $valor_id) {
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, 
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No he podido conectarse a la base de datos: " . $e->getMessage();
        return $respuesta;
    }
    
    try {
        $consulta = "SELECT " . $columna . " FROM " . $tabla . " WHERE " . $columna . " = ? AND " . $columna_id . " <> ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$valor, $valor_id]);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No he podido realizarse la consulta: " . $e->getMessage();
        return $respuesta;
    }
    
    $respuesta["repetido"] = ($sentencia->rowCount() > 0);
    $sentencia = null;
    $conexion = null;
    return $respuesta;
}
?>
