<?php
const HOST_BD = "localhost";
const USUARIO_BD = "jose";
const CLAVE_BD = "josefa";
const NOMBRE_BD = "bd_foro";
try {
    @$conexion = mysqli_connect(HOST_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
} catch (Exception $e) {
    session_destroy();
    die (error_func("Primer crud casa", "No se ha podido conectar a la BD ". $e->getMessage()));
}

function error_func($title, $body)
{
    return '<!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>' . $title . '</title>
            </head>
            <body>' . $body . '</body></html>';
}
