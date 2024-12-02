<?php
session_name("sesiones04");
session_start();
if (isset($_POST["accion"])) {
    if ($_POST["accion"] == "izq") {
        if (($_SESSION["posicion"] - 20) < -300) {
            $_SESSION["posicion"] = 300;
        } else {
            $_SESSION["posicion"] = $_SESSION["posicion"] - 20;
        }
    } else if ($_POST["accion"] == "der") {
        
        if (($_SESSION["posicion"] + 20) > 300) {
            $_SESSION["posicion"] = - 300;
        } else {
            $_SESSION["posicion"] = $_SESSION["posicion"] + 20;
        }
    } else {
        $_SESSION["posicion"] = 0;
    }
}

header("Location: sesiones04_1.php");
exit();
?>