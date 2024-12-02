<?php

require "src/funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;



$app->get('/conexion_PDO', function ($request) {

    echo json_encode(conexion_pdo());
});

$app->get('/conexion_MYSQLI', function ($request) {

    echo json_encode(conexion_mysqli());
});

$app->post('/login', function ($request) {
    $lector = $request->getParam("lector");
    $clave = $request->getParam("clave");
    echo json_encode(login($lector, $clave));
});

$app->get('/logueado', function ($request) {
    $api_session = $request->getParam("api_session");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"])) {
        echo json_encode(logueado($_SESSION["usuario"], $_SESSION["clave"]));
    } else {
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio."));
    }
});

$app->post('/salir', function ($request) {
    $api_session = $request->getParam("api_session");
    session_id($api_session);
    session_start();
    session_destroy();
    echo json_encode(array("log_out" => "Cerrada sesión en la API"));
});

$app->get('/obtenerLibros', function ($request) {
    echo json_encode(obtener_libros());
});

$app->post('/crearLibro', function ($request) {
    $api_session = $request->getParam("api_session");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin") {
        $datos = array(
            "referencia" => $request->getParam("referencia"),
            "titulo" => $request->getParam("titulo"), "autor" => $request->getParam("autor"),
            "descripcion" => $request->getParam("descripcion"), "precio" => $request->getParam("precio")
        );
        echo json_encode(crear_libro($datos));
    } else {
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio."));
    }
});

$app->put('/actualizarPortada/{referencia}', function ($request) {
    $api_session = $request->getParam("api_session");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin") {
        $datos = array("portada" => $request->getParam("portada"), "referencia" => $request->getAttribute("referencia"));
        echo json_encode(actualizar_portada($datos));
    } else {
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio."));
    }
});

$app->get('/repetido/{tabla}/{columna}/{valor}', function ($request) {
    $api_session = $request->getParam("api_session");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin") {
        $tabla = $request->getAttribute("tabla");
        $columna = $request->getAttribute("columna");
        $valor = $request->getAttribute("valor");
        echo json_encode(repetido($tabla, $columna, $valor));
    } else {
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio."));
    }
});

// Una vez creado servicios los pongo a disposición
$app->run();
