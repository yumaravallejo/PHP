<?php

if(isset($_POST["btnLogin"]))
{   
    $error_usuario=$_POST["usuario"]=="";
    $error_clave=$_POST["clave"]=="";
    $error_form_login=$error_usuario || $error_clave;
    if(!$error_form_login)
    {
       
        // Me he conectado y ahora hago la consulta
        try
        {
            $consulta="SELECT tipo FROM usuarios WHERE lector=? AND clave=?";
            $sentencia=$conexion->prepare($consulta);
            $sentencia->execute([$_POST['usuario'], md5($_POST['clave'])]);

            if($sentencia->rowCount()>0)
            {
                //El usuario se encuentra registrado y tengo que iniciar session
                $datos_usu_log=$sentencia->fetch(PDO::FETCH_ASSOC);
                $sentencia=null;
                $_SESSION["lector"]=$_POST["usuario"];
                $_SESSION["clave"]=md5($_POST["clave"]);
                $_SESSION["ultima_accion"]=time();

                if($datos_usu_log["tipo"]=="normal")                
                    header("Location:index.php");
                else
                    header("Location:admin/gest_libros.php");
                exit;

            }
            else
            {
                $sentencia=null;
                $error_usuario=true;
            }
                

        }
        catch(Exception $e)
        {
            $conexion= null;
            $sentencia=null;
            session_destroy();
            die(error_page("Práctica 9","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
        }

    }
}


try{
    $consulta="SELECT * FROM libros";
    $result_libros=$conexion->prepare($consulta);
    $result_libros->execute();
    $conexion = null;
    $sentencia = null;
}
catch(Exception $e){
    session_destroy();
    $sentencia = null;
    $conexion = null;
    die(error_page("Examen2 Php PDO","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen2 Php</title>
    <style>
        .contenedor_libros{display:flex;flex-flow: row wrap;}
        .contenedor_libros div{width:30%;text-align:center; margin-top: auto}
        .contenedor_libros div img{height:150px}
        .mensaje{font-size:1.25em;color:blue}
        .error{color:red}
    </style>
</head>
<body>
    <h1>Libreria</h1>
    <form action="index.php" method="post">
        <p>
            <label for="usuario">Usuario: </label>
            <input type="text" id="usuario" name="usuario" value="<?php if(isset($_POST["usuario"])) echo $_POST["usuario"];?>"/>
            <?php
            if(isset($_POST["btnLogin"]) && $error_usuario)
            {
                if($_POST["usuario"]=="")
                    echo "<span class='error'>* Campo vacío *</span>";
                else
                    echo "<span class='error'>* Usuario y/o contraseña incorrectos  *</span>";
            }
            ?>
        </p>
        <p>
            <label for="clave">Contraseña: </label>
            <input type="password" name="clave" id="clave"/>
            <?php
            if(isset($_POST["btnLogin"]) && $error_clave)
            {
                echo "<span class='error'>* Campo vacío *</span>";
            }
            ?>
        </p>
        <p>
            <button name="btnLogin" type="submit">Login</button> 
        </p>
    </form>
    <?php
    if(isset($_SESSION["seguridad"]))
    {
        echo "<p class='mensaje'>".$_SESSION["seguridad"]."</p>";
        session_destroy();
    }

    require "vistas/libros_tres_en_tres.php";
    ?>
   

</body>
</html>