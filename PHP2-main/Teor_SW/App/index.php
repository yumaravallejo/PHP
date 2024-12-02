<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría Servicios Web</title>
</head>

<body>
    <?php
    define("DIR_SERV", "http://localhost/Proyectos/Teor_SW/primera_API");

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

    // Hay dos métodos para consumir servicios web (uno fácil pero solo 
    // sirve para get y otro dificil que sirve para todos los métodos)

    // MÉTODO GET 1
    $url = DIR_SERV . "/saludo";
    // OPCIÓN 1 CUTRE
    // $respuesta = file_get_contents($url); // Me devuelve un obj encode
    // OPCIÓN BUENA
    $respuesta = consumir_servicios_REST($url, "GET");
    $obj = json_decode($respuesta); // Si no recibo un json, da false
    if (!$obj)
        die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
    echo "<p>El saludo recibido ha sido <strong>" . $obj->mensaje . "</strong></p>";

    // MÉTODO GET 2
    // El url encode es por si hay espacios o está incorrecta, las traduce a una url buena
    $url = DIR_SERV . "/saludo/" . urlencode("Maria Antonia");
    $respuesta = consumir_servicios_REST($url, "GET");
    $obj = json_decode($respuesta); // Si no recibo un json, da false
    if (!$obj)
        die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
    echo "<p>El saludo recibido ha sido <strong>" . $obj->mensaje . "</strong></p>";

    // MÉTODO POST
    $url = DIR_SERV . "/saludo";
    $respuesta = consumir_servicios_REST($url, "POST", array("nombre" => "Nerea"));
    $obj = json_decode($respuesta); // Si no recibo un json, da false
    if (!$obj)
        die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
    echo "<p>El saludo recibido ha sido <strong>" . $obj->mensaje . "</strong></p>";

    // MÉTODO DELETE
    $url = DIR_SERV . "/borrar_saludo/37";
    $respuesta = consumir_servicios_REST($url, "DELETE");
    $obj = json_decode($respuesta); // Si no recibo un json, da false
    if (!$obj)
        die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
    echo "<p>El mensaje recibido ha sido <strong>" . $obj->mensaje . "</strong></p>";

    // MÉTODO PUT DONDE RECIBE DATOS TANTO POR POST COMO POR GET
    $url = DIR_SERV . "/actualizar_saludo/24";
    $respuesta = consumir_servicios_REST($url, "PUT", array("nombre" => "Eduardo"));
    $obj = json_decode($respuesta); // Si no recibo un json, da false
    if (!$obj)
        die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
    echo "<p>El saludo recibido ha sido <strong>" . $obj->mensaje . "</strong></p>";

    ?>
</body>

</html>