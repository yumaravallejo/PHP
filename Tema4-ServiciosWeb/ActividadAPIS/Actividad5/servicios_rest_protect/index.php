<?php


require __DIR__ . '/Slim/autoload.php';
require "src/funciones_servicios.php";


$app = new \Slim\App;


$app->get('/logueado', function () {
    $test = validateToken(); //Devolverá o falso o array
    if (is_array($test))
        echo json_encode($test); //usuario, error o mensaje (mensaje -> baneo, error -> peticiones..., usuario -> tokken)
    else //Si es falso irá por aquí, sin autorización o expirado 
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio"));
});

$app->post('/login', function ($request) {

    $usuario = $request->getParam("usuario");
    $clave = $request->getParam("clave");
    echo json_encode(login($usuario, $clave));
});


$app->get('/productos', function () {
    $test = validateToken(); //Validamos tokken de nuevo
    if (is_array($test))
        if (isset($test["usuario"]) && $test["usuario"]["tipo"] == "admin") //Si es un admin le damos los productos, si no no tendrá ese permiso
            echo json_encode(obtener_productos());
        else
            echo json_encode($test);
    else //ValidateToken -> false
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio"));
});

$app->get('/producto/{codigo}', function () {
    $test = validateToken(); //Validamos tokken de nuevo
    if (is_array($test))
        if (isset($test["usuario"]) && $test["usuario"]["tipo"] == "admin") //Si es un admin le damos los productos, si no no tendrá ese permiso
            echo json_encode(obtener_productos());
        else
            echo json_encode($test);
    else //ValidateToken -> false
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio"));
});


$app->post('/producto/insertar', function ($request) {
    $test = validateToken(); //Validamos tokken de nuevo
    if (is_array($test))
        if (isset($test["usuario"]) && $test["usuario"]["tipo"] == "admin") { //Si es un admin le damos los productos, si no no tendrá ese permiso
            $datos[] = $request->getParam("cod");
            $datos[] = $request->getParam("nombre");
            $datos[] = $request->getParam("nombre_corto");
            $datos[] = $request->getParam("descripcion");
            $datos[] = $request->getParam("PVP");
            $datos[] = $request->getParam("familia");
            
            echo json_encode(insertar_producto($datos));
        } else
            echo json_encode($test);
    else //ValidateToken -> false
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio"));
});

$app->put('/producto/actualizar/{codigo}', function ($request) {
    $test = validateToken(); //Validamos tokken de nuevo
    if (is_array($test))
        if (isset($test["usuario"]) && $test["usuario"]["tipo"] == "admin") { //Si es un admin le damos los productos, si no no tendrá ese permiso
            $datos[] = $request->getParam("nombre");
            $datos[] = $request->getParam("nombre_corto");
            $datos[] = $request->getParam("descripcion");
            $datos[] = $request->getParam("PVP");
            $datos[] = $request->getParam("familia");
            $datos[] = $request->getAttribute("codigo");

            echo json_encode(actualizar_producto($datos));
        } else
            echo json_encode($test);
    else //ValidateToken -> false
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio"));
});


$app->delete('/producto/borrar/{codigo}', function ($request) {
    $test = validateToken(); //Validamos tokken de nuevo
    if (is_array($test))
        if (isset($test["usuario"]) && $test["usuario"]["tipo"] == "admin") { //Si es un admin le damos los productos, si no no tendrá ese permiso
            $cod = $request->getAttribute("codigo");

            echo json_encode(borrar_producto($cod));
        } else
            echo json_encode($test);
    else //ValidateToken -> false
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio"));
});


$app->get('/familias', function () {
    $test = validateToken(); //Validamos tokken de nuevo
    if (is_array($test))
        if (isset($test["usuario"]) && $test["usuario"]["tipo"] == "admin") { //Si es un admin le damos los productos, si no no tendrá ese permiso
            echo json_encode(obtener_familias());
        } else
            echo json_encode($test);
    else //ValidateToken -> false
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio"));
});

$app->get('/repetido/{tabla}/{columna}/{valor}', function ($request) {
    $test = validateToken(); //Validamos tokken de nuevo
    if (is_array($test))
        if (isset($test["usuario"]) && $test["usuario"]["tipo"] == "admin") { //Si es un admin le damos los productos, si no no tendrá ese permiso
            $tabla = $request->getAttribute("tabla");
            $columna = $request->getAttribute("columna");
            $valor = $request->getAttribute("valor");

            echo json_encode(repetido_insertando($tabla, $columna, $valor));
        } else
            echo json_encode($test);
    else //ValidateToken -> false
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio"));
});

$app->get('/repetido/{tabla}/{columna}/{valor}/{columna_id}/{valor_id}', function ($request) {
    $test = validateToken(); //Validamos tokken de nuevo
    if (is_array($test))
        if (isset($test["usuario"]) && $test["usuario"]["tipo"] == "admin") { //Si es un admin le damos los productos, si no no tendrá ese permiso
            $tabla = $request->getAttribute("tabla");
            $columna = $request->getAttribute("columna");
            $valor = $request->getAttribute("valor");
            $columna_id = $request->getAttribute("columna_id");
            $valor_id = $request->getAttribute("valor_id");

            echo json_encode(repetido_editando($tabla, $columna, $valor, $columna_id, $valor_id));
        } else
            echo json_encode($test);
    else //ValidateToken -> false
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio"));
});


$app->run();
