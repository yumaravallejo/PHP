<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
//Se abre el fichero deonde están almacenados los datos
$fichero = "resultados.txt";
$contenido = file($fichero);
//colocamos el contenido en un array y lo almacenamos en cuatro variables por equipos
$array = explode("||", $contenido[0]);

echo json_encode($array);
