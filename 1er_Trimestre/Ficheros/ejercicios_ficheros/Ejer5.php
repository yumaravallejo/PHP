<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
</head>
<body>
    <?php
        // Realizar una web que abra el fichero con información sobre el PIB per cápita
        // de los países de la Unión Europea y muestre todo el contenido en una tabla, (
        // url: http://dwese.icarosproject.com/PHP/datos_ficheros.txt).
        // NOTA: Los datos del fichero datos_ficheros.txt vienen separados por un
        // tabulador (“\t”)
        
        $url = "http://dwese.icarosproject.com/PHP/datos_ficheros.txt";

        @$archivo = fopen($url, "r") or die ("<p>* No se ha encontrado el archivo *</p>");
        
        echo "<table border='1'>";
        $linea = fgets($archivo);
        $columnas = explode("\t", $linea);
        $contador = count($columnas);

        echo "<tr>";
        foreach ($columnas as $columna) {
            echo "<th>".$columna."</th>";
        }
        echo "</tr>";

        while (($linea = fgets($archivo)) !== false) {
            // Separar la línea en columnas usando la tabulación como delimitador
            $columnas = explode("\t", $linea);
        
            echo "<tr>";
        foreach($columnas as $columna) {
            if ($columna[0]=="C") {
                echo "<th>".$columna."</th>";
            } else {
                echo "<td>".$columna."</td>";
            }
            
        }

        
        echo "</tr>";
        
    }
       

        
        


        fclose($archivo);
        echo "</table>";
    ?> 
</body>
</html>