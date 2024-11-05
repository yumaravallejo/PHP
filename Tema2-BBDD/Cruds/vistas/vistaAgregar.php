<h2>Agregando un nuevo usuario</h2>
<form action="index.php" method="post">
    <p>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php if(isset($_POST['nombre'])) echo $_POST['nombre'] ?>" id="nombre">
        <?php
        if (isset($_POST['agregarUser']) && $errores_form) {
            if ($_POST['nombre'] == "") {
                echo "<span class='error'>* CAMPO VACÍO *</span>";
            }
        }
        ?>
    </p>

    <p>
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" value="<?php if(isset($_POST['usuario'])) echo $_POST['usuario'] ?>" id="usuario">
        <?php
        if (isset($_POST['agregarUser']) && $errores_form) {
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
        <input type="password" name="clave" value="<?php if(isset($_POST['clave'])) echo $_POST['clave'] ?>" id="clave">
        <?php
        if (isset($_POST['agregarUser']) && $errores_form) {
            if ($_POST['clave'] == "") {
                echo "<span class='error'>* CAMPO VACÍO *</span>";
            }
        }
        ?>
    </p>

    <p>
        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>" id="email">
        <?php
        if (isset($_POST['agregarUser']) && $errores_form) {
            if ($_POST['email'] == "") {
                echo "<span class='error'>* CAMPO VACÍO *</span>";
            } else if ($formato_email) {
                echo "<span class='error'>* Formato de email erróneo *</span>";
            }
        }
        ?>
    </p>

    <p>
        <button type="submit" name="agregarUser">Continuar</button>
        <button type="submit" name="atras">Atrás</button>
    </p>
</form>