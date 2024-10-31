<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría de Ficheros de texto</title>
</head>
<body>
    <h1>Teoría de ficheros de texto</h1>
    <?php
        //Abrir un fichero
        @$file=fopen("prueba.txt", "r");
        //r -> reading w-> writing x-> executable
        if(!$file) {
            //Escribe y termina
            die ("<p>No se ha podido abrir el fichero 'prueba.txt'</p>");
        } 

        // $linea=fgets($file);
        // echo "<p>".$linea."</p>";

        // $linea=fgets($file);
        // echo "<p>".$linea."</p>";

        // $linea=fgets($file);
        // echo "<p>".$linea."</p>";

        // //Si lo pones más veces que líneas haya no ocurre nada
        // $linea=fgets($file);
        // echo "<p>".$linea."</p>";

        //Maneras de Recorrer un fichero
        // 1.-
        while(!feof($file)){
            $linea=fgets($file);
            echo "<p>".$linea."</p>";
        }
        echo "<h2>Recorremos de nuevo</h2>";
        //2.-
        //Vuelvo a recorrerlo posicionandome de nuevo arriba
        fseek($file,0);
        while($linea=fgets($file)){
            echo "<p>".$linea."</p>";
        }

        echo "<h2>Fin del fichero</h2>";

        fclose($file);
                
        echo "<h2>Añadimos una línea</h2>";
        //Añadir un a línea
        //Abrimos de nuevo en modo a
        @$file=fopen("prueba.txt", "a");
        //r -> reading w-> writing x-> executable a-> add
        if(!$file) {
            //Escribe y termina
            die ("<p>No se ha podido abrir el fichero 'prueba.txt'</p>");
        } 

        //Añadir contenido al fichero
        // fputs($file, PHP_EOL."Cuarta línea.");
        // fwrite($file, PHP_EOL."Quinta línea.");

        echo "<h2>Fin del fichero</h2>";

        fclose($file);

        echo "<h2>Lectura entera de un fichero</h2>";

        @$todo = file_get_contents("prueba.txt");
        echo $todo;
        //Cómo poner saltos de línea
        echo "<pre>".$todo."</pre>";
        echo nl2br($todo);

        echo "<h3>Lectura entera de un fichero</h3>";

        //Una web no deja de ser un fichero de por ahí del mundo
        $web=file_get_contents("https://www.google.es");
        echo $web;
    ?>
</body>
</html>