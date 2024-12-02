<?php
session_name("sesiones06");
session_start();

if (isset($_POST["accion"]) && $_POST["accion"]==1) 
    $_SESSION["azul"] = $_SESSION["azul"] + 10;
else if (isset($_POST["accion"]) && $_POST["accion"]==2) 
    $_SESSION["naranja"] = $_SESSION["naranja"] + 10;
else {
    $_SESSION["azul"] = 0;
    $_SESSION["naranja"] = 0;
}

header("Location: sesiones06_1.php");
exit();
?>