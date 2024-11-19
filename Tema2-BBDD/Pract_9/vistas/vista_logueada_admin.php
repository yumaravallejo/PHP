
Bienvenido - <strong><?php echo $datos_usuario_log['usuario'];?></strong>
        <form action="index.php" method="post"><button class='enlace' type="submit" name="btnCerrarSesion2">Cerrar Sesión</button></form>
        <h2>Eres <?php echo $datos_usuario_log['tipo']; ?></h2>
<?php

if (isset($_POST["btnDetalles"]))
    require "vistas/vista_detalles.php";

if (isset($_POST["btnBorrar"]))
    require "vistas/vista_borrar.php";

if (isset($_POST["btnAgregar"]) || (isset($_POST["btnContAgregar"]) && $error_form_agregar))
    require "vistas/vista_agregar.php";


if (isset($_POST["btnEditar"]) || (isset($_POST["btnContEditar"]) && $error_form_editar))
    require "vistas/vista_editar.php";

if (isset($_POST["btnBorrarFoto"]))
    require "vistas/vista_borrar_foto.php";

if (isset($_SESSION["mensaje_accion"])) {
    echo "<p class='mensaje'>¡¡ " . $_SESSION["mensaje_accion"] . " !!</p>";
}

require "vistas/vista_tabla_principal.php";
