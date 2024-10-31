<?php
if(isset($_POST["btnEnviar"]))
{
   //compruebo errores formulario
   $error_nombre=$_POST["nombre"]=="";
   $error_apellidos=$_POST["apellidos"]=="";
   $error_clave=$_POST["clave"]=="";
   $error_dni=$_POST["dni"]=="";
   $error_sexo=!isset($_POST["sexo"]);
   $error_comentarios=$_POST["comentarios"]=="";

   $errores_form=$error_nombre||$error_apellidos||$error_clave||$error_dni||$error_sexo|| $error_comentarios;

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Esta es mi super página</h1>

    <form action="index.php" method="get"> <!-- En este caso podríamos poner el que quisieramos get o post -->
     
        <p>
            <label for="nombre">Nombre: </label><br/>
            <input type="text" name="nombre" id="nombre" value="<?php if(isset($_POST["nombre"])) echo $_POST["nombre"];?>"/>
            <?php
            if(isset($_POST["btnEnviar"])&& $error_nombre)
               echo "<span class='error'> * Campo obligatorio *</span>";
            ?>
         </p>

         <p>
            <label for="nacido">Nacido en: </label>
            <select name="nacido" id="nacido">
               <option <?php if(isset($_POST["nacido"]) && $_POST["nacido"]=="Málaga") echo "selected";?> value="Málaga">Málaga</option>
               <option <?php if(isset($_POST["nacido"]) && $_POST["nacido"]=="Almería") echo "selected";?> value="Almería">Almería</option>
               <option <?php if(isset($_POST["nacido"]) && $_POST["nacido"]=="Granada") echo "selected";?> value="Granada">Granada</option>
            </select>
         </p>

         <p>
            Sexo: 
            <label for="hombre">Hombre</label><input type="radio" name="sexo" id="hombre" <?php if(isset($_POST["sexo"]) && $_POST["sexo"]=="hombre") echo "checked";?> value="hombre"/>
            <label for="mujer">Mujer</label><input type="radio" name="sexo" id="mujer" <?php if(isset($_POST["sexo"]) && $_POST["sexo"]=="mujer") echo "checked";?> value="mujer"/>
            <?php
            if(isset($_POST["btnEnviar"])&& $error_sexo)
               echo "<span class='error'> * Debes elegir un sexo *</span>";
            ?>
         </p>

         <p>
            Aficiones:
            <label for="deportes">Deportes</label><input type="checkbox" name="aficiones" id="deportes" value="1" <?php if(isset($_POST["aficiones"]) && $_POST["aficiones"]=="1") echo "selected";?>/>
            <label for="lectura">Lectura</label><input type="checkbox" name="aficiones" id="lectura" value="2" <?php if(isset($_POST["aficiones"]) && $_POST["aficiones"]=="2") echo "selected";?>/>
            <label for="otros">Otros</label><input type="checkbox" name="aficiones" id="otros" value="3" <?php if(isset($_POST["aficiones"]) && $_POST["aficiones"]=="3") echo "selected";?>/>
        </p>

        <p>
            <label for="comentarios">Comentarios: </label>
            <textarea name="comentarios" id="comentarios" cols="40" rows="4"><?php if(isset($_POST["comentarios"])) echo $_POST["comentarios"];?></textarea>
            
            <!-- if(isset($_POST["btnEnviar"])&& $error_comentarios)
                    echo "<span class='error'> * Campo Vacío *</span>"; -->
        </p>

        <p>
            <input type="submit" value="Enviar" name="btnEnviar"/>  
         </p>

         <?php
         if (isset($_POST["btnEnviar"]) && !$errores_form) {
            echo "<h1>Recogida de Datos</h1>";
            echo "<p><strong>Nombre: </strong>".$_POST["nombre"]."</p>";
            echo "<p><strong>Apellidos: </strong>".$_POST["apellidos"]."</p>";
            echo "<p><strong>Contraseña: </strong>".$_POST["clave"]."</p>";
            echo "<p><strong>DNI: </strong>".$_POST["dni"]."</p>";
            echo "<p><strong>Sexo: </strong>";
            if(isset($_POST["sexo"]))
            {
                echo $_POST["sexo"];
            }
            echo "</p>";
            echo "<p><strong>Nacido: </strong>".$_POST["nacido"]."</p>";
            echo "<p><strong>Comentarios: </strong>".$_POST["comentarios"]."</p>";
            echo "<p><strong>Subcripción: </strong>";
            if(isset($_POST["subcripcion"]))
            {
                echo "Sí";
            }
            else
            {
                echo "No";
            }
            echo "</p>";
         }
         ?>
    </form>
</body>
</html>