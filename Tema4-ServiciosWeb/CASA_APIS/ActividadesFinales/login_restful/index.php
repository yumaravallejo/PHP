<?php

require __DIR__ . '/Slim/autoload.php';

require "src/funciones_servicios.php";

$app = new \Slim\App;


$app->get('/logueado', function () {

    $test = validateToken();
    if (is_array($test)) {
        echo json_encode($test);
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

$app->get('/usuarios', function () {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test['usuario'])) {
            if ($test['usuario']['tipo'] == "admin")
                echo json_encode(obtener_usuarios());
            else
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
        } else {
            echo json_encode($test);
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

$app->get('/detallesUsuario/{idUsuario}', function ($request) {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test['usuario'])) {
            if ($test['usuario']['tipo'] == "admin") {
                $id = $request->getAttribute('idUsuario');
                echo json_encode(obtener_detalles($id));
            } else
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
        } else {
            echo json_encode($test);
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

$app->post('/crearUsuario', function ($request) {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test['usuario'])) {
            if ($test['usuario']['tipo'] == "admin") {
                $datos[] = $request->getParam('nombre');
                $datos[] = $request->getParam('usuario');
                $datos[] = $request->getParam('clave');
                $datos[] = $request->getParam('email');
                echo json_encode(insertar_usuario($datos));
            } else
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
        } else {
            echo json_encode($test);
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

$app->post('/login', function ($request) {
    $datos[] = $request->getParam('usuario');
    $datos[] = $request->getParam('clave');

    echo json_encode(comprobar_login($datos));
});

$app->put('/actualizarUsuario/{idUsuario}', function ($request) {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test['usuario'])) {
            if ($test['usuario']['tipo'] == "admin") {
                $datos[] = $request->getParam('nombre');
                $datos[] = $request->getParam('usuario');
                $datos[] = $request->getParam('clave');
                $datos[] = $request->getParam('email');
                $datos[] = $request->getAttribute('idUsuario');

                echo json_encode(actualizar_usuario($datos));
            } else
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
        } else {
            echo json_encode($test);
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

$app->put('/actualizarUsuarioSinClave/{idUsuario}', function ($request) {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test['usuario'])) {
            if ($test['usuario']['tipo'] == "admin") {
                $datos[] = $request->getParam('nombre');
                $datos[] = $request->getParam('usuario');
                $datos[] = $request->getParam('email');
                $datos[] = $request->getAttribute('idUsuario');

                echo json_encode(actualizar_usuario_sin($datos));
            } else
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
        } else {
            echo json_encode($test);
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

$app->delete('/borrarUsuario/{idUsuario}', function ($request) {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test['usuario'])) {
            if ($test['usuario']['tipo'] == "admin") {
                $codigo = $request->getAttribute('idUsuario');
                echo json_encode(borrar_usuario($codigo));
            } else
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
        } else {
            echo json_encode($test);
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

$app->get('/repetido/{tabla}/{columna}/{valor}', function ($request) {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test['usuario'])) {
            if ($test['usuario']['tipo'] == "admin") {
                $tabla = $request->getAttribute('tabla');
                $columna = $request->getAttribute('columna');
                $valor = $request->getAttribute('valor');
                echo json_encode(repetido_insertar($tabla, $columna, $valor));
            } else
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
        } else {
            echo json_encode($test);
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

$app->get('/repetido/{tabla}/{columna}/{valor}/{columna_id}/{valor_id}', function ($request) {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test['usuario'])) {
            if ($test['usuario']['tipo'] == "admin") {
                $tabla = $request->getAttribute('tabla');
                $columna = $request->getAttribute('columna');
                $valor = $request->getAttribute('valor');
                $columna_id = $request->getAttribute('columna_id');
                $valor_id = $request->getAttribute('valor_id');
                echo json_encode(repetido_editar($tabla, $columna, $valor, $columna_id, $valor_id));
            } else
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
        } else {
            echo json_encode($test);
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

$app->run();
