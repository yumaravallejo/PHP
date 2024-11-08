<h2>Editar Usuario</h2>
<?php
if (mysqli_num_rows($detalle_usuario) > 0) {
    $tupla_detalles = mysqli_fetch_assoc($detalle_usuario);
?>
    <form action="index.php" method="post">

        <p>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?php if (isset($_POST['nombre'])) echo $_POST['nombre'];
                                                    else {
                                                        echo $tupla_detalles['nombre'];
                                                    } ?>" id="nombre">
            <?php
            if (isset($_POST['editarUser']) && $errores_form) {
                if ($_POST['nombre'] == "") {
                    echo "<span class='error'>* CAMPO VACÍO *</span>";
                }
            }
            ?>
        </p>

        <p>
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" value="<?php if (isset($_POST['usuario'])) echo $_POST['usuario'];
                                                        else {
                                                            echo $tupla_detalles['usuario'];
                                                        } ?>" id="usuario">
            <?php
            if (isset($_POST['editarUser']) && $errores_form) {
                if ($_POST['usuario'] == "") {
                    echo "<span class='error'>* CAMPO VACÍO *</span>";
                } else if ($user_repe) {
                    echo "<span class='error'>* Este usuario ya existe *</span>";
                }
            }
            ?>
        </p>

        <p>
            <label for="clave">Clave:</label>
            <input type="password" name="clave" value="" id="clave" placeholder="Cambiar clave">
        </p>

        <p>
            <label for="email">Email:</label>
            <input type="text" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email'];
                                                    else {
                                                        echo $tupla_detalles['email'];
                                                    } ?>" id="email">
            <?php
            if (isset($_POST['editarUser']) && $errores_form) {
                if ($_POST['email'] == "") {
                    echo "<span class='error'>* CAMPO VACÍO *</span>";
                } else if ($formato_email) {
                    echo "<span class='error'>* Formato de email erróneo *</span>";
                } else {
                    echo "<span class='error'>* ESte email ya está en uso *</span>";
                }
            }
            ?>
        </p>

        <p>
        <?php
        echo "<button type='submit' name='editarUser' value='" . $tupla_detalles['cod_user'] . "'>Editar</button>";
    }
        ?>
        <button type="submit" name="atras">Atrás</button>
        </p>

    </form>