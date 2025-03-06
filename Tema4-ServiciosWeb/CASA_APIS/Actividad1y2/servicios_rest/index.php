<?php

require __DIR__ . "/Slim/autoload.php";
require "src/funciones_servicios.php";

$app = new \Slim\App;

$app -> get('/productos', function(){
    json_encode(obtener_productos());
});

$app -> get('/producto/{codigo}', function($request){
    $id = $request->getAttribute('codigo');
    json_encode(obtener_producto($id));
});

$app -> post('/producto/insertar', function($request){
    $datos['cod'] = $request->getParam('cod');
    $datos['nombre'] = $request->getParam('nombre');
    $datos['nombre_corto'] = $request->getParam('nombre_corto');
    $datos['descripcion'] = $request->getParam('descripcion');
    $datos['pvp'] = $request->getParam('pvp');
    $datos['familia'] = $request->getParam('familia');
    json_encode(insertar_producto($datos));
});

$app -> put('/producto/actualizar/{codigo}', function($request){
    $datos['nombre'] = $request->getParam('nombre');
    $datos['nombre_corto'] = $request->getParam('nombre_corto');
    $datos['descripcion'] = $request->getParam('descripcion');
    $datos['pvp'] = $request->getParam('pvp');
    $datos['familia'] = $request->getParam('familia');
    $datos['cod'] = $request->getAttribute('codigo');
    json_encode(actualizar_producto($datos));
});

$app -> delete('/producto/borrar/{codigo}', function($request){
    $codigo = $request->getAttribute('codigo');
    json_encode(borrar_producto($codigo));
});

$app -> get('/familias', function(){
    json_encode(obtener_familias());
});

$app -> get('/repetido/{tabla}/{columna}/{valor}', function($request){
    $tabla = $request->getAttribute('tabla');
    $columna = $request->getAttribute('columna');
    $valor = $request->getAttribute('valor');
    json_encode(repetido_insertar($tabla, $columna, $valor));
});

$app -> get('/repetido/{tabla}/{columna}/{valor}/{columna_id}/{valor_id}', function($request){
    $tabla = $request->getAttribute('tabla');
    $columna = $request->getAttribute('columna');
    $valor = $request->getAttribute('valor');
    $columna_id = $request->getAttribute('columna_id');
    $valor_id = $request->getAttribute('valor_id');
    json_encode(repetido_editar($tabla, $columna, $valor, $columna_id, $valor_id));
});

$app->run();

?>