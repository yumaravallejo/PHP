<?php
session_name("App_Examen_SW_22_23");
session_start();
require "src/funciones_ctes.php";

if (isset($_SESSION["usuario"])) {
    // Estoy logueado
} else {
    require "vistas/vista_home.php";
}
