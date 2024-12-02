<?php
session_name("sesiones05");
session_start();
if (isset($_POST["accion"])) {
    if ($_POST["accion"] == "izq") {
        if (($_SESSION["posicionX"] - 20) < -200) {
            $_SESSION["posicionX"] = 200;
        } else {
            $_SESSION["posicionX"] = $_SESSION["posicionX"] - 20;
        }
    } else if ($_POST["accion"] == "der") {
        
        if (($_SESSION["posicionX"] + 20) > 200) {
            $_SESSION["posicionX"] = - 200;
        } else {
            $_SESSION["posicionX"] = $_SESSION["posicionX"] + 20;
        }
    } else if ($_POST["accion"] == "arr") {
        if (($_SESSION["posicionY"] - 20) < -200) {
            $_SESSION["posicionY"] = 200;
        } else {
            $_SESSION["posicionY"] = $_SESSION["posicionY"] - 20;
        }
    } else if ($_POST["accion"] == "aba") {
        
        if (($_SESSION["posicionY"] + 20) > 200) {
            $_SESSION["posicionY"] = - 200;
        } else {
            $_SESSION["posicionY"] = $_SESSION["posicionY"] + 20;
        }
    } else {
        $_SESSION["posicionX"] = 0;
        $_SESSION["posicionY"] = 0;
    }
}

header("Location: sesiones05_1.php");
exit();
?>