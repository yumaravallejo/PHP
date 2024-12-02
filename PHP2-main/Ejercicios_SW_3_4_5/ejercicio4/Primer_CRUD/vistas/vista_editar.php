<?php
if (isset($_POST["btnEditar"]))
    $id_usuario = $_POST["btnEditar"];
else
    $id_usuario = $_POST["btnContEditar"];

$url = DIR_SERV . "/usuario/" . $id_usuario;
$respuesta = consumir_servicios_REST($url, "GET");
$obj = json_decode($respuesta);
if (!$obj) {
    session_destroy();
    die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
}

if (isset($obj->error)) {
    session_destroy();
    die("<p>" . $obj->error . "</select></p></body></html>");
}

if (isset($obj->usuario)) {
    if (isset($_POST["btnEditar"])) {    //Recojo datos obtenidos de la BD
        $nombre = $obj->usuario->nombre;
        $usuario = $obj->usuario->usuario;
        //$clave=$obj->usuario->clave;
        $email = $obj->usuario->email;
    } else {
        $nombre = $_POST["nombre"];
        $usuario = $_POST["usuario"];
        //$clave=$datos_usuario["clave"];
        $email = $_POST["email"];
    }
} else {
    $mensaje_error_usuario = "<p>" . $obj->mensaje . "</p>";
}

if (isset($mensaje_error_usuario))
    echo $mensaje_error_usuario;
else {
?>
    <h2>Editando al usuario <?php echo $id_usuario; ?></h2>
    <form action="index.php" method="post">
        <p>
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" id="nombre" maxlength="30" value="<?php echo $nombre; ?>">
            <?php
            if (isset($_POST["btnContEditar"]) && $error_nombre) {
                if ($_POST["nombre"] == "")
                    echo "<span class='error'> Campo vacío</span>";
                else
                    echo "<span class='error'> Has tecleado más de 30 caracteres</span>";
            }
            ?>
        </p>
        <p>
            <label for="usuario">Usuario: </label>
            <input type="text" name="usuario" id="usuario" maxlength="20" value="<?php echo $usuario; ?>">
            <?php
            if (isset($_POST["btnContEditar"]) && $error_usuario) {
                if ($_POST["usuario"] == "")
                    echo "<span class='error'> Campo vacío</span>";
                elseif (strlen($_POST["usuario"]) > 20)
                    echo "<span class='error'> Has tecleado más de 20 caracteres</span>";
                else
                    echo "<span class='error'> Usuario repetido</span>";
            }
            ?>
        </p>
        <p>
            <label for="clave">Contraseña: </label>
            <input type="password" name="clave" maxlength="15" id="clave" placeholder="Editar contraseña">
            <?php
            if (isset($_POST["btnContEditar"]) && $error_clave) {
                echo "<span class='error'> Has tecleado más de 15 caracteres</span>";
            }
            ?>
        </p>
        <p>
            <label for="email">Email: </label>
            <input type="text" name="email" id="email" maxlength="50" value="<?php echo $email; ?>">
            <?php
            if (isset($_POST["btnContEditar"]) && $error_email) {
                if ($_POST["email"] == "")
                    echo "<span class='error'> Campo vacío</span>";
                elseif (strlen($_POST["email"]) > 50)
                    echo "<span class='error'> Has tecleado más de 50 caracteres</span>";
                elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
                    echo "<span class='error'> Email sintáxticamente incorrecto</span>";
                else
                    echo "<span class='error'> Email repetido</span>";
            }
            ?>
        </p>
        <p>
            <button type="submit" name="btnContEditar" value="<?php echo $id_usuario; ?>">Continuar</button>
            <button type="submit">Volver</button>
        </p>
    </form>


<?php
}

?>