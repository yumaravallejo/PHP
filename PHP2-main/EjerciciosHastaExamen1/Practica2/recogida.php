<?php
    if (isset($_POST["enviar"])) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recogida de datos</title>
</head>
<body>
    <h1>Recogiendo los datos</h1>
    <?php
    // Recogemos las variables
        
        // echo $aficiones;

        $nombre = $_POST["nombre"];
        $nacido = $_POST["nacido"];
        if (isset($_POST["sexo"])) {
            $sexo = $_POST["sexo"];
        }
        $aficiones = "";
        for ($i = 0; $i < count($_POST["aficiones"]); $i++) {
            $aficiones .= $_POST["aficiones"][$i]." - ";
        }
        $comentarios = $_POST["comentarios"];
    
    // Imprimimos en p
        echo "<p><strong>Nombre: </strong>".$nombre."</p>";
        echo "<p><strong>Nacido en: </strong>".$nacido."</p>";
        echo "<p><strong>Sexo: </strong>".$sexo."</p>";
        echo "<p><strong>Aficiones: </strong>".$aficiones."</p>";
        echo "<p><strong>Comentarios: </strong>".$comentarios."</p>";
    ?>
</body>
</html>
<?php
    }
?>