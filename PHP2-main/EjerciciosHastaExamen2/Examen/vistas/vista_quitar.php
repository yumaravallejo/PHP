<?php
// Botón quitar
if (isset($_POST["btnQuitar"])) {
    // Conexion
    try {
        $conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        session_destroy();
        die(error_page("ERROR", "<p>Ha habido un error: " . $e->getMessage() . "</p>"));
    }

    // Grupos que tiene el profesor esa hora
    try {
        $consulta = "delete from horario_lectivo where usuario='" . $_POST["profesores"] . "' and dia='" . $_POST["dia"] . "' and hora='" . $_POST["hora"] . "' and grupo='" . $_POST["btnQuitar"] . "'";
        $resultado = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        session_destroy();
        mysqli_close($conexion);
        die(error_page("ERROR", "<p>Ha habido un error: " . $e->getMessage() . "</p>"));
    }

    // Creamos sesiones
    $_SESSION["mensaje"] = "Grupo borrado con éxito";
    $_SESSION["profesores"] = $_POST["profesores"];
    $_SESSION["hora"] = $_POST["hora"];
    $_SESSION["dia"] = $_POST["dia"];

    mysqli_close($conexion);
    header("Location:index.php");
    exit();
}
