<?php
// Obtenemos todos los productos
$url = DIR_SERV . "/productos";
$respuesta = consumir_servicios_REST($url, "GET",);
$obj = json_decode($respuesta);
if (!$obj) {
    session_destroy();
    die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
}

if (isset($obj->error)) {
    session_destroy();
    die("<p>" . $obj->error . "</p></body></html>");
}

foreach ($obj->productos as $tupla) {
    echo "
            <tr>
                <form action='index.php' method='post'>
                    <td><button class='enlace' type='submit' name='btnDetalles' value='" . $tupla->cod . "'>" . $tupla->cod . "</button></td>
                    <td>" . $tupla->nombre_corto . "</td>
                    <td>" . str_replace(".", ",", $tupla->PVP) . "€</td>
                    <td><button class='enlace' type='submit' name='btnBorrar' value='" . $tupla->cod . "'>Borrar</button> - 
                    <button class='enlace' type='submit' name='btnEditar' value='" . $tupla->cod . "'>Editar</button></td>
                </form>
            </tr>
            ";
}
