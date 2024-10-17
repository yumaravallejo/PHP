<?php
function contiene ($elemento, $array) {
   $contiene = false;
   for ($i = 0; $i<count($array); $i++) {
      if ($array[$i]==$elemento) {
         $contiene = true;
         break;
      }
   }
   return $contiene;
}

if(isset($_POST["btnEnviar"]))
{
   //compruebo errores formulario
   $error_nombre=$_POST["nombre"]=="";
   $error_sexo=!isset($_POST["sexo"]);

   $errores_form=$error_nombre|| $error_sexo;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 2</title>
    <link rel="icon" href="img/rmescudo.png">
    <style>
         .error{color:red}
    </style>
</head>
<body>
<?php
   if(isset($_POST["btnEnviar"]) && !$errores_form)
   {
      require "vistas/vista_respuestas.php";
   }
   else
   {
      require "vistas/vista_formulario.php";
   }
?>
</body>
</html>