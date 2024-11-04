<?php
/* CONEXIÓN BBDD */
const SERVIDOR_BD = "localhost";
const USUARIO_BD = "jose";
const CONTRASENIA_BD = "josefa";
const NOMBRE_BD = "bd_foro";

function error_page($title, $body)
{
    return '<!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>' . $title . '</title>
            </head>

            <body>
                ' . $body . '
            </body>

            </html>';
}

try {
    @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CONTRASENIA_BD, NOMBRE_BD);
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    die(error_page("Primer Crud", "<p>No se ha podido conectar con la base de datos" . $e->getMessage() . "</p>"));
}

try {
    $sentencia = "SELECT * from usuarios";
    $consulta = mysqli_query($conexion, $sentencia);
} catch (Exception $e) {
    mysqli_close($conexion);
    die(error_page("Primer Crud", "<p>No se ha podido realizar la consulta" . $e->getMessage() . "</p>"));
}

if (isset($_POST['btnDetalles'])) {
    try {
        $sentencia = "SELECT * from usuarios where cod_user=".$_POST['btnDetalles']."";
        $detalle = mysqli_query($conexion, $sentencia);
    } catch (Exception $e) {
        mysqli_close($conexion);
        die(error_page("Primer Crud", "<p>No se ha podido realizar la consulta" . $e->getMessage() . "</p>"));
    }
}

if (isset($_POST['btnBorrar'])) {
    try {
        $sentencia = "SELECT * from usuarios where cod_user=".$_POST['btnBorrar']."";
        $datosUser = mysqli_query($conexion, $sentencia);
    } catch (Exception $e) {
        mysqli_close($conexion);
        die(error_page("Primer Crud", "<p>No se ha podido realizar la consulta" . $e->getMessage() . "</p>"));
    }
}

if (isset($_POST['btnBorrarSeguro'])) {
    try {
        $sentencia = "DELETE from usuarios where cod_user=".$_POST['btnBorrarSeguro']."";
        $detalle = mysqli_query($conexion, $sentencia);
    } catch (Exception $e) {
        mysqli_close($conexion);
        die(error_page("Primer Crud", "<p>No se ha podido realizar la consulta" . $e->getMessage() . "</p>"));
    }
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primer CRUD</title>
    <style>
        table,
        td,
        th {
            border: 1px solid black;
            padding: 5px;
        }

        table {
            border-collapse: collapse;
        }

        .detalle {
            border: none;
            background: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1>Listado de los Usuarios</h1>

    <table>
        <tr>
            <th>Nombre</th>
            <th>Borrar</th>
            <th>Editar</th>
        </tr>
        <?php
        while ($dato_user = mysqli_fetch_assoc($consulta)) {
            echo "<tr>";
            echo "<td><form action='index.php' method='post'><button class='detalle' name='btnDetalles' title='Ver detalles' value='" . $dato_user['cod_user'] . "' type='submit'>" . $dato_user['nombre'] . "</button></td></form>";
            echo "<td><form action='index.php' method='post'><button class='detalle' name='btnBorrar' title='Eliminar Usuario' value='" . $dato_user['cod_user'] . "' type='submit'><img width='30px' src='images/borrar.jpg'></button></td>";
            echo "<td><form action='index.php' method='post'><button class='detalle' name='btnEditar' title='Editar Usuario' value='" . $dato_user['cod_user'] . "' type='submit'><img width='30px' src='images/editar2.png'></button></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <?php
    mysqli_free_result($consulta);

    if (isset($_POST['btnDetalles'])) {
        if(mysqli_num_rows($detalle)>0) {
            $tupla_detalle = mysqli_fetch_assoc($detalle);
            mysqli_free_result($detalle);

            echo "<h2>Detalles del usuario " . $_POST["btnDetalles"] . "</h2>";
            echo "<p>";
            echo "<strong>Nombre: </strong>". $tupla_detalle['nombre']. "<br>";
            echo "<strong>Usuario: </strong>". $tupla_detalle['usuario']. "<br>";
            echo "<strong>Clave: </strong><br>";
            echo "<strong>Email: </strong>". $tupla_detalle['email']. "<br>";
            echo "</p>";
        } else {
            echo "<p>El usuario ya no se encuentra registrado en la BD</p>";
        }
    }

    if (isset($_POST['btnBorrar'])) {
        if(mysqli_num_rows($datosUser)>0) {
            $tupla_borrar = mysqli_fetch_assoc($datosUser);
            mysqli_free_result($datosUser);
            echo "<p>Se dispone usted a borrar el usuario <strong>".$tupla_borrar['nombre']."</strong></p>";

            echo "<form action='index.php' method='post'><button name='btnBorrarSeguro' title='Borrar el usuario' value='" . $tupla_borrar['cod_user'] . "' type='reset'>Continuar</button>";
            echo "<form action='index.php' method='post'><button name='btnAtras' title='Volver atrás' type='submit'>Atrás</button>";

        }  
    }

    if (isset($_POST['btnBorrarSeguro'])) {

    }
    ?>
</body>

</html>