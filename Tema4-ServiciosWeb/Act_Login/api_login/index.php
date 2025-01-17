<?php
//usuario y clave
//clave recibida en md5
//índice usuario para los datos de los usuarios
require __DIR__ . '/Slim/autoload.php';

require "src/funciones_ctes.php";

$app = new \Slim\App;
//Utilizamos post porque luego tendremos que poner esto con un form de method post
$app->post('/login',function($request){
    $usuario=$request->getParam("usuario");
    $clave=$request->getParam("clave");

    // Para comprobar
    // $usuario="jsm_117";
    // $clave=md5("123456");

    echo json_encode(login($usuario, $clave));
});

$app->run();
