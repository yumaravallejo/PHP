<?php
CONST SERVIDOR_BD = "localhost";
CONST USER_BD = "jose";
CONST CLAVE_BD = "josefa";
CONST NOMBRE_BD = "bd_horarios_exam";

CONST INACTIVIDAD = 5;

try {
@$conexion = mysqli_connect(SERVIDOR_BD, USER_BD, CLAVE_BD, NOMBRE_BD);
} catch (Exception $e) {
    session_destroy();
    die (error_page("Práctica 10", "No se ha podido conectar con la BD"));
}

function error_page($title,$body)
{
    $html='<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
    $html.='<title>'.$title.'</title></head>';
    $html.='<body>'.$body.'</body></html>';
    return $html;
}
?>