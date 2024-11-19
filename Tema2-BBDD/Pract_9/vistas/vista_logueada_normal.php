<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primer Login</title>
    <style>.enLinea{display: inline;}
            .enlace{background:none; color: blue; border:none; text-decoration: underline;}
    </style>
</head>

<body>
    <h1>Primer Login</h1>
    <div>
        Bienvenido - <strong><?php echo $datos_usuario_log['usuario'];?></strong>
        <form action="index.php" method="post"><button class='enlace' type="submit" name="btnCerrarSesion">Cerrar Sesión</button></form>
        <h2>Eres <?php echo $datos_usuario_log['tipo']; ?></h2>
    </div>
</body>

</html>