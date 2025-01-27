<?php
session_name("ejercicios_casa");
session_start();
require "src/funciones_ctes.php";

//Llamada siempre a los productos
$url = DIR_SERV."/productos";
$respuesta = consumir_servicios_REST($url, "GET"); // --> Esto devuelve un json
$json_productos = json_decode($respuesta, true);

if (!$json_productos) {
    session_destroy();
}

if(isset($json_productos["error"])){
    session_destroy();
    die(error_page("Actividad 2","<p>".$json_productos["error"]."</p>"));
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Probando mi API</title>
</head>

<body>
    <h1>Probando mi API</h1>

    <?php
    //Esto se "dibuja siempre"
    echo "<table class='centrado txt_centrado'>";
    echo "<tr><th>COD</th><th>Nombre</th><th>PVP (€)</th></tr>";
    
    foreach($json_productos["productos"] as $tupla)
    {
        echo "<tr>";
        echo "<td><form action='index.php' method='post'><button class='enlace' name='btnDetalles' value='".$tupla["cod"]."' type='submit'>".$tupla["cod"]."</button></form></td>";
        echo "<td>".$tupla["nombre_corto"]."</td>";
        echo "<td>".$tupla["PVP"]."</td>";
        echo "<td><form action='index.php' method='post'><button class='enlace' name='btnBorrar' value='".$tupla["cod"]."' type='submit'>Borrar</button> - <button class='enlace' name='btnEditar' value='".$tupla["cod"]."' type='submit'>Editar</button></form></td>";
        echo "</tr>";
    }
    echo "</table>"
    ?>
    </table>

</body>

</html>