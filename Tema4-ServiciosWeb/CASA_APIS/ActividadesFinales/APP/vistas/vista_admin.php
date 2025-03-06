<?php

//Llamada a insertar (errores)
if (isset($_POST['btnAgregarCont'])) {
    //Comprobamos los errores
    $error_usuario = empty($_POST['usuario']);

    if (!$error_usuario) {
        $headers[] = "Authorization: Bearer " . $_SESSION["token"];

        $url = DIR_SERV . "/repetido/usuarios/usuario/" . urlencode($_POST['usuario']);
        $user_repetido = consumir_servicios_JWT_REST($url, "GET", $headers);
        $json_repetido = json_decode($user_repetido, true);
        if (!$json_repetido) {
            session_destroy();
            echo "<p>Error consumiendo el servico rest: <strong>" . $url . "</strong></p>";
        }
        if (isset($json_repetido["error"])) {
            session_destroy();
            echo "<p>" . $json_repetido["error"] . "</p>";
        }
    }

    $error_email = empty($_POST['email']);

    if (!$error_email) {
        $headers[] = "Authorization: Bearer " . $_SESSION["token"];

        $url = DIR_SERV . "/repetido/usuarios/email/" . urlencode($_POST['email']);
        $email_repetido = consumir_servicios_JWT_REST($url, "GET", $headers);
        $json_repetido = json_decode($email_repetido, true);
        if (!$json_repetido) {
            session_destroy();
            echo "<p>Error consumiendo el servico rest: <strong>" . $url . "</strong></p>";
        }
        if (isset($json_repetido["error"])) {
            session_destroy();
            echo "<p>" . $json_repetido["error"] . "</p>";
        }
    }

    $error_usuario = empty($_POST['usuario']) || $json_repetido["repetido"];
    $error_email = empty($_POST['email']) || $json_repetido_e["repetido"];
    $error_nombre = empty($_POST['nombre']);
    $error_clave = empty($_POST['clave']);

    $errores_form = $error_usuario || $error_email || $error_nombre || $error_clave;

    if (!$errores_form) {
        $headers[] = "Authorization: Bearer " . $_SESSION["token"];

        $_POST['clave'] = md5($_POST['clave']);
        // No hay errores, insertar usuario
        $url = DIR_SERV . "/crearUsuario";
        $insertar = consumir_servicios_JWT_REST($url, "POST", $headers, $_POST);
        $json_insertar = json_decode($insertar, true);

        if (isset($json_insertar["error"])) {
            session_destroy();
            echo "<p>Error: " . $json_insertar["error"] . "</p>";
        } else if (!$json_insertar) {
            session_destroy();
            echo "<p>No se ha podido hacer nada</p>";
        } else {
            $_SESSION["mensaje"] = "¡Usuario insertado con éxito!";
            header("Location: index.php");
            exit;
        }
    } else {
        // Mostrar errores en el formulario
        echo "Existen errores en el formulario.";
    }
}


//Llamada a borrar
if (isset($_POST['btnBorrarCont'])) {
    $headers[] = "Authorization: Bearer " . $_SESSION["token"];

    $url = DIR_SERV . "/borrarUsuario/" . urlencode($_POST['btnBorrarCont']);
    $borrar = consumir_servicios_JWT_REST($url, "DELETE",$headers);
    $json_borrar = json_decode($borrar, true);
    if (!$json_borrar) {
        session_destroy();
        echo "<p>Error consumiendo el servico rest: <strong>" . $url . "</strong></p>";
    }

    if (isset($json_borrar["error"])) {
        session_destroy();
        echo "<p>" . $json_borrar["error"] . "</p>";
    }

    $_SESSION["mensaje"] = "¡¡ Producto borrado con éxito !!";
    header("Location:index.php");
    exit;
}

