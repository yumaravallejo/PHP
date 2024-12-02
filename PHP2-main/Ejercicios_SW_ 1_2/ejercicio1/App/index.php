<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 - Servicios Web</title>
</head>

<body>
    <?php
    define("DIR_SERV", "http://localhost/Proyectos/Ejercicios_SW/ejercicio1/servicios_rest");

    // Esta función nos la da el profe
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

    $datos["cod"] = "YYYYYY";
    $datos["nombre"] = "nombre";
    $datos["nombre_corto"] = "corto";
    $datos["descripcion"] = "corsekfjhsdhfsdfsdljsdhdescripciono";
    $datos["PVP"] = 13.4;
    $datos["familia"] = "MP3";

    $url = DIR_SERV . "/producto/insertar";
    $respuesta = consumir_servicios_REST($url, "POST", $datos);
    $obj = json_decode($respuesta);
    if (!$obj)
        die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);

    if (isset($obj->error))
        die("<p>" . $obj->error . "</p></body></html>");

    echo "<p>" . $obj->mensaje . "</p>"

    ?>
</body>

</html>