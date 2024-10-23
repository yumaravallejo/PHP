<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen 23/24</title>
</head>
<body>
    <h1>Ejercicio 1. Generador de "claves_cesar.txt"</h1>
    <form action="ej1_examen1_23_24.php" method="post">
        <button type="submit" name="generar">Generar</button>
    </form>
    <?php
        if (isset($_POST['generar'])) {
            $numeros = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26);
            $alfabeto = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", 
            "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
            $nombre_archivo = "claves_cesar.txt";
            
            if(!file_exists($nombre_archivo)) {
                touch($nombre_archivo);
            }
            @$archivo = fopen($nombre_archivo, "w") or die ("No se ha podido abrir el archivo");

            fwrite($archivo, "Letra/Desplazamiento;");

            //Rellenamos la primera línea con números
            for ($i = 0; $i<count($numeros); $i++) {
                fwrite($archivo, $numeros[$i]);
                if (!($i==count($numeros)-1)){
                    fwrite($archivo, ";");
                } else {
                    fwrite($archivo, "\n");
                }
            }

            //Hacemos las siguientes
            for ($j = 0; $j<count($numeros); $j++){
                $salto = $numeros[$j];
                for ($i = 0; $i<count($alfabeto); $i++) {
                    if ($i+$salto < count($alfabeto)) {
                        fwrite($archivo, $alfabeto[$i+$salto]);
                        if (!($i==count($alfabeto)-1)){
                            fwrite($archivo, ";");
                        } else {
                            fwrite($archivo, "\n");
                        }
                    } else {
                        $comienzo = 26-$salto;
                        $salto_final = $i - $comienzo;
                        
                        fwrite($archivo, $alfabeto[$salto_final]);
                        if (!($i==count($alfabeto)-1)){
                            fwrite($archivo, ";");
                        } else {
                            fwrite($archivo, "\n");
                        }
                    }
                }
               
            }



            fclose($archivo);
            echo "<h2>Respuesta</h2>";
            echo "<textarea>";
            @$archivo = fopen($nombre_archivo, "r") or die ("No se ha podido abrir el archivo");
            while (!feof($archivo)) {
                $linea = fgets($archivo);
                echo $linea;
            }
            fclose($archivo);
            echo "</textarea>";
            
        }
    ?>
    
</body>
</html>