<?php
    if(isset($_POST['contar'])) {
        $error_vacio = $_POST['texto'] == "";
        $error_form = $error_vacio;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen 23/24</title>
</head>
<body>
    <h1>Ejercicio 1. Generador de "claves_cesar.txt"</h1>
    <form action="ej2_examen1_23_24.php" method="post">
        <p>
            <label for="text">Introduzca un texto</label>
            <input type="text" name="texto" id="text" value="<?php if (isset($_POST['texto'])) echo $_POST['texto'];?>">
            <?php
                if (isset($_POST['contar']) && $error_form){
                    echo "<span class='error'>* Campo Vacío *</span>";
                }
            ?>
        </p>

        <p>
            <select name="separador" id="separador">
                <option value=";" selected>Punto y coma</option>
                <option value=",">Coma</option>
                <option value=" ">Espacio</option>
                <option value=":">Dos puntos</option>
            </select>
        </p>
        <button type="submit" name="contar">Contar</button>
    </form>
    <?php
        if (isset($_POST['contar']) && !$error_form){
            $separador = $_POST['separador'];
            $texto = $_POST['texto'];

            $texto_separado = explode($separador, $texto);

            $contador = 0;
            for ($i = 0; $i<count($texto_separado); $i++){
                $correcta = true;
                if (!$texto_separado[$i]==""){
                    for ($j = 0; $j<strlen($texto_separado[$i]); $j++){
                        if ($texto_separado[$i][$j]=="a" || $texto_separado[$i][$j]=="e" || $texto_separado[$i][$j]=="i"
                        || $texto_separado[$i][$j]=="o" || $texto_separado[$i][$j]=="u"  || $texto_separado[$i][$j]=="A"
                        || $texto_separado[$i][$j]=="E" || $texto_separado[$i][$j]=="I"  || $texto_separado[$i][$j]=="O"
                        || $texto_separado[$i][$j]=="U") {
                            $correcta = false;
                        }
                    }
                    if ($correcta) {
                        $contador++;
                    }
                }
            }

            echo "<h2>Respuesta</h2>";
            echo "<p>El texto <strong>".$texto."</strong> con el separador '".$separador."' contiene ".$contador." palabras sin  las vocales</p>";
        }
    ?>

</body>
</html>
