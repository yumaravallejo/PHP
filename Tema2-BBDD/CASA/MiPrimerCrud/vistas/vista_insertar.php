<h2>Nuevo Usuario</h2>
<form method='post' action='index.php'>
    <p>
        <label for='nombre'>Nombre: </label><input type='text' name='nombre' id='nombre' value='<?php if (isset($_POST['nombre'])) echo $_POST['nombre']; ?>'>
        <?php
            if (isset($_POST['btnContInsertar']) && $error_nombre) {
                echo "<span class='error'>* CAMPO VACÍO *</span>";
            }
        ?>
    </p>
    <p>
        <label for='usuario'>Usuario: </label><input type='text' name='usuario' id='usuario' value='<?php if (isset($_POST['usuario'])) echo $_POST['usuario']; ?>'>
        <?php
            if (isset($_POST['btnContInsertar']) && $errores_form && $error_usuario) {
                if ($_POST['usuario'] == "") echo "<span class='error'>* CAMPO VACÍO *</span>";
                else echo "<span class='error'>* ESTE USUARIO YA EXISTE *</span>";
            }
        ?>
    </p>

    <p>
        <label for='clave'>Contraseña: </label><input type='text' name='clave' id='clave' value=''>
        <?php
            if (isset($_POST['btnContInsertar']) && $error_clave) {
                echo "<span class='error'>* CAMPO VACÍO *</span>";
            }
        ?>
    </p>

    <p>
        <label for='email'>Email: </label><input type='text' name='email' id='email' value='<?php if (isset($_POST['email'])) echo $_POST['email']; ?>'>
        <?php
            if (isset($_POST['btnContInsertar']) && $errores_form && $error_email) {
                if ($_POST['email'] == "") echo "<span class='error'>* CAMPO VACÍO *</span>";
                else echo "<span class='error'>* FORMATO DE EMAIL INCORRECTO *</span>";
            }
        ?>
    </p>

    <p><button type='submit' name='btnContInsertar'>Continuar</button> <button type='submit'>Atrás</button>
</form>