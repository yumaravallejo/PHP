<?php
try{
    $consulta="SELECT * FROM libros";
    $result_libros=$conexion->prepare($consulta);
    $result_libros->execute();
}
catch(Exception $e){
    session_destroy();
    $sentencia = null;
    $conexion = null;
    die(error_page("Examen2 Php PDO","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen2 Php PDO</title>
    <style>
        .contenedor_libros{display:flex;flex-flow: row wrap;}
        .contenedor_libros div{width:30%;text-align:center; margin-top: auto}
        .contenedor_libros div img{height:150px}
        .mensaje{font-size:1.25em;color:blue}
        .error{color:red}
    </style>
</head>
<body>
    <h1>Libreria</h1>
    <div>
        Bienvenido <strong><?php echo $datos_lector_log["lector"];?></strong> - <form class="enlinea" action="index.php" method="post"><button class="enlace" type="submit" name="btnCerrarSesion">Salir</button></form>
    </div>
    <?php
    require "vistas/libros_tres_en_tres.php";
    ?>
</body>
</html>