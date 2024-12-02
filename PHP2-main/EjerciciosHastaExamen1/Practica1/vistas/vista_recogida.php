<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recogida de datos</title>
    <style>
        .tam_imag {
            width: 35%
        }
    </style>
</head>

<body>
    <h1>DATOS ENVIADOS</h1>
    <?php
    echo "<p><strong>Nombre: </strong> " . $_POST["nombre"] . "</p>";
    echo "<p><strong>Usuario: </strong> " . $_POST["usuario"] . "</p>";
    echo "<p><strong>Contraseña: </strong> " . $_POST["clave"] . "</p>";
    echo "<p><strong>DNI: </strong>" . $_POST["dni"] . "</p>";
    echo "<p><strong>Sexo: </strong>" . $_POST["sexo"] . "</p>";
    echo "<p><strong>Nacido: </strong>" . $_POST["nacido"] . "</p>";
    if ($_POST['comentario'] == '') {
        echo "<p><strong>Comentarios: </strong> No hay comentarios.</p>";
    } else {
        echo "<p><strong>Comentarios: </strong>" . $_POST["comentario"] . "</p>";
    }
    if (isset($_POST["novedades"])) {
        echo "<p><strong>Suscripción: </strong> Sí.</p>";
    } else {
        echo "<p><strong>Suscripción: </strong> No aceptada.</p>";
    }
    if ($_FILES['archivo']['name'] == '') {
        echo "<p><strong>Foto: </strong> Foto no seleccionada.</p>";
    } else {
        $nombre_nuevo = md5(uniqid(uniqid(), true)); // Para crear una serie de números únicos
        $array_nombre = explode('.', $_FILES['archivo']['name']);
        $ext = ""; // extensión
        // Si el nombre dividido por . tiene mas de 1 parte, tiene extensión
        if (count($array_nombre) > 1) {
            $ext = '.' . end($array_nombre); // El último sería la extensión
        }
        $nombre_nuevo .= $ext;
        @$var = move_uploaded_file($_FILES['archivo']['tmp_name'], 'images/' . $nombre_nuevo);
        if ($var) {
    ?>
            <h3>Información de la imagen seleccionada</h3>
            <p><strong>Error: </strong><?php echo $_FILES['archivo']['error'] ?></p>
            <p><strong>Nombre: </strong><?php echo $_FILES['archivo']['name'] ?></p>
            <p><strong>Ruta en Servidor: </strong><?php echo $_FILES['archivo']['tmp_name'] ?></p>
            <p><strong>Tipo archivo: </strong><?php echo $_FILES['archivo']['type'] ?></p>
            <p><strong>Tamaño archivo: </strong><?php echo $_FILES['archivo']['size'] ?></p>
            <p>La imagen ha sido subida con éxito</p>
            <p><img class="tam_imag" src="images/<?php echo $nombre_nuevo ?>" alt="Foto" title="Foto" /></p>
    <?php
        }
    }
    ?>
</body>

</html>