<?php

require __DIR__ . '/Slim/autoload.php';

require "src/funciones_ctes.php";

$app = new \Slim\App;

$app->get('/logueado', function () {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test['usuario'])) {
            if ($test['usuario']['tipo'] == 'admin') {
                json_encode(obtener_usuarios());
            } else {
                echo json_encode(array('no_auth' => "No tienes permisos para usar este servicio"));
            }
        } else {
            json_encode($test);
        }
    } else
        echo json_encode(array('no_auth' => "No tienes permisos para usar este servicio"));
});

//Obtener todos los datos de todos los usuarios
$app->get('/usuarios', function () {
    //Para proteger los demaás métodos
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test['usuario'])) {
            if ($test['usuario']['tipo'] == 'admin') {
                json_encode(obtener_usuarios());
            } else {
                echo json_encode(array('no_auth' => "No tienes permisos para usar este servicio"));
            }
        } else {
            json_encode($test);
        }
    } else
        echo json_encode(array('no_auth' => "No tienes permisos para usar este servicio"));

    //Sin proteger
    // echo json_encode(obtener_usuarios());
});

//Si espera parámetros por abajo o arriba hay que pasarle $request al function
$app->post('/crearUsuario', function ($request) {
    //Para proteger los demaás métodos
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test['usuario'])) {
            if ($test['usuario']['tipo'] == 'admin') {
                $datos_insert[] = $request->getParam('nombre');
                $datos_insert[] = $request->getParam('usuario');
                $datos_insert[] = $request->getParam('clave');
                $datos_insert[] = $request->getParam('email');

                echo json_encode(insertar_usuario($datos_insert));
            } else {
                echo json_encode(array('no_auth' => "No tienes permisos para usar este servicio"));
            }
        } else {
            json_encode($test);
        }
    } else
        echo json_encode(array('no_auth' => "No tienes permisos para usar este servicio"));
});

//OJO el login es POST porque enviamos una clave
$app->post('/login', function ($request) {
    $datos_login[] = $request->getParam('usuario');
    $datos_login[] = $request->getParam('clave');

    //Para probar su funcionamiento
    // $datos_login[] = "javito";
    // $datos_login[] = md5("123456");

    echo json_encode(login($datos_login));
});

//EL nombre de la id en el parámetro puedo seleccionarlo yo y no me afectaría
$app->put('/actualizarUsuario/{idUsuario}', function ($request) {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test['usuario'])) {
            if ($test['usuario']['tipo'] == 'admin') {
                $datos_update[] = $request->getParam('nombre');
                $datos_update[] = $request->getParam('usuario');
                $datos_update[] = $request->getParam('clave');
                $datos_update[] = $request->getParam('email');
                //Cuando la id o lo que quieras esté dentro de la url usaremos getAttribute
                //Ojo con poner el mismo nombre de arriba
                $datos_update[] = $request->getAttribute('idUsuario');
                echo json_encode(actualizar_usuario($datos_update));
            } else {
                echo json_encode(array('no_auth' => "No tienes permisos para usar este servicio"));
            }
        } else {
            json_encode($test);
        }
    } else
        echo json_encode(array('no_auth' => "No tienes permisos para usar este servicio"));
});

$app->delete('/borrarUsuario/{idUsuario}', function ($request) {
    //Para proteger los demaás métodos
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test['usuario'])) {
            if ($test['usuario']['tipo'] == 'admin') {
                //Cuando la id o lo que quieras esté dentro de la url usaremos getAttribute
                //Ojo con poner el mismo nombre de arriba
                $id = $request->getAttribute('idUsuario');
                echo json_encode(borrar_usuario($id));
            } else {
                echo json_encode(array('no_auth' => "No tienes permisos para usar este servicio"));
            }
        } else {
            json_encode($test);
        }
    } else
        echo json_encode(array('no_auth' => "No tienes permisos para usar este servicio"));
});


$app->get('/repetido/{tabla}/{columna}/{valor}', function ($request) {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test['usuario'])) {
            if ($test['usuario']['tipo'] == 'admin') {
                //Cuando la id o lo que quieras esté dentro de la url usaremos getAttribute
                //Ojo con poner el mismo nombre de arriba
                $tabla = $request->getAttribute('tabla');
                $columna = $request->getAttribute('columna');
                $valor = $request->getAttribute('valor');
                echo json_encode(repetido_insert($tabla, $columna, $valor));
            } else {
                echo json_encode(array('no_auth' => "No tienes permisos para usar este servicio"));
            }
        } else {
            json_encode($test);
        }
    } else
        echo json_encode(array('no_auth' => "No tienes permisos para usar este servicio"));
});

$app->get('/repetido/{tabla}/{columna}/{valor}/{columna_id}/{valor_id}', function ($request) {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test['usuario'])) {
            if ($test['usuario']['tipo'] == 'admin') {
                //Cuando la id o lo que quieras esté dentro de la url usaremos getAttribute
                //Ojo con poner el mismo nombre de arriba
                $tabla = $request->getAttribute('tabla');
                $columna = $request->getAttribute('columna');
                $valor = $request->getAttribute('valor');
                $columna_id = $request->getAttribute('columna_id');
                $valor_id = $request->getAttribute('valor_id');
                echo json_encode(repetido_insert($tabla, $columna, $valor, $columna_id, $valor_id));
            } else {
                echo json_encode(array('no_auth' => "No tienes permisos para usar este servicio"));
            }
        } else {
            json_encode($test);
        }
    } else
        echo json_encode(array('no_auth' => "No tienes permisos para usar este servicio"));
});

$app->run();
