<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
    <style>
        table, tr, td, th {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h1>Ejercicio 6</h1>
    <?php
        // Modificar el ejercicio anterior realizando una web con un formulario que contenga un select con las iniciales de un país y muestre el PIB per cápita de
        // todos los años disponibles del país seleccionado
    
        @$archivo = fopen("http://dwese.icarosproject.com/PHP/datos_ficheros.txt", "r") 
        or die ("No se ha podido encontrar el fichero");
    
        $linea = fgets($archivo);
        $datos_primera_linea = explode("\t", $linea); 

    ?>

    <form action="Ejer6.php" method="post">
        <p>
            <label for="pais">Seleccione un país:</label>
            <select name="pais" id="pais">
            <?php

            $cont = 1;
            while($linea=fgets($archivo)){ //Mientras haya línea
                $datos_linea = explode("\t", $linea);
                $datos_prim_col = explode(",", $datos_linea[0]);

                if (isset($_POST['pais']) && $_POST['pais']==$cont) {
                    echo "<option selected value='".$cont."'>".end($datos_prim_col)."</option>";
                    $cont++;
                } else {
                    echo "<option value='".$cont."'>".end($datos_prim_col)."</option>";
                    $cont++;
                }
            }
            if (isset($_POST['buscar']))
                fclose($archivo);
            ?>
            </select>
        </p>

        <p>
            <button type="submit" name="buscar">Buscar</button>
        </p>
    </form>

    <?php
    if (isset($_POST['buscar'])) {
        @$archivo = fopen("http://dwese.icarosproject.com/PHP/datos_ficheros.txt", "r") 
        or die ("No se ha podido encontrar el fichero");
        $linea = fgets($archivo);     
    
        $cont = 1;

        while($cont<=$_POST['pais']) {
            $linea = fgets($archivo);
            $cont++;
        }

        $datos_linea = explode("\t", $linea);
        $datos_prim_col = explode(",", $datos_linea[0]);
        $n_col = count($datos_primera_linea);
        echo "<h2>PIB PER CAPITA DE ".end($datos_prim_col)."</h2>";

        echo "<table>";
            echo "<tr>";
            for ($i = 2; $i<$n_col; $i++) {
                echo "<th>".$datos_primera_linea[$i]."</th>";
            }
            echo "</tr>";

            echo "<tr>";
            for ($i = 2; $i<$n_col; $i++) {
                if(isset($datos_primera_linea[$i])) {
                    echo "<td>".$datos_primera_linea[$i]."</td>";
                } else {
                    echo "<td></td>";
                }
            }
            echo "</tr>";
        echo "</table>";

        fclose($archivo);
    }
    ?>

</body>
</html>