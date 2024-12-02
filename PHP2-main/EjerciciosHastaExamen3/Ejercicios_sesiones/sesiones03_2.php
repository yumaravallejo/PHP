<?php
session_name("sesiones03");
session_start();
if (isset($_POST["btnContador"])) {
    if ($_POST["btnContador"] == "-") {
        $_SESSION["contador"]--;
    } else if ($_POST["btnContador"] == "+") {
        $_SESSION["contador"]++;
    } else {
        $_SESSION["contador"] = 0;
    }
}

header("Location: sesiones03_1.php");
exit();
?>