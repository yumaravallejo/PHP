<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría PDO</title>
</head>

<body>
    <h1>Teoría PDO</h1>
    <?php
    const SERVIDOR_BD = "localhost"; //define("SERVIDOR_BD", "localhost")
    const USUARIO_BD = "jose";
    const CLAVE_BD = "josefa";
    const NOMBRE_BD = "bd_cv2";

    // try {
    //     @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
    //     mysqli_set_charset($conexion, "utf8");
    // } catch (Exception $e) {
    //     session_destroy();
    //     die(error_page("Primer Login", "<p>No se ha podido conectar a la BD: " . $e->getMessage() . "</p>"));
    // }

    // echo "<h2>Conectado</h2>";

    /*Creamos un objeto PDO para conectarnos*/
    try {  
        $conexion = new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD."", USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        die ("<p>No se ha podido conectar a la BD ".$e->getMessage()."</p></body></html>");
    }

    $usuario="jsm_117";
    $clave = md5("123456");

    try {  
        $consulta = "SELECT * FROM usuarios"; //where usuario=? and clave=?
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute(); //([$usuario, $clave])
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        die ("<p>No se ha podido conectar a la BD ".$e->getMessage()."</p>");
    }

    if ($sentencia->rowCount()<=0){
        echo "<p>No hay usuarios con esas credenciales en la BD</p>";
    } else {
        $usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        echo "<h3>Listado de los usuarios</h3>";
        echo "<ol>";
        foreach($usuarios as $tupla) {
            echo "<li>".$tupla['nombre']."</li>";
        }
        echo "</ol>";
    }

    //Puedo coger todas las tuplas de golpe con fetchAll (necesitan ser recorridas)

    try {  
        $consulta = "INSERT INTO usuarios(nombre, usuario, clave, dni, sexo) VALUES(?,?,?,?,?)"; //where usuario=? and clave=?
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute(['Yumara Vallejo','humiyummy',md5('123456'),'79149929Y','mujer']); //([$usuario, $clave])
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        die ("<p>No se ha podido conectar a la BD ".$e->getMessage()."</p>");
    }

    echo "<p>Usuario insertado con éxito con la id --> ".$conexion->lastInsertId()."</p>";
    //Cerramos sentencia
    $sentencia = null;

    //Cerramos $conexion
    $conexion = null;
    ?>
</body>

</html>