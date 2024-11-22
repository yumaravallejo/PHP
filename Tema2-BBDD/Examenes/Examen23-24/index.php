<?php
session_name("Examen_PHP");
session_start();
require("src/funciones.php");



if (isset($_POST['verHorario']) ) {
    if (isset($_POST['verHorario'])){
    try {
        $consulta1 = "select * from usuarios where id_usuario = '".$_POST['horario']."'";
        $detalle_usuario = mysqli_query($conexion, $consulta1);
        $user = mysqli_fetch_assoc($detalle_usuario);
        mysqli_free_result($detalle_usuario);

        $consulta2 = "select horario_lectivo.hora, horario_lectivo.dia, grupos.nombre
                    from horario_lectivo
                    join grupos on horario_lectivo.grupo = grupos.id_grupo 
                    join usuarios on horario_lectivo.usuario = usuarios.id_usuario
                    where horario_lectivo.usuario = '" . $_POST['horario'] . "'";
        $detalle_horario = mysqli_query($conexion, $consulta2);
        $n_tuplas = mysqli_num_rows($detalle_horario);
        
    } catch (Exception $e) {
        mysqli_close($conexion);
        session_destroy();
        die("No se ha podido realizar la consulta " . $e->getMessage() . "");
    }
}
}


try {
    $consulta = "select * from usuarios";
    $usuarios = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    mysqli_close($conexion);
    session_destroy();
    die("No se ha podido realizar la consulta " . $e->getMessage() . "");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen2 PHP</title>
    <style>
        table {
            border-collapse: collapse;
        }

        table,
        td,
        th {
            border: 1px solid black;
            text-align: center;
            padding: 1rem;
        }

        .enlace {
            border: none;
            background-color: white;
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1>Examen2 PHP</h1>
    <h2>Horario de los Profesores</h2>
    <?php

    require("vistas/vista_principal.php");
    if (isset($_POST['verHorario']) ||  isset($_POST['btnEditar'])) {
        require("vistas/vista_tabla.php");
    }

    if (isset($_POST['btnEditar']))
            require("vistas/vista_editar.php");

    

    mysqli_free_result($usuarios);
    ?>
</body>

</html>