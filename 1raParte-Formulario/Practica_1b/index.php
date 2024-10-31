<?php
    function letraNif($dni) {
 
     return substr("TRWAGMYFPDXBNJZSQVHLCKEO", $dni % 23, 1); 
    }

    function letra_valida($dni) {
        $letra_dada = substr($dni, -1, 1);
        if($letra_dada != letraNif($dni)){
            return false;
        } else return true;
    }

    function dni_valido($dni){
        if(preg_match('/^(\d{8})([A-Z])$/', $dni)) {
            return true;
        } else {return false;}
    }

    if(isset($_POST["guardar"])){
        //Compruebo errores del formulario
        $error_nombre=$_POST["nombre"]=="";
        $error_apellido=$_POST["apellidos"]=="";
        $error_clave=$_POST["contrasena"]=="";
        $error_dni=$_POST["dni"]=="" || !letra_valida($_POST['dni']) || !dni_valido($_POST['dni']);
        $error_sexo=!isset($_POST["sexo"]);
        $error_comentarios=$_POST["comentarios"]=="";

        $errores_form=$error_nombre||$error_apellido||$error_clave||$error_dni||$error_sexo||$error_comentarios;
    } else {
        $errores_form=false;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Práctica 1</title>
        <link rel="stylesheet" href="">
        <link rel="icon" href="img/rmescudo.png"> 
    </head>
    <style>
        .error {
            color: red;
        }
    </style>

<?php
    if(!isset($_POST["guardar"]) && !$errores_form){      
        require "vistas/formulario.php";
        //var_dump($_POST); --> muestra el contenido de la variable
    } else {
        require "vistas/formulario.php"; //Aquí podría poner otra página distinta
    }
    
?>
</html>