//Llamada a detalles
if (isset($_POST['btnDetalles']) || isset($_POST['btnEditar'])) {
    if (isset($_POST['btnDetalles'])) {
        $id = $_POST['btnDetalles'];
    } else {
        $id = $_POST['btnEditar'];
    }
    $headers[] = "Authorization: Bearer " . $_SESSION["token"];

    $url = DIR_SERV . "/detallesUsuario/" . urlencode($id);
    $usuario = consumir_servicios_JWT_REST($url, "GET",$headers);
    $json_usuario = json_decode($usuario, true);
    if (!$json_usuario) {
        session_destroy();
        echo "<p>Error consumiendo el servico rest: <strong>" . $url . "</strong></p>";
    }

    if (isset($json_usuario["error"])) {
        session_destroy();
        echo "<p>" . $json_usuario["error"] . "</p>";
    }
}

//Llamada a editar
if (isset($_POST['btnContEditar'])) {
    //Comprobamos los errores
    $error_usuario = empty($_POST['usuario']);

    if (!$error_usuario) {
        $headers[] = "Authorization: Bearer " . $_SESSION["token"];
        $url = DIR_SERV . "/repetido/usuarios/usuario/" . urlencode($_POST['usuario']) . "/id_usuario/" . urlencode($_POST['btnContEditar']);
        $user_repetido = consumir_servicios_JWT_REST($url, "GET",$headers);
        $json_repetido = json_decode($user_repetido, true);
        if (!$json_repetido) {
            session_destroy();
            echo "<p>Error consumiendo el servico rest: <strong>" . $url . "</strong></p>";
        }
        if (isset($json_repetido["error"])) {
            session_destroy();
            echo "<p>" . $json_repetido["error"] . "</p>";
        }
    }

    $error_email = empty($_POST['email']);

    if (!$error_email) {
        $headers[] = "Authorization: Bearer " . $_SESSION["token"];
        $url = DIR_SERV . "/repetido/usuarios/email/" . urlencode($_POST['email']) . "/id_usuario/" . urlencode($_POST['btnContEditar']);
        $email_repetido = consumir_servicios_JWT_REST($url, "GET",$headers);
        $json_repetido_e = json_decode($email_repetido, true);
        if (!$json_repetido_e) {
            session_destroy();
            echo "<p>Error consumiendo el servico rest: <strong>" . $url . "</strong></p>";
        }
        if (isset($json_repetido_e["error"])) {
            session_destroy();
            echo "<p>" . $json_repetido_e["error"] . "</p>";
        }
    }

    $error_usuario = empty($_POST['usuario']) || $json_repetido["repetido"];
    $error_email = empty($_POST['email']) || $json_repetido_e["repetido"];
    $error_nombre = empty($_POST['nombre']);

    $errores_form = $error_usuario || $error_email || $error_nombre;

    if (!$errores_form) {
        $headers[] = "Authorization: Bearer " . $_SESSION["token"];

        if ($_POST['clave'] == "") {
            // No hay errores, insertar usuario
            $url = DIR_SERV . "/actualizarUsuarioSinClave/".urlencode($_POST['btnContEditar']);
            $actualizar = consumir_servicios_JWT_REST($url, "PUT",$headers, $_POST);
            $json_actualizar = json_decode($actualizar, true);

            if (isset($json_actualizar["error"])) {
                session_destroy();
                echo "<p>Error: " . $json_actualizar["error"] . "</p>";
            } else if (!$json_actualizar) {
                session_destroy();
                echo "<p>No se ha podido hacer nada</p>";
            } else {
                $_SESSION["mensaje"] = "¡Usuario actualizado con éxito!";
                header("Location: index.php");
                exit;
            }
        } else {
            $_POST['clave'] = md5($_POST['clave']) ;
            // No hay errores, insertar usuario
            $url = DIR_SERV . "/actualizarUsuario/".urlencode($_POST['btnContEditar']);
            $actualizar = consumir_servicios_JWT_REST($url, "PUT", $headers,$_POST);
            $json_actualizar = json_decode($actualizar, true);

            if (isset($json_actualizar["error"])) {
                session_destroy();
                echo "<p>Error: " . $json_actualizar["error"] . "</p>";
            } else if (!$json_actualizar) {
                session_destroy();
                echo "<p>No se ha podido hacer nada</p>";
            } else {
                $_SESSION["mensaje"] = "¡Usuario actualizado con éxito!";
                header("Location: index.php");
                exit;
            }
        }
    } else {
        // Mostrar errores en el formulario
        echo "Existen errores en el formulario.";
    }
}

