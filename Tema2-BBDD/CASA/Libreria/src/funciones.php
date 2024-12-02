<?php
const SERVIDOR_BD = "localhost";
const USER_BD = "jose";
const CLAVE_BD = "josefa";
const NOMBRE_BD = "bd_libreria_exam";

CONST INACTIVIDAD = 2;

try {
    @$conexion = mysqli_connect(SERVIDOR_BD, USER_BD, CLAVE_BD, NOMBRE_BD);
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    session_destroy();
    die(error_logs("Libreria", "No ha podido realizarse la conexión con la BD " . $e->getMessage()));
}

function repetido($conexion,$tabla,$columna,$valor,$columna_clave=null,$valor_clave=null) {
    try {
        if(isset($columna_clave))
            $consulta="select * from ".$tabla." where ".$columna."='".$valor."' AND ".$columna_clave."<>'".$valor_clave."'";
        else
            $consulta="select * from ".$tabla." where ".$columna."='".$valor."'";

        $resultado=mysqli_query($conexion, $consulta);
        $respuesta=mysqli_num_rows($resultado)>0;
        mysqli_free_result($resultado);
    } catch (Exception $e) {
        die("La consulta no se puede realizar ".$e->getMessage());
    }
    return $respuesta;
}

function error_logs($titulo, $body)
{
    return "<!DOCTYPE html>
          <html lang='es'>
          <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>" . $titulo . "</title>
          </head>
          <body>" . $body . "</body></html>";
}
