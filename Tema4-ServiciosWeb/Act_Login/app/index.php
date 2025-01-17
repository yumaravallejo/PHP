<?php
require "../api_login/src/funciones_ctes.php";

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

const DIR_SERV = "http://localhost/PHP/Tema4-ServiciosWeb/Act_Login/api_login";


if (isset($_POST['btnLogin'])) {
    if ($_POST['usuario'] == "" || $_POST['clave'] == "")
        $error_form = "<p>Rellena todos los campos</p>";
    else {
        $url = DIR_SERV . "/login";
        unset($_POST["btnLogin"]);
        $_POST['clave'] = md5($_POST['clave']);
        $respuesta = consumir_servicios_REST($url, "POST", $_POST);
        $obj = json_decode($respuesta, true);
        //$obj = json_decode($respuesta,true); --> con esto creará en array asociativo en vez de un objeto
        //$obj->productos, se convertiría en $obj["productos"]
        if (!$obj)
            die("<p>Error consumiendo el servicio web <strong>" . $url . "</strong></p></body></html>");

        if (isset($obj['error']))
            die("<p>" . $obj['error'] . "</p></body></html>");

        if (isset($obj['usuario'])) {
            echo $obj['usuario']['usuario'];
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba Login</title>
</head>

<body>
    <h1>Login con Servicios Rest</h1>
    <form action="index.php" method="post">
        <p>
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario">
        </p>

        <p>
            <label for="usuario">Clave:</label>
            <input type="password" name="clave" id="clave">
        </p>

        <p>
            <button type="submit" name="btnLogin">Login</button>
        </p>
    </form>
</body>

</html>