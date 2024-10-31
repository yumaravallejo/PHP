<?php
    // if (isset($_FILES['foto'])) {
    //     var_dump($_FILES['foto']);
    // }

    function tiene_extension($texto) {
        $texto_separado = explode(".", $texto); //Devuelve array
        if (count($texto_separado) > 1) {
            $respuesta = end($texto_separado);
        } else {$respuesta = false;}
        return $respuesta;
    }

    // getImageFunción que calcula el tamaño de una imagen --> si peta no es una imagen

    

    if(isset($_POST['enviar'])) {
        //Si he seleccionado la imagen (ya que en este caso es optativo) comprobaré que haya errores
        $error_foto = $_FILES['foto']['name'] != "" && ($_FILES['foto']['error'] || !tiene_extension($_FILES['foto']['name']) 
                        || !getimagesize($_FILES['foto']['tmp_name']) || $_FILES['foto']['size']>500*1024);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría Subir Ficheros</title>
    <style>.error{color:red;} p img {height: 200px;}</style>
</head>
<body>
    <h1>Teoría Subir Ficheros</h1>
    <form action="index_opt.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="">Selecciona un archivo imagen (Máx 500KB): </label>
            <input type="file" name="foto" id="foto" accept="image/*">
            <?php
                if (isset($_POST['enviar']) && $error_foto){
                    if ($_FILES['foto']['error']) {
                        echo "<span class='error'>* No se ha subido el archivo seleccionado al servidor *</span>";
                    } else if (!tiene_extension($_FILES['foto']['name'])) {
                        echo "<span class='error'>* Has seleccionado un fichero sin extensión *</span>";
                    } else if (!getimagesize($_FILES['foto']['tmp_name'])) {
                        echo "<span class='error'>* No has seleccionado una imagen *</span>";
                    } else {
                        echo "<span class='error'>* El fichero es mayor de 5000 kb *</span>";
                    }
                }
            ?>
        </p>

        <p>
            <button type="submit" name="enviar">Enviar</button>
        </p>


    </form>

    <?php 
        if (isset($_POST['enviar']) && !$error_foto) {
            if(!$_FILES['foto']['name'] != "") {

            if (isset($_POST['enviar']) && !$error_foto) {
                //Pasamos de temporal a guardar las imágenes
                // 1º Creamos un nuevo nombre único
                $num_unico = md5(uniqid(uniqid(), true));
                $ext = tiene_extension($_FILES['foto']['name']);
                $nombre_imagen = "img_".$num_unico.".".$ext;
                echo $nombre_imagen;

                //2º Movemos la imagen a la ruta que queramos
                //Esta función puede dar un error --> si no le damos permiso a la carpeta de escritura al menos
                // En windows funcionaría, en linux no
                @$var=move_uploaded_file($_FILES['foto']['tmp_name'], "../img/".$nombre_imagen);
                
                if(!$var){
                    echo "<p>No se ha podido mover la imagen a la carpeta en el servidor</p>";

                } else {
                    echo "<p>Nombre original: ".$_FILES['foto']['name']."</p>";
                    echo "<p>Tipo: ".$_FILES['foto']['type']."</p>";
                    echo "<p>Tamaño: ".$_FILES['foto']['size']."</p>";
                    echo "<p>Archivo subido temporalmente en: ".$_FILES['foto']['tmp_name']."</p>";
                    echo "<img src='../img/".$nombre_imagen."' alt='Imagen subida' title='Imagen de perfil de usuario'>";

                }

                echo "<h1>Información de la imagen subida</h1>";
            }
        }
    }
    ?>
    
</body>
</html>