//Llamada de todos los usuarios para la tabla
$url = DIR_SERV . "/usuarios";
$usuarios = consumir_servicios_JWT_REST($url, "GET", $headers);
$json_usuarios = json_decode($usuarios, true);
if (!$json_usuarios) {
    session_destroy();
    die(error_page("Actividad 2", "<p>Error consumiendo el servico rest: <strong>" . $url . "</strong></p>"));
}

if (isset($json_usuarios["error"])) {
    session_destroy();
    die(error_page("Actividad 2", "<p>" . $json_usuarios["error"] . "</p>"));
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primer Crud con Servicios</title>
    <style>
        .mensaje {
            color: blue;
            font-size: larger;
        }

        .enlace {
            border: 0;
            background: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }

        table {
            border-collapse: collapse;
        }

        table,
        td,
        th {
            border: 1px solid black
        }

        .centrado {
            text-align: center;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Bienvenido admin <?php echo $datos_usu_log['usuario'] ?></h1>
    <form action="index.php" method="post">
        <button type="submit" name="btnSalir">Cerrar Sesión</button>
    </form>
    <h2>Listado de los usuarios</h2>
    <?php
    if (isset($_SESSION['mensaje'])) {
        echo "<p class='mensaje'>" . $_SESSION['mensaje'] . "</p>";
       unset($_SESSION['mensaje']);
    }
    ?>
    <table>
        <tr>
            <th>Nombre de Usuario</th>
            <th>Borrar</th>
            <th>Editar</th>
        </tr>
        <?php
        foreach ($json_usuarios['usuarios'] as $tupla) {
            echo "<form method='post' action='index.php'>";
            echo "<tr>";
            echo "<td><button class='enlace' type='submit' name='btnDetalles' value='" . $tupla['id_usuario'] . "'>" . $tupla['nombre'] . "</button></td>";
            echo "<td><button class='enlace' type='submit' name='btnBorrar' value='" . $tupla['id_usuario'] . "'>Borrar</button></td>";
            echo "<td><button class='enlace' type='submit' name='btnEditar' value='" . $tupla['id_usuario'] . "'>Editar</button></td>";
            echo "</tr>";
        }
        echo "
        <tr>
            <td colspan='3' class='centrado'>
                <button class='enlace' type='submit' name='btnAgregar' value='" . $tupla['id_usuario'] . "'>Agregar Usuario +</button>
            </td>
        </tr>";
        ?>
    </table>
    <?php

    if (isset($_POST['btnAgregar']) || (isset($_POST["btnAgregarCont"]) && $errores_form)) {
    ?>
        <form method='post' action='index.php'>
            <h2>Insertar un nuevo usuario</h2>

            <p>
                <label for="nombre">Nombre: </label>
                <input id="nombre" type='text' name='nombre' value='<?php if (isset($_POST['nombre'])) echo $_POST['nombre'] ?>'><br>
                <?php
                if (isset($_POST['btnAgregarCont']) && $error_nombre) {
                    if ($_POST['nombre'] == "")
                        echo "<span class='error'>Rellene este campo</span>";
                }
                ?>
            </p>
            <p>
                <label for="usuario">Usuario: </label>
                <input id="usuario" type='text' name='usuario' value='<?php if (isset($_POST['usuario'])) echo $_POST['usuario'] ?>'><br>
                <?php
                if (isset($_POST['btnAgregarCont']) && $error_usuario) {
                    if ($_POST['usuario'] == "")
                        echo "<span class='error'>Rellene este campo</span>";
                    else
                        echo "<span class='error'>Este usuario ya está registrado en la BD</span>";
                }
                ?>
            </p>
            <p>
                <label for="clave">Clave: </label>
                <input id="clave" type='password' name='clave' value='<?php if (isset($_POST['clave'])) echo $_POST['clave'] ?>'><br>
                <?php
                if (isset($_POST['btnAgregarCont']) && $error_clave) {
                    if ($_POST['clave'] == "")
                        echo "<span class='error'>Rellene este campo</span>";
                }
                ?>
            </p>
            <p>
                <label for="email">Email: </label>
                <input id="email" type='email' name='email' value='<?php if (isset($_POST['email'])) echo $_POST['email'] ?>'><br>
                <?php
                if (isset($_POST['btnAgregarCont']) && $error_email) {
                    if ($_POST['email'] == "")
                        echo "<span class='error'>Rellene este campo</span>";
                    else
                        echo "<span class='error'>Este email ya está registrado en la BD</span>";
                }
                ?>
            </p>
            <button type='submit' name='btnAgregarCont'>Agregar</button>
            <button type='submit'>Cancelar</button>
        </form>
    <?php
    }

    if (isset($_POST['btnDetalles'])) {
        echo "
        <h2>Detalles del usuario " . $json_usuario['usuario']['id_usuario'] . "</h2>
        <strong>Nombre</strong>: " . $json_usuario['usuario']['nombre'] . "<br>
        <strong>Usuario</strong>: " . $json_usuario['usuario']['usuario'] . "<br>
        <strong>Clave</strong>: <br>
        <strong>Email</strong>: " . $json_usuario['usuario']['email'] . "<br>
        <strong>Tipo</strong>: " . $json_usuario['usuario']['tipo'] . "<br>
        ";
    }

    if (isset($_POST['btnBorrar'])) {
        echo "
        <p>¿Estás seguro de querer borrar al usuario con <strong> id:  " . $_POST['btnBorrar'] . "</strong>?<p>
        <form method='post' action='index.php'>
            <button type='submit' name='btnBorrarCont' value='" . $_POST['btnBorrar'] . "'>Borrar</button></td>
            <button type='submit'>Volver</button></td>
        </form>
        ";
    }

    if (isset($_POST['btnEditar']) || (isset($_POST["btnContEditar"]) && $errores_form)) {
        if (isset($_POST["btnEditar"])) {
            if (isset($json_usuario["usuario"])) {
                $nombre = $json_usuario["usuario"]["nombre"];
                $usuario = $json_usuario["usuario"]["usuario"];
                $email = $json_usuario["usuario"]["email"];
                $id_usuario = $_POST["btnEditar"];
            } else
                die("<h2>Editando el usuario " . $_POST['btnEditar'] . "</h2><p>El usuario seleccionado ya no se encuentra en la BD</p></body></html>");
        } else {
            $nombre = $_POST["nombre"];
            $usuario = $_POST["usuario"];
            $email = $_POST["email"];
            $id_usuario = $_POST["btnContEditar"];
        }
    ?>
        <h2>Editando el usuario <?php echo $id_usuario; ?></h2>
        <form action="index.php" method="post">
            <p>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>" />
                <?php
                if (isset($_POST["btnContEditar"]) && $error_nombre) {
                    echo "<span class='error'>* Campo vacío *</span>";
                }
                ?>
            </p>
            <p>
                <label for="usuario">Usuario:</label>
                <input type="text" name="usuario" id="usuario" value="<?php echo $usuario; ?>" />
                <?php
                if (isset($_POST["btnContEditar"]) && $error_usuario) {
                    if ($_POST["usuario"] == "")
                        echo "<span class='error'>* Campo vacío *</span>";
                    else
                        echo "<span class='error'>* Usuario repetido *</span>";
                }
                ?>
            </p>
            <p>
                <label for="clave">Contraseña:</label>
                <input type="password" name="clave" placeholder="Cambiar clave" id="clave" value="" />
            </p>
            <p>
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" value="<?php echo $email; ?>" />
                <?php
                if (isset($_POST["btnContEditar"]) && $error_email) {
                    if ($_POST["email"] == "")
                        echo "<span class='error'>* Campo vacío *</span>";
                    elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
                        echo "<span class='error'>* Email sintácticamente incorrecto *</span>";
                    else
                        echo "<span class='error'>* Email repetido *</span>";
                }
                ?>
            </p>
            <p>
                <button type="submit" name="btnContEditar" value="<?php echo $id_usuario; ?>">Continuar</button>
                <button type="submit">Atrás</button>
            </p>
        </form>
    <?php
    }
    ?>
</body>
</html>