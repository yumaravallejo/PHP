<?php
header("Access-Control-Allow-Origin: *");
//Se abre el fichero deonde están almacenados los datos
$fichero = "resultados.txt";
$contenido = file($fichero);
//colocamos el contenido en un array y lo almacenamos en cuatro variables por equipos
$array = explode("||", $contenido[0]);
$fototipo1 = $array[0];
$fototipo2 = $array[1];
$fototipo3 = $array[2];
$fototipo4 = $array[3];
$fototipo5 = $array[4];
$fototipo6 = $array[5];

//extraemos el voto de los participantes
$voto = $_GET['voto'];

//actualizamos los votos añadiendo el recibido a los anteriores
switch ($voto) {
    case 1:
        $fototipo1++;
        break;
    case 2:
        $fototipo2++;
        break;
    case 3:
        $fototipo3++;
        break;
    case 4:
        $fototipo4++;
        break;
    case 5:
        $fototipo5++;
        break;
    default:
        $fototipo6++;
        break;
}

//creamos la cadena que se va a insertar en el fichero
$insertvoto = $fototipo1 . "||" . $fototipo2 . "||" . $fototipo3 . "||" . $fototipo4 . "||" . $fototipo5 . "||" . $fototipo6;
//se abre el fichero como escritura y se escriben los votos actualizados
$fp = fopen($fichero, "w");
fputs($fp, $insertvoto);
fclose($fp);

$resultados = array($fototipo1, $fototipo2, $fototipo3, $fototipo4, $fototipo5, $fototipo6);
echo json_encode($resultados);
