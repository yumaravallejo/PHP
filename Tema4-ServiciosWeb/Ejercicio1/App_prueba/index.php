<?php
require "../servicios_rest/src/funciones_ctes.php";

function consumir_servicios_REST($url, $metodo, $datos = null)
{
    $llamada = curl_init();
    curl_setopt($llamada, CURLOPT_URL, $url);
    curl_setopt($llamada, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($llamada, CURLOPT_CUSTOMREQUEST, $metodo);
    if (isset($datos))
        curl_setopt($llamada, CURLOPT_POSTFIELDS, http_build_query($datos));
    $respuesta = curl_exec($llamada);
    curl_close($llamada);
    return $respuesta;
}

CONST DIR_SERV = "http://localhost/PHP/Tema4-ServiciosWeb/Ejercicio1/servicios_rest";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba de los Servicios Actividad 1</title>
    <style>
        table {border: 1px solid black; border-collapse: collapse;}
        table, th, td {border: 1px solid black; padding: 1rem; text-align: center;}
        th {font-size: 1.4rem;}
        .error {color:red}
    </style>
</head>

<body>
    <h1>Productos de la tienda</h1>
    <?php
    $url = DIR_SERV."/productos";
    $respuesta = consumir_servicios_REST($url, "GET");
    $obj = json_decode($respuesta);
    //$obj = json_decode($respuesta,true); --> con esto creará en array asociativo en vez de un objeto
    //$obj->productos, se convertiría en $obj["productos"]
    if (!$obj)
        die ("<p>Error consumiendo el servicio web <strong>".$url."</strong></p></body></html>");

    if (isset($obj->error))
        die("<p>".$obj->error."</p></body></html>");

    echo "<table>";
    echo "<tr><th>Código</th><th>Nombre corto</th><th>PVP</th></tr>";
    
    foreach($obj->productos as $tupla){
        echo "<tr>";
        echo "<td>".$tupla->cod."</td>
              <td style='text-align:left'>".$tupla->nombre_corto."</td>
              <td>".$tupla->PVP."</td>";
        echo "</tr>";
    } 
    echo "</table>";
    
    ?>

</body>

</html>