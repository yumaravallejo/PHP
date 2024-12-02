<?php

require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;

// Es get, la ruta es http://localhost/Proyectos/Teor_SW/primera_API/saludo y devuelve mensaje
$app->get("/saludo", function () {
    echo json_encode(array("mensaje" => "Hola"));
});

$app->get("/saludo/{nombre}", function ($request) {
    $valor_recibido = $request->getAttribute("nombre");
    echo json_encode(array("mensaje" => "Hola " . $valor_recibido));
});

// url, el parametro nombre y devuelve mensaje
$app->post("/saludo", function ($request) {
    $valor_recibido = $request->getParam("nombre");
    echo json_encode(array("mensaje" => "Hola " . $valor_recibido));
});

// $app->put();
$app->put("/actualizar_saludo/{id}", function ($request) {
    $id_recibida = $request->getAttribute("id");
    $nombre_nuevo = $request->getParam("nombre");
    echo json_encode(array("mensaje" => "Se ha actualizado el saludo con id: " . $id_recibida . " al nombre: " . $nombre_nuevo));
});

// $app->delete();
$app->delete("/borrar_saludo/{id}", function ($request) {
    $id_recibida = $request->getAttribute("id");
    echo json_encode(array("mensaje" => "Se ha borrado el salido con id: " . $id_recibida));
});

$app->get('/saludo2', function () {
    echo json_encode(array("mensaje1" => "Saludo2", "mensaje2" => "saludo2_bis"));
});


// Una vez creado servicios los pongo a disposición
$app->run();
