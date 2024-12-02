<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría fichero de texto</title>
</head>
<body>
    <?php
        // Abrir un fichero fopen(ruta, permisos)
        // Si lo metemos en una variable nos da una especie de puntero
        @$fd1 = fopen('prueba.txt','r+');
        if (!$fd1) {
            // Es como un exit
            die('<p>No se ha podido abrir el fichero prueba.txt</p>');
        }
        echo '<h1>Por ahora todo en orden</h1>';

        // Coge la primera línea del fichero
        $linea = fgets($fd1);
        echo '<p>'.$linea.'</p>';

        // Si lo volvemos a hacer pasa a la siguiente línea
        $linea = fgets($fd1);
        echo '<p>'.$linea.'</p>';

        // Si nos pasamos de las líneas que tiene el fichero, nos hace una p vacía
        // ya que sería echo false

        // Para volver al principio
        fseek($fd1, 0);

        // Para recorrer un fichero
        while ($linea = fgets($fd1)) { // Mientras esa asignación tenga éxito (no sea false)
            echo '<p>'.$linea.'</p>';
        } 

        // Si queremos escribir
        // fputs() o
        fwrite($fd1, 'holi'); // Escribe en la última línea
        
        // Para escribir una línea al final.
        fwrite($fd1, PHP_EOL.'holi');

        // Para volver al principio
        fseek($fd1, 0);

        // Para recorrer un fichero
        while ($linea = fgets($fd1)) { // Mientras esa asignación tenga éxito (no sea false)
            echo '<p>'.$linea.'</p>';
        } 

        $todo_fichero = file_get_contents('prueba.txt');
       // echo '<pre>'.$todo_fichero.'</pre>';
       echo nl2br($todo_fichero); // transforma los \n a <br>

       // Nos coge información de las páginas
       $todo_fichero = file_get_contents('www.google.com');

        // Para cerrar el fichero
        fclose($fd1);
        
    ?>
</body>
</html>