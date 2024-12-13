<?php

CONST SERVIDOR_BD = "localhost";
CONST USUARIO_BD = "jose";
CONST CLAVE_BD = "josefa";
CONST NOMBRE_BD =  "bd_libreria_exam";

//Constante que nos dará la inactividad (minutos)
CONST INACTIVIDAD = 2;

    function error_page($title,$body)
    {
        $html='<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
        $html.='<title>'.$title.'</title></head>';
        $html.='<body>'.$body.'</body></html>';
        return $html;
    }

    //Comprobar que el usuario no esté repetido
    function repetido($conexion, $tabla, $columna, $valor, $columna_clave=null, $valor_clave=null)
    {
        try {
            if (isset($columna_clave)) {
                $consulta = 'SELECT * FROM ' .$tabla . ' WHERE ' . $columna . '="' . $valor . '" AND ' . $columna_clave . '<>"' . $valor_clave . '"';
            } else {
                $consulta = 'SELECT * FROM ' .$tabla . ' WHERE ' . $columna . '="' . $valor . '"';
            }
            $resultado = mysqli_query($conexion, $consulta);
            $respuesta = mysqli_num_rows($resultado) > 0;
            mysqli_free_result($resultado);
        } catch (Exception $e) {
            mysqli_close($conexion);
            $respuesta = error_page('Práctica 1º CRUD', '<h1>Práctica 1º CRUD</h1><p>No se ha podido hacer la consulta: ' . $e->getMessage() . '</p>');
        }
        return $respuesta;
    }

?>