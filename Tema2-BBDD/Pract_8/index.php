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
    /* VISTA FORMULARIO -------------------------------------- */
    if (isset($_POST['agregar'])) {
        echo "";
    ?>
        <h2>Agregar Nuevo Usuario</h2>
        <form method="post" action="index.html">
            <p>
                <label for="nombre">Nombre:</label> <br>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre..." value="">
            </p>
            <p>
                <label for="usuario">Usuario:</label><br>
                <input type="text" name="usuario" id="usuario" placeholder="Usuario..." value="">
            </p>
            <p>
                <label for="clave">Contraseña:</label><br>
                <input type="password" name="clave" id="clave" placeholder="Contraseña..." value="">
            </p>
            <p>
                <label for="">DNI:</label><br>
                <input type="text" name="" id="" placeholder="DNI: 11223344Z" value="">
            </p>
            <p>
                Sexo: <br>
                <input type="radio" name="sexo" value="hombre" id="hombre"><label for="hombre">Hombre:</label> <br>
                <input type="radio" name="sexo" value="mujer" id="mujer"><label for="mujer">Mujer:</label>

            </p>
            <p>
                
            </p>
            <p></p>
        </form>
    <?php
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