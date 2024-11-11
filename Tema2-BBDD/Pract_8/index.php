<?php
/* INICIAMOS LA SESIÓN */
session_start();

/* CONEXIÓN CON LA BASE DE DATOS ----------------------------------------- */
const SERVIDOR_BD = "localhost";
const USUARIO_BD = "jose";
const CLAVE_BD = "josefa";
const NOMBRE_BD = "bd_cv";

try {
    @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    die(error_page("Prácctica 8", "<p>No se ha podido estableceer conexión con la base de datos" . $e->getMessage() . "</p>"));
}

function error_page($title, $body)
{
    return '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>' . $title . '</title>
                </head>
            <body>' . $body . '</body>
            </html>';
}

/* ------------------------------------------------------------------------ */


/* VER DETALLES ------------------------------------------------------ */
if (isset($_POST['detalles']) || isset($_POST['borrar'])) {
    try {
        if (isset($_POST['detalles']))$valor = $_POST['detalles'];
        if (isset($_POST['borrar']))$valor = $_POST['borrar'];
        
        $sentencia = "SELECT * FROM usuarios WHERE id_usuario = $valor";
        $detalle_usuario = mysqli_query($conexion, $sentencia);
    } catch (Exception $e) {
        session_destroy();
        die("<p>No se ha podido estableceer conexión con la base de datos" . $e->getMessage() . "</p>");

    }
}

/* ------------------------------------------------------------------------ */


/* ERRORES FORMULARIO ------------------------------------------------------ */
    if (isset($_POST['btnAgregar'])) {
        function LetraNIF ($dni) {
            $numDni = substr($dni, 0, 8);
            $letraDNI= substr($dni, -1);
            $valor= (int) ($numDni / 23);
            $valor *= 23;
            $valor= $numDni - $valor;
            $letras= "TRWAGMYFPDXBNJZSQVHLCKEO";
            $letraNif= substr ($letras, $valor, 1);

            if ($letraNif != $letraDNI) {
                return $letraNif;
            } else {
                return true;
            }
        }

        var_dump($_FILES['imagen']);

        $error_nombre = $_POST['nombre'] == "";
        $error_usuario = $_POST['usuario'] == "" ;
        $error_clave = $_POST['clave'] == "" ;
        $error_dni = $_POST['dni'] == "" || strlen($_POST['dni']) != 9 || !LetraNif($_POST['dni']);
        $error_foto = $_FILES['imagen']['name'] == "" || $_FILES['imagen']['size'] > 500 * 1024 || $_FILES['imagen']['type'] != "image/*" ;
        $errores_form = $error_nombre || $error_usuario || $error_clave || $error_dni  ;
    }

/* ------------------------------------------------------------------------ */


/* BORRAR USUARIO ------------------------------------------------------ */

if (isset($_POST['borrarSeguro'])) {
    try {
        $valor = $_POST['borrarSeguro'];
        $sentencia = "DELETE FROM usuarios WHERE id_usuario = $valor";
        $detalle_usuario = mysqli_query($conexion, $sentencia);
    } catch (Exception $e) {
        session_destroy();
        die("<p>No se ha podido estableceer conexión con la base de datos" . $e->getMessage() . "</p>");

    }  
}

/* INFORMACIÓN DE LA TABLA ----------------------------------------- */
try {
    $sentencia = "SELECT * FROM usuarios";
    $todos_usuarios = mysqli_query($conexion, $sentencia);
} catch (Exception $e) {
    mysqli_close($conexion);
    die("<p>No se ha podido realizar la sentencia " . $e->getMessage() . "</p>");
}

mysqli_close($conexion);

/* ------------------------------------------------------------------------ */


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 8</title>
    <style>
        .enlace {
            border: none;
            background: none;
            color: darkblue;
            text-decoration: underline;
            cursor: pointer;
            font-weight: normal;
        }

        table,
        th,
        td {
            border: 1px solid black;
            text-align: center;
        }

        td {
            padding: 0.5rem 4rem;
        }

        th {
            padding: 0.5rem
        }

        table {
            border-collapse: collapse;
        }

        img {
            width: 70px;
            height: auto;
        }
    </style>
</head>

