<?php
require "src/funciones_ctes.php";

require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;

// Devuelve todos los usuarios
$app->get('/usuarios', function () {
    echo json_encode(obtener_usuarios());
});

// Devuelve el usuario con dicho id
$app->get('/usuario/{idUsuario}', function ($request) {
    echo json_encode(obtener_usuario($request->getAttribute("idUsuario")));
});

// Inserta un usuario
$app->post('/crearUsuario', function ($request) {
    $datos = [
        $request->getParam("nombre"), $request->getParam("usuario"),
        $request->getParam("clave"), $request->getParam("email")
    ];
    echo json_encode(insertar_usuario($datos));
});

// Login
$app->post('/login', function ($request) {
    $usuario = $request->getParam("usuario");
    $clave = $request->getParam("clave");

    echo json_encode(login($usuario, $clave));
});

// Edita un usuario
$app->put('/actualizarUsuario/{idUsuario}', function ($request) {
    $datos = [
        $request->getParam("nombre"), $request->getParam("usuario"), $request->getParam("clave"),
        $request->getParam("email"), $request->getAttribute("idUsuario")
    ];
    echo json_encode(actualizar_usuario($datos));
});

// Elimina un usuario
$app->delete('/borrarUsuario/{idUsuario}', function ($request) {
    echo json_encode(borrar_usuario($request->getAttribute("idUsuario")));
});

// Mira reptidos al insertar
$app->get('/repetido/{tabla}/{columna}/{valor}', function ($request) {
    echo json_encode(repetido($request->getAttribute('tabla'), $request->getAttribute('columna'), $request->getAttribute('valor')));
});

// Mira repetidos al editar
$app->get('/repetido/{tabla}/{columna}/{valor}/{columna_id}/{valor_id}', function ($request) {
    echo json_encode(repetido($request->getAttribute('tabla'), $request->getAttribute('columna'), $request->getAttribute('valor'), $request->getAttribute('columna_id'), $request->getAttribute('valor_id')));
});

$app->run();
