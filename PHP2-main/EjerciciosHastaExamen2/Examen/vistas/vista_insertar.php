<?php
// Botón añadir
if (isset($_POST["btnAñadir"])) {
    // Conexión
    try {
        $conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        session_destroy();
        die(error_page("ERROR", "<p>Ha habido un error: " . $e->getMessage() . "</p>"));
    }

    // Añadimos el grupo seleccionado a la hora y dia seleccionada del profesor seleccionado
    try {
        $consulta = "INSERT INTO horario_lectivo (usuario, dia, hora, grupo) VALUES ('" . $_POST["profesores"] . "','" . $_POST["dia"] . "','" . $_POST["hora"] . "','" . $_POST["grupos"] . "')";
        $resultado = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        session_destroy();
        mysqli_close($conexion);
        die(error_page("ERROR", "<p>Ha habido un error: " . $e->getMessage() . "</p>"));
    }

    // Creamos sesiones
    $_SESSION["mensaje"] = "Grupo insertado con éxito";
    $_SESSION["profesores"] = $_POST["profesores"];
    $_SESSION["hora"] = $_POST["hora"];
    $_SESSION["dia"] = $_POST["dia"];

    mysqli_close($conexion);
    header("Location:index.php");
    exit();
}
