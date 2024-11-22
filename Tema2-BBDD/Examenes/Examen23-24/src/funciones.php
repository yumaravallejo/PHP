<?php
const HOSTANME_DB = "localhost";
const USER_DB = "jose";
const PASSWORD_DB = "josefa";
const DATABASE_DB = "bd_horarios_examen";

$DIAS_SEMANA = ["", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes"];
$HORAS_SEMANA = ["8:15-9:15", "9:15-10:15", "10:15-11:15", "11:15-11:45", "11:45-12:45", "12:45-13:45", "13:45-14:45"];

function error_page($title, $body)
{
    $html = '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
    $html .= '<title>' . $title . '</title></head>';
    $html .= '<body>' . $body . '</body></html>';
    return $html;
}

try {
    @$conexion = mysqli_connect(HOSTANME_DB, USER_DB, PASSWORD_DB, DATABASE_DB);
} catch (Exception $e) {
    session_destroy();
    die(error_page("Examen PHP", "No se ha podido conectar con la BD " . $e->getMessage() . ""));
}

function grupos($dia, $hora, $usuario, $conexion) {
    $grupos = [];
        $consulta = "SELECT horario_lectivo.grupo 
                 FROM horario_lectivo 
                 JOIN grupos ON horario_lectivo.grupo = grupos.id_grupo 
                 JOIN usuarios ON horario_lectivo.usuario = usuarios.id_usuario 
                 WHERE horario_lectivo.usuario = '$usuario' 
                 AND horario_lectivo.hora = '$hora'
                 AND horario_lectivo.dia = '$dia'";
    
    $detalle_grupo = mysqli_query($conexion, $consulta);

    while ($tupla = mysqli_fetch_assoc($detalle_grupo)) {
        $grupos[] = $tupla['grupo'];
    }

    return $grupos;
}