<body>
    <h1>Práctica 8</h1>
    <?php
    /* VISTA FORMULARIO INSERTAR -------------------------------------- */
    if (isset($_POST['agregar']) || isset($_POST['btnAgregar']) && $errores_form) {
    ?>
        <h2>Agregar Nuevo Usuario</h2>
        <form method="post" action="index.php" enctype="multipart/form-data">
            <p>
                <label for="nombre">Nombre:</label> <br>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre..." value="<?php if (isset($_POST['nombre'])) echo $_POST['nombre'] ?>">
            </p>
            <p>
                <label for="usuario">Usuario:</label><br>
                <input type="text" name="usuario" id="usuario" placeholder="Usuario..." value="<?php if (isset($_POST['usuario'])) echo $_POST['usuario'] ?>">
            </p>
            <p>
                <label for="clave">Contraseña:</label><br>
                <input type="password" name="clave" id="clave" placeholder="Contraseña..." value="<?php if (isset($_POST['clave'])) echo $_POST['clave'] ?>">
            </p>
            <p>
                <label for="">DNI:</label><br>
                <input type="text" name="dni" id="" placeholder="DNI: 11223344Z" value="<?php if (isset($_POST['dni'])) echo $_POST['dni'] ?>">
            </p>
            <p>
                Sexo: <br>
                <input type="radio" name="sexo" checked value="hombre" id="hombre"><label for="hombre">Hombre:</label> <br>
                <input type="radio" name="sexo" value="mujer" id="mujer"><label for="mujer">Mujer:</label>
            </p>
            <p>
                <label for="foto">Incluir mi foto (Máx. 500KB)</label>
                <input type="file" name="imagen" id="foto">
            </p>
            <p>
                <button type="submit" name="btnAgregar">Guardar Cambios</button>
                <button type="submit">Atrás</button>
            </p>
        </form>
    <?php
    }

    /* VISTA DETALLES  ------------------------------------- */
    if (isset($_POST['detalles'])) {
        if (mysqli_num_rows($detalle_usuario)>0) {
            $detalle_usuario = mysqli_fetch_assoc($detalle_usuario);
            echo "<p><strong>Nombre: </strong>".$detalle_usuario['nombre']."</p>";
            echo "<p><strong>Usuario: </strong>".$detalle_usuario['usuario']."</p>";
            echo "<p><strong>DNI: </strong>".$detalle_usuario['dni']."</p>";
            echo "<p><strong>Sexo: </strong>".$detalle_usuario['sexo']."</p>";
            echo "<form method='post' action='index.php'><button type='submit' title='Cerrar Detalles'>Atrás</button></form>";
        }
    }

    /* VISTA BORRAR ----------------------------------------- */
    if (isset($_POST['borrar'])) {
        if (mysqli_num_rows($detalle_usuario)>0) {
            $detalle_usuario = mysqli_fetch_assoc($detalle_usuario);
            echo "<p>¿Estás seguro de querer borrar el usuario <strong>".$detalle_usuario['nombre']."</strong>?</p>";
            echo "<p>";
            echo "<form method='post' action='index.php'><button type='submit' name='borrarSeguro' title='Eliminar Usuario' value='".$detalle_usuario['id_usuario']."'>Eliminar</button>";
            echo "<button type='submit' title='Cerrar Detalles'>Atrás</button></form>";
            echo "<p>";
        }
    }

    echo "<h2>Listado de los usuarios</h2>";
    echo "<table>";
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>Foto</th>";
    echo "<th>Nombre</th>";
    echo "<td><form method='post' action='index.php'><button class='enlace' type='submit' name='agregar'>Usuario+</button></form></td>";
    echo "</tr>";
    while ($tupla = mysqli_fetch_assoc($todos_usuarios)) {
        echo "<tr>";
        echo "<th>" . $tupla['id_usuario'] . "</th>";
        echo "<td><img src='img/" . $tupla['foto'] . "'></td>";
        echo '<td>
                <form action="index.php" method="post">
                    <button class="enlace" title="Ver Detalles" type="submit" name="detalles" value="' . $tupla["id_usuario"] . '">' . $tupla['nombre'] . '</button>
                </form>
            </td>';
        echo "<td>";
        echo "<p><form method='post' action='index.php'><button class='enlace' type='submit' name='borrar' value='" . $tupla['id_usuario'] . "'>Borrar</button>
         - <button class='enlace' type='submit' name='editar' value='" . $tupla['id_usuario'] . "'>Editar</button></form></p>";
        echo "</td>";
        echo "</tr>";
    }
    ?>
    </table>


</body>

</html>