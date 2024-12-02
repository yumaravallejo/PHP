<?php
require "src/funciones_ctes.php";

require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;

$app->post('/logueado', function ($request) {
    $api_key = $request->getParam("api_key");
    session_id($api_key);
    session_start();
    session_destroy();
    echo json_encode(array("logout" => "Cerrar sesión."));
});

// Login
$app->post('/login', function ($request) {
    $usuario = $request->getParam("usuario");
    $clave = $request->getParam("clave");

    echo json_encode(login($usuario, $clave));
});

// Logueado
$app->post('/logueado', function ($request) {
    $api_key = $request->getParam("api_key");
    session_id($api_key);
    session_start();
    if (isset($_SESSION["usuario"])) {
        echo json_encode(logueado($_SESSION["usuario"], $_SESSION["clave"]));
    } else {
        session_destroy();
        echo json_encode(array("no_loguin" => "No logueado."));
    }
});

// Devuelve todos los usuarios
$app->get('/usuarios', function ($request) {
    $api_key = $request->getParam("api_key");
    session_id($api_key);
    session_start();
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "Admin") {
        echo json_encode(obtener_usuarios());
    } else {
        session_destroy();
        echo json_encode(array("no_loguin" => "No tienes permisos para usar este servicio."));
    }
});

// Devuelve el usuario con dicho id
$app->get('/usuario/{idUsuario}', function ($request) {
    $api_key = $request->getParam("api_key");
    session_id($api_key);
    session_start();
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "Admin") {
        echo json_encode(obtener_usuario($request->getAttribute("idUsuario")));
    } else {
        session_destroy();
        echo json_encode(array("no_loguin" => "No tienes permisos para usar este servicio."));
    }
});

// Inserta un usuario
$app->post('/crearUsuario', function ($request) {
    $api_key = $request->getParam("api_key");
    session_id($api_key);
    session_start();
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "Admin") {
        $datos = [
            $request->getParam("nombre"), $request->getParam("usuario"),
            $request->getParam("clave"), $request->getParam("email")
        ];
        echo json_encode(insertar_usuario($datos));
    } else {
        session_destroy();
        echo json_encode(array("no_loguin" => "No tienes permisos para usar este servicio."));
    }
});

// Edita un usuario
$app->put('/actualizarUsuario/{idUsuario}', function ($request) {
    $api_key = $request->getParam("api_key");
    session_id($api_key);
    session_start();
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "Admin") {
        $datos = [
            $request->getParam("nombre"), $request->getParam("usuario"), $request->getParam("clave"),
            $request->getParam("email"), $request->getAttribute("idUsuario")
        ];
        echo json_encode(actualizar_usuario($datos));
    } else {
        session_destroy();
        echo json_encode(array("no_loguin" => "No tienes permisos para usar este servicio."));
    }
});

// Elimina un usuario
$app->delete('/borrarUsuario/{idUsuario}', function ($request) {
    $api_key = $request->getParam("api_key");
    session_id($api_key);
    session_start();
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "Admin") {
        echo json_encode(borrar_usuario($request->getAttribute("idUsuario")));
    } else {
        session_destroy();
        echo json_encode(array("no_loguin" => "No tienes permisos para usar este servicio."));
    }
});

// Mira reptidos al insertar
$app->get('/repetido/{tabla}/{columna}/{valor}', function ($request) {
    $api_key = $request->getParam("api_key");
    session_id($api_key);
    session_start();
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "Admin") {
        echo json_encode(repetido($request->getAttribute('tabla'), $request->getAttribute('columna'), $request->getAttribute('valor')));
    } else {
        session_destroy();
        echo json_encode(array("no_loguin" => "No tienes permisos para usar este servicio."));
    }
});

// Mira repetidos al editar
$app->get('/repetido/{tabla}/{columna}/{valor}/{columna_id}/{valor_id}', function ($request) {
    $api_key = $request->getParam("api_key");
    session_id($api_key);
    session_start();
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "Admin") {
        echo json_encode(repetido($request->getAttribute('tabla'), $request->getAttribute('columna'), $request->getAttribute('valor'), $request->getAttribute('columna_id'), $request->getAttribute('valor_id')));
    } else {
        session_destroy();
        echo json_encode(array("no_loguin" => "No tienes permisos para usar este servicio."));
    }
});

$app->run();
