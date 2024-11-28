<?php
const HOST_DB = "localhost";
const USER_DB = "jose";
const PASSWORD_DB = "josefa";
const DATABASE_DB = "bd_horarios_examen";

CONST DIAS_SEMANA = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes"];
CONST HORAS_SEMANA = ["8:15-9:15", "9:15-10:15", "10:15-11:15", "11:15-11:45", "11:45-12:45", "12:45-13:45", "13:45-14:45"];


try {
    @$conexion = mysqli_connect(HOST_DB, USER_DB, PASSWORD_DB, DATABASE_DB);
} catch (Exception $e) {
    session_destroy();
    die(error_logn("Crud Completo", "No se ha podido conectar con la BD " . $e->getMessage() . " "));
}

function error_logn($title, $body)
{
    return "<DOCTYPE html>
            <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>" . $title . "</title>
            </head>
            <body>" . $body . "</body>
            </html>";
}
