<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>
    <h1>Ejercicio1. Generador de "claves_polybios.txt"</h1>
    <form action="ejercicio1.php" method="post">
        <button type="submit" name="btnGenerar">Generar</button>
    </form>
    <?php 
        if (isset($_POST["btnGenerar"])) {

            

            @$fd1 = fopen("claves_polybios.txt", "w+");
            if (!$fd1) {
                die('<p>No se ha podido abrir el fichero claves_polybios.txt</p>');
            }
            fwrite($fd1, 'i/j;1;2;3;4;5');
            $k = ord("A");
            for ($i = 1; $i <= 5; $i++) {
                fwrite($fd1, PHP_EOL.$i.";");
                    for ($j = 1; $j <= 5; $j++) {
                        // La J nos la saltamos;
                        if($i == 2 && $j == 5) $k++;
                        fwrite($fd1, chr($k).";");
                        $k++;
                    }
                    
                
            }

            $texto = "";
            fseek($fd1, 0);
            while ($linea = fgets($fd1)) {
                $texto .= $linea;
            }
            
    ?>
            <h2>Respuesta</h2>
            <textarea name="respuesta" id="respuesta" cols="20" rows="7"><?php echo $texto ?></textarea>
            <p>Fichero generado con éxito</p>
    <?php
    fclose($fd1);
        }
    ?>
</body>
</html>