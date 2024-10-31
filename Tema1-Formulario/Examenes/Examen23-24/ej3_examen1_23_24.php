<?php
    function caracteres_invalidos($texto) {
        $correcto = true;
        for ($i = 0; $i<strlen($texto); $i++){
            if ($texto[$i]=="ñ" || $texto[$i]=="á" || $texto[$i]=="é" || 
            $texto[$i]=="í" || $texto[$i]=="ú" || $texto[$i]=="ó" || $texto[$i]=="Á" || 
            $texto[$i]=="É" || $texto[$i]=="Í" || $texto[$i]=="Ó" || $texto[$i]=="Ú" || 
            $texto[$i]=="ä" || $texto[$i]=="ë" || $texto[$i]=="ï" || $texto[$i]=="ü" || $texto[$i]=="ö" ||
            $texto[$i]=="Ä" ||$texto[$i]=="Ë" ||$texto[$i]=="Ï" ||$texto[$i]=="Ö" ||$texto[$i]=="Ü") {
                $correcto = false;
            }
        }

        return $correcto;
    }

    function num_valido($texto){
        $correcto = false;
        if ($texto>0 && $texto<27 ){
            $correcto = true;
        }
        return $correcto;
    }

    if(isset($_POST['enviar'])) {
        $error_vacio = $_POST['texto'] == "" || $_POST['desplazamiento'] == "" || $_FILES['fichero']['name'] == "";
        $error_fichero = $_FILES['fichero']['error']!= 0;
        $error_numero = !is_numeric($_POST['desplazamiento']);
        $error_tamano = $_FILES['fichero']['size'] > (1250 * 1024);
        $error_formato = $_FILES['fichero']['type'] != "text/plain";
        $error_form = $error_vacio || $error_fichero || !caracteres_invalidos($_POST['texto']) || !num_valido($_POST['desplazamiento']) ||
        $error_tamano || $error_formato || $error_numero;
    }
?>                                                          
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen 23/24</title>
    <style>
        .error {color:red;}
    </style>
</head>
<body>
    <h1>Ejercicio 3</h1>
    <form action="ej3_examen1_23_24.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="text">Introduzca un texto</label>
            <input type="text" name="texto" id="text" value="<?php if (isset($_POST['texto'])) echo $_POST['texto'];?>">
            <?php
                if (isset($_POST['enviar']) && $error_form){
                    if($_POST['texto']=="") {
                        echo "<span class='error'>* Campo Vacío *</span>";
                    } else if (!caracteres_invalidos($_POST['texto'])) {
                        echo "<span class='error'>* Introduce valores correctos *</span>";

                    }
                }
            ?>
        </p>

        <p>
            <label for="text">Introduzca un desplazamiento</label>
            <input type="text" name="desplazamiento" id="text" value="<?php if (isset($_POST['desplazamiento'])) echo $_POST['desplazamiento'];?>">
            <?php
                if (isset($_POST['enviar']) && $error_form){
                    if ($_POST['desplazamiento']=="") {
                        echo "<span class='error'>* Campo Vacío *</span>";
                    }  else if (!num_valido($_POST['desplazamiento'])) {
                        echo "<span class='error'>* Debes seleccionar un número entre 1 y 26 *</span>";
                    }
                }
            ?>
        </p>

        <p>
            <input type="file" name="fichero" id="fichero">
            <?php
                if (isset($_POST['enviar']) && $error_form){
                    if ($_FILES['fichero']['name']=="") {
                        echo "<span class='error'>* Campo Vacío *</span>";
                    } else if ($_FILES['fichero']['error'] != 0) {
                        echo "<span class='error'>* Hay un error *</span>";
                    } else if ($_FILES['fichero']['size'] < (1250 * 1024)) {
                        echo "<span class='error'>* El tamaño debe ser menor de 1,25MB *</span>";
                    } else if ($_FILES['fichero']['type'] != "text/plain") {
                        echo "<span class='error'>* Debes seleccionar un fichero de texto *</span>";
                    }
                }
            ?>
        </p>

        <button type="submit" name="enviar" title="Enviar formulario">Enviar</button>
    
        <?php
            if(isset($_POST['enviar']) && !$error_form) {
                echo "<h2>Respuesta</h2>";
                $alfabeto = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", 
                "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
                $texto = $_POST['texto'];
                $salto =  $_POST['desplazamiento'];
                
                $nombre_archivo = "claves_cesar.txt";
                @$archivo = fopen($nombre_archivo, "r") or die ("No se ha podido abrir el archivo");

                for ($i=0; $i<=$salto; $i++){
                    $linea = fgets($archivo);
                }

                $arr_linea = explode(";", $linea);
                $texto_sin_espacio = explode(" ", $texto);

                for ($j=0; $j<count($texto_sin_espacio); $j++){

                    for ($x=0; $x<strlen($texto_sin_espacio[$j]); $x++){
                        $valor = $texto_sin_espacio[$j][$x];

                        for ($k=0; $k<count($alfabeto); $k++){
                            if ($valor === $alfabeto[$k]){
                                $texto_sin_espacio[$j][$x] = $arr_linea[$k];
                                break 1;
                            }                            
                        }     
                        
                        

                    }
                }
                
                echo "<p>";
                    for ($m = 0; $m<count($texto_sin_espacio); $m++) {
                        echo $texto_sin_espacio[$m]." ";
                    }
                echo "</p>";

                fclose($archivo);
            }
        ?>

    </form>
</body>
</html>