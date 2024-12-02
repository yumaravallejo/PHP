<?php

require "src/funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;



$app->get('/conexion_PDO', function ($request) {

    echo json_encode(conexion_pdo());
});

// Login
$app->post('/login', function ($request) {
    $usuario = $request->getParam("usuario");
    $clave = $request->getParam("clave");
    echo json_encode(login($usuario, $clave));
});

// Logueado
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


// Salir
$app->post('/salir', function ($request) {
    $api_session = $request->getParam("api_session");
    session_id($api_session);
    session_start();
    session_destroy();
    echo json_encode(array("log_out" => "Cerrada sesión en la API"));
});

// Obtener todos los profesores (usuarios no admin)
$app->get('/obtenerProfesores', function ($request) {
    $api_session = $request->getParam("api_session");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin") {
        echo json_encode(obtener_profesores());
    } else {
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio."));
    }
});

// Obtener el horario de un profesor
$app->post('/obtenerHorario', function ($request) {
    $api_session = $request->getParam("api_session");
    $id_profesor = $request->getParam("id_profesor");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin") {
        echo json_encode(obtener_horario($id_profesor));
    } else {
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio."));
    }
});

// Obtener los grupos que tiene el profesor a esa hora en ese dia
$app->post('/obtenerGrupos', function ($request) {
    $api_session = $request->getParam("api_session");
    $profesores = $request->getParam("profesores");
    $dia = $request->getParam("dia");
    $hora = $request->getParam("hora");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin") {
        echo json_encode(obtener_grupos($profesores, $dia, $hora));
    } else {
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio."));
    }
});

// Obtener los grupos que NO tiene el profesor a esa hora en ese dia
$app->post('/obtenerNoGrupos', function ($request) {
    $api_session = $request->getParam("api_session");
    $profesores = $request->getParam("profesores");
    $dia = $request->getParam("dia");
    $hora = $request->getParam("hora");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin") {
        echo json_encode(obtener_no_grupos($profesores, $dia, $hora));
    } else {
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio."));
    }
});

// Eliminar grupo de un profesor en una hora y un dia concreto
$app->delete('/borrarGrupo', function ($request) {
    $api_session = $request->getParam("api_session");
    $profesores = $request->getParam("profesores");
    $dia = $request->getParam("dia");
    $hora = $request->getParam("hora");
    $grupo = $request->getParam("grupo");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin") {
        echo json_encode(borrar_grupo($profesores, $dia, $hora, $grupo));
    } else {
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio."));
    }
});

// Insertar grupo a un profesor en una hora y un dia concreto
$app->post('/insertarGrupo', function ($request) {
    $api_session = $request->getParam("api_session");
    $profesores = $request->getParam("profesores");
    $dia = $request->getParam("dia");
    $hora = $request->getParam("hora");
    $grupo = $request->getParam("grupo");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin") {
        echo json_encode(insertar_grupo($profesores, $dia, $hora, $grupo));
    } else {
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio."));
    }
});


// Una vez creado servicios los pongo a disposición
$app->run();
