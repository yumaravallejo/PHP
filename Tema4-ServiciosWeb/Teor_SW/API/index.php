<?php

require __DIR__ . '/Slim/autoload.php';

$app= new \Slim\App;

$app->get('/saludo',function(){

    $respuesta["mensaje"]="Hola que tal?";
    echo json_encode($respuesta);
});

$app->get('/saludo/{nombre}',function($request){
    $nombre=$request->getAttribute("nombre");
    $respuesta["mensaje"]="Hola que tal, ".$nombre."?";
    echo json_encode($respuesta);
});

$app->post('/saludo',function($request){

    //se envian los datos por debajo
    $nombre=$request->getParam("nombre");
    $respuesta["mensaje"]="Hola que tal, ".$nombre."? (post)";
    echo json_encode($respuesta);

});

$app->put('/cambiar_saludo/{id}',function($request){

    //se envian los datos por debajo
    $nombre=$request->getAttribute("id");
    $nombreNuevo=$request->getParam("nombreNuevo");
    $respuesta["mensaje"]="actualizado el nombre ".$nombre." por ".$nombreNuevo;
    $obj = json_decode($respuesta);
    if (!$obj)die("<p>Error.</p>");

    echo json_encode($respuesta);

});

$app->delete('/borrar_saludo/{id}',function($request){
    $id=$request->getAttribute("id");
    $respuesta["mensaje"]="Borrado el saludo con id: ".$id;
    echo json_encode($respuesta);

});

$app->run();

?>