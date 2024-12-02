<?php

define("SERVIDOR_BD", "localhost");
define("USUARIO_BD", "jose");
define("CLAVE_BD", "josefa");
define("NOMBRE_BD", "bd_horarios_exam");
$dias[1] = "Lunes";
$dias[] = "Martes";
$dias[] = "Miércoles";
$dias[] = "Jueves";
$dias[] = "Viernes";
define("DIAS", $dias);
$horas[1] = "8:15 - 9:15";
$horas[] = "9:15 - 10:15";
$horas[] = "10:15 - 11:15";
$horas[] = "11:15 - 11:45";
$horas[] = "11:45 - 12:45";
$horas[] = "12:45 - 13:45";
$horas[] = "13s:45 - 14:45";
define("HORAS", $horas);

function error_page($title, $body)
{
    $html = '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
    $html .= '<title>' . $title . '</title></head>';
    $html .= '<body>' . $body . '</body></html>';
    return $html;
}
