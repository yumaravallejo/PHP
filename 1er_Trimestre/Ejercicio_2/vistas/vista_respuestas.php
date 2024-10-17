<?php    

    if (isset($_POST["btnEnviar"]) && !$errores_form) {
        echo "<h1>Recogida de Datos</h1>";
        echo "<p><strong>Nombre: </strong>".$_POST["nombre"]."</p>";
        echo "<p><strong>Nacido en: </strong>".$_POST["nacido"]."</p>";
        echo "<p><strong>Sexo: </strong>";
        if(isset($_POST["sexo"]))
        {
            echo $_POST["sexo"];
        }
        echo "</p>";
        echo "<p><strong>Las aficiones elegidas han sido: </strong>";
        if(isset($_POST["aficiones"]))
        {
            echo "<ol>";
            // foreach($_POST['aficiones'] as $key=>$valor) { --> Con esto vemos el index
            // echo "<li>índice (Clave): ".$key." Valor: ".$valor."</li>";
            foreach($_POST['aficiones'] as $aficion) {
                echo "<li>".$aficion."</li>";
            }
            echo "</ol>";

            $aficiones = $_POST["aficiones"];
            // var_dump($aficiones);

            // print_r($aficiones);
            // echo "<ol>";
            // for ($i = 0; $i<count($aficiones);$i++) {
            //     echo "<li>".$aficiones[$i]."</li>";
            // }
            // echo "</ol>";
        }
        else
        {
            echo "No ha seleccionado nada";
        }
        echo "</p>";
        echo "<p><strong>Comentarios: </strong>".$_POST["comentarios"]."</p>";
    }
?>