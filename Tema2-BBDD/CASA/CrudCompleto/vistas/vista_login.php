<?php
    if (isset($_POST['btnLogin'])) {
        try {
            $consulta1 = "SELECT * FROM usuarios WHERE usuario = '".$_POST['usuario']."'";
            $existe = mysqli_query($conexion, $consulta1);
        } catch (Exception $e) {
            session_destroy();
            mysqli_close($conexion);
            die ("<p>No se ha podido realizar la consulta en la BD ".$e->getMessage()." </p>");
        }

        try {
            $consulta2 = "SELECT * FROM usuarios WHERE usuario = '".$_POST['usuario']."' AND clave = md5('".$_POST['clave']."') ";
            $login = mysqli_query($conexion, $consulta2);
        } catch (Exception $e) {
            session_destroy();
            mysqli_close($conexion);
            die ("<p>No se ha podido realizar la consulta en la BD ".$e->getMessage()." </p>");
        }


        $error_usuario = $_POST['usuario'] == "" || mysqli_num_rows($existe)<1;
        $error_clave = $_POST['clave'] == "";

        $error_form_login = $error_clave || $error_usuario || mysqli_num_rows($login) <= 0 ;

        if (!$error_form_login) {
            $_SESSION['usuario'] = mysqli_fetch_assoc($login);
            header("Location: index.php");
        }
    }

    
?>

<h1>Iniciar Sesión</h1>

<form action="index.php" method="post">
    <p>
        <label for="usuario">
            Usuario:
        </label>
        <input type="text" name="usuario" id="usuario" value="<?php if (isset($_POST['usuario'])) echo $_POST['usuario'];?>">
        <?php
        if (isset($_POST['btnLogin']) && $error_form_login && $error_usuario){
                if ($_POST['usuario'] == "") echo "<span class='error'>* CAMPO VACÍO *</span>";
                else echo "<span class='error'>* ESTE USUARIO NO EXISTE *</span>";
        }

        ?>
    </p>

    <p>
        <label for="clave">
            Contraseña:
        </label>
        <input type="password" name="clave" id="clave" value="<?php if (isset($_POST['clave'])) echo $_POST['clave'];?>">
        <?php
        if (isset($_POST['btnLogin']) && $error_form_login && $error_clave) {
            if ($_POST['clave'] == "") echo "<span class='error'>* CAMPO VACÍO *</span>";            
        } else if (isset($_POST['btnLogin']) && $error_form_login && mysqli_num_rows($login) <= 0) 
            echo "<span class='error'>* EL USUARIO Y LA CLAVE NO COINCIDEN *</span>";

        ?>
    </p>

    <p>
        <button type="submit" name="btnLogin">Login</button>
        <button type="submit" name="btnRegistrar">Registrar</button>
    </p>

</form>