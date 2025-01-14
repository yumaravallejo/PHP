<?php

require __DIR__ . '/Slim/autoload.php';

require "src/funciones_ctes.php";

$app = new \Slim\App;

$app->get('/productos', function () {

    echo json_encode(obtener_productos());
});

$app->get('/producto/{codigo}', function ($request) {

    $cod = $request->getAttribute("codigo");
    echo json_encode(obtener_producto($cod));
});

$app->post('/producto/insertar', function ($request) {
    //Estos nombre deben ser iguales a la BBDD
    $datos[] = $request->getParam("cod");
    $datos[] = $request->getParam("nombre");
    $datos[] = $request->getParam("nombre_corto");
    $datos[] = $request->getParam("descripcion");
    $datos[] = $request->getParam("PVP");
    $datos[] = $request->getParam("familia");

    echo json_encode(insertar_producto($datos));
});

$app->put('/producto/actualizar{codigo}', function ($request) {
    //Estos nombre deben ser iguales a la BBDD
    $datos[] = $request->getParam("nombre");
    $datos[] = $request->getParam("nombre_corto");
    $datos[] = $request->getParam("descripcion");
    $datos[] = $request->getParam("PVP");
    $datos[] = $request->getParam("familia");
    $datos[] = $request->getAttribute("codigo");

    echo json_encode(actualizar_producto($datos));
});


$app->run();
