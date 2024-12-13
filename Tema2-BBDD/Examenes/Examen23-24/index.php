<?php
session_name("Examen_PHP");
session_start();
require("src/funciones.php");



if (isset($_POST['verHorario']) || isset($_POST['btnEditar'])) {
    if (isset($_POST['verHorario'])) {
        $id = $_POST['horario'];
    } else {
        $id = substr($_POST['btnEditar'], 0, 1);
        echo $id;
    }
    try {
        $consulta2 = "select usuarios.id_usuario, horario_lectivo.hora, horario_lectivo.dia, grupos.nombre
                    from horario_lectivo
                    join grupos on horario_lectivo.grupo = grupos.id_grupo 
                    join usuarios on horario_lectivo.usuario = usuarios.id_usuario
                    where horario_lectivo.usuario = '" . $id . "'";
        $detalle_horario = mysqli_query($conexion, $consulta2);
        $n_tuplas = mysqli_num_rows($detalle_horario);
    } catch (Exception $e) {
        mysqli_close($conexion);
        session_destroy();
        die("No se ha podido realizar la consulta " . $e->getMessage() . "");
    }
}


try {
    $consulta = "select * from usuarios";
    $usuarios = mysqli_query($conexion, $consulta);
    mysqli_close($conexion);
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

    if (isset($_POST['verHorario'])) {
        require("vistas/vista_tabla.php");
            // echo "<h3>Editando la 2º Hora ("..") del ".."</h3>";
    }

    
    
    
    
    

    mysqli_free_result($usuarios);
    ?>
</body>

</html>