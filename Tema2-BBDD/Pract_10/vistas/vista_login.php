<?php
if (isset($_POST['btnLogin'])) {
    //Comprobamos que se hayan enviado todos los campos primero
    $error_usuario = $_POST['usuario'] == "";
    $error_clave = $_POST['clave'] == "";
    $error_form = $error_usuario || $error_clave;

    if (!$error_form) {
        //Si se han enviado todos los campos comprobamos que esté todo correcto
        try {
            $sentencia = "SELECT * FROM alumnos WHERE usuario = '".$_POST['usuario']."' AND clave = md5('".$_POST['clave']."')";
            $usuario_log = mysqli_query($conexion, $sentencia);
        } catch (Exception $e) {
            session_destroy();
            mysqli_close($conexion);
            die ("No ha podido realizarse la consulta ". $e->getMessage());
        }

        if (mysqli_num_rows($usuario_log)<=0) {
            //Si no se encuentran datos es porque no coinciden las contraseñas
            $error_form = true;
        } else {
            //Si se han encontrado iniciamos el $_SESSION
            $usuario_logueado = mysqli_fetch_assoc($usuario_log);
            $_SESSION['usuario'] = $_POST['usuario'];
            $_SESSION['clave'] = $_POST['clave'];
            $_SESSION['ultm_accion'] = time();
            header("Location:index.php");
        }
    }
    
}
?>

<h1>Iniciar Sesión</h1>
<form action="index.php" method="post">
<p>
    <label for="usuario">Usuario: </label>
    <input type="text" name="usuario" id="usuario" value="<?php if(isset($_POST['usuario'])) echo $_POST['usuario']; ?>">
    <?php
    if (isset($_POST['btnLogin']) && $error_form && $error_usuario) {
        echo "<span class='error'>* CAMPO VACÍO *</span>";
    }
    ?>
</p>

<p>
    <label for="clave">Clave: </label>
    <input type="password" name="clave" id="clave" value="<?php if(isset($_POST['clave'])) echo $_POST['clave']; ?>">
    <?php
    if (isset($_POST['btnLogin']) && $error_form) {
        if ($error_clave) {
            echo "<span class='error'>* CAMPO VACÍO *</span>";
        } else if ($error_form) {
            echo "<span class='error'>* EL USUARIO Y LA CLAVE NO COINCIDEN *</span>";
        }
    }
    ?>
</p>

<p>
    <button type="submit" name="btnLogin">Iniciar Sesión</button>
</p>
</form>