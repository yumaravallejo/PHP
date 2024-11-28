<?php
session_name("inicio");
session_start();
require("src/funciones.php");

if (isset($_POST['btnCerrarSesion'])) {
    session_destroy();
    header("Location: index.php");
}

if (isset($_SESSION['usuario']) && $_SESSION['usuario']['tipo'] == "admin") {
    try {
        $consulta = "SELECT * FROM usuarios";
        $usuarios = mysqli_query($conexion, $consulta);
        $n_tuplas = mysqli_num_rows($usuarios);
    } catch (Exception $e) {
        session_destroy();
        mysqli_close($conexion);
        die("<p>No se ha podido realizar la consulta en la BD " . $e->getMessage() . "</p>");
    }

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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cruds completos</title>
    <style>
        body {text-align: center;}
        table {border-collapse: collapse; text-align: center; margin: 0 auto;}
        td, th, table {border: 1px solid black; padding: 0.5rem}
</style>
</head>

<body>
    <?php
    if (isset($_SESSION['usuario'])) {
        //Pasar por seguridad.php para control de baneo

        if ($_SESSION['usuario']['tipo'] == "normal"){
            require("vistas/vista_normal.php");
        } else {
            //Si no es normal es admin
            require("vistas/vista_admin.php");
            if (isset($_POST['verHorario'])) {
                require ("vistas/vista_tabla.php");
            }
            mysqli_free_result($usuarios);
        }        
    } else {
        require("vistas/vista_login.php");
    }

    
    ?>
</body>

</html>