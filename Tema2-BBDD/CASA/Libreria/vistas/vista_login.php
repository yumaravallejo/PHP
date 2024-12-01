<?php
if (isset($_POST['btnLogin'])) {
    $error_usuario = $_POST['usuario'] == "";
    $error_clave = $_POST['clave'] == "";

    $error_form_login = $error_clave || $error_usuario;

    if (!$error_form_login) {
        try {
            $consulta_l = "SELECT * FROM usuarios WHERE lector = '".$_POST['usuario']."' AND clave = md5('".$_POST['clave']."')";
            $usuario_login = mysqli_query($conexion, $consulta_l);
        } catch (Exception $e) {
            mysqli_close($conexion);
            session_destroy();
            die ("No se ha podido realizar la conexión con la BD ". $e->getMessage());
        }     

        if (mysqli_num_rows($usuario_login)>0) {
            $datos_user_log = mysqli_fetch_assoc($usuario_login);
            $_SESSION['usuario'] = $datos_user_log['lector'];
            $_SESSION['clave'] = $datos_user_log['clave'];
            $_SESSION['ultm_accion'] = time();
            $datos_user_log = mysqli_fetch_assoc($usuario_login);
            mysqli_free_result($usuario_login);
            mysqli_close($conexion);
            if ($datos_user_log["tipo"] == "normal") {
                header("Location:index.php");
            } else {
                header("Location:admin/gest_libros.php");
            }
            exit;
        } else {
            $error_usuario = true;
        }
    }
}
?>

<h1>Librería</h1>
<form action="index.php" method="post">
    <p>
        <label for="usuario">
            Usuario: 
        </label>
        <input type="text" name="usuario" value="<?php if(isset($_POST['usuario'])) echo $_POST['usuario']; ?>">
        <?php
        if (isset($_POST['btnLogin']) && $error_form_login) {
            if (isset($error_usuario) && $_POST['usuario'] == "") {
                echo "<span class='error'>* CAMPO VACÍO *</span>";
            } else if (isset($error_usuario)) {
                echo "<span class='error'>* EL USUARIO Y LA CONTRASEÑA NO COINCIDEN *</span>";
            }
        }
        ?>
    </p>
    <p>
        <label for="clave">
            Contraseña: 
        </label>
        <input type="password" name="clave" value="">
        <?php
        if (isset($_POST['btnLogin']) && $error_form_login) {
            if (isset($error_clave)) {
                echo "<span class='error'>* CAMPO VACÍO *</span>";
            }
        }
        ?>
    </p>
    <p><button type="submit" name="btnLogin">Entrar</button></p>
</form>

<?php
    require "vista_libros.php";
 // si existe la sesion de seguridad te muestra un mensaje
 if (isset($_SESSION["seguridad"])) {
    echo "<p class='mensaje'>" . $_SESSION["seguridad"] . "</p>";
    session_destroy();
}
?>