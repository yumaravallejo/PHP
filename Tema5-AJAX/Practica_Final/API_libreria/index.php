<?php
require __DIR__ . '/Slim/autoload.php';
require "src/funciones_CTES_servicios.php";

$app = new \Slim\App();

$app->get('/logueado', function () {

    $test = validateToken();
    if (is_array($test)) {
        echo json_encode($test);
    } else {
        echo json_encode(array("no_auth" => "No tienes permisos para usar este servicio"));
    }
});

$app->post('/login', function ($request) {

    $datos_login[] = $request->getParam("lector");
    $datos_login[] = $request->getParam("clave");

    echo json_encode(login($datos_login));
});

$app->get('/obtenerLibros', function () {
    echo json_encode(obtener_libros());
});

$app->get('/obtenerLibro/{referencia}', function ($request) {

    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["tipo"] == "admin") {
                $respuesta = obtener_libro($request->getAttribute("referencia"));
                $respuesta["token"] = $test["token"];

                echo json_encode($respuesta);
            } else
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
        } else
            echo json_encode($test);
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

$app->post('/crearLibro', function ($request) {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            if ($test["usuario"]["tipo"] == "admin") {
                $referencia = $request->getParam("referencia");
                $titulo = $request->getParam("titulo");
                $autor = $request->getParam("autor");
                $descripcion = $request->getParam("descripcion");
                $precio = $request->getParam("precio");
                $resultado = crear_libro($referencia, $titulo, $autor, $descripcion, $precio);
                $resultado["token"] = $test["token"];
                echo json_encode($resultado);
            } else
                echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
        } else
            echo json_encode($test);
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

$app->post('/cargarPortada', function ($request) {
    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"]) && $test["usuario"]["tipo"] == "admin") {
            $params = $request->getParsedBody();
            $referencia = isset($params['referencia']) ? $params['referencia'] : null;

            if (!$referencia) {
                echo json_encode(array("error" => "No se especificó la referencia del libro."));
                return;
            }

            $resultadoRepetido = repetido_insertando("libros", "referencia", $referencia);
            if (isset($resultadoRepetido["repetido"]) && $resultadoRepetido["repetido"]) {
                echo json_encode(array("error" => "La referencia ya existe, no se sube la imagen."));
                return;
            }

            $uploadedFiles = $request->getUploadedFiles();
            if (!isset($uploadedFiles['portada'])) {
                echo json_encode(array("error" => "No se envió archivo de portada."));
                return;
            }
            $portada = $uploadedFiles['portada'];
            if ($portada->getError() !== UPLOAD_ERR_OK) {
                echo json_encode(array("error" => "Error en la subida del archivo."));
                return;
            }

            $extension = pathinfo($portada->getClientFilename(), PATHINFO_EXTENSION);
            $nuevo_nombre = "img_" . $referencia . "." . $extension;
            $ruta_destino = __DIR__ . "/../images/" . $nuevo_nombre;

            try {
                $portada->moveTo($ruta_destino);
            } catch (Exception $e) {
                echo json_encode(array("error" => "No se pudo mover el archivo: " . $e->getMessage()));
                return;
            }

            echo json_encode(array(
                "imagen" => $nuevo_nombre,
                "mensaje" => "Imagen subida correctamente.",
                "token"   => $test["token"]
            ));
        } else {
            echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
        }
    } else {
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
    }
});


$app->put('/actualizarLibro/{referencia}', function ($request, $response, $args) {
    $test = validateToken();
    if (is_array($test) && isset($test["usuario"]) && $test["usuario"]["tipo"] === "admin") {
        $referencia  = $args['referencia'];
        $titulo      = $request->getParam("titulo");
        $autor       = $request->getParam("autor");
        $descripcion = $request->getParam("descripcion");
        $precio      = $request->getParam("precio");

        $resultado = actualizar_libro($referencia, $titulo, $autor, $descripcion, $precio);
        $resultado["token"] = $test["token"];
        echo json_encode($resultado);
    } else {
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
    }
});

$app->delete('/borrarLibro/{referencia}', function ($request, $response, $args) {
    $test = validateToken();
    if (is_array($test) && isset($test["usuario"]) && $test["usuario"]["tipo"] === "admin") {
        $referencia = $args['referencia'];
        $resultado = borrar_libro($referencia);
        $resultado["token"] = $test["token"];
        echo json_encode($resultado);
    } else {
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
    }
});

$app->put('/actualizarPortada/{referencia}', function ($request, $response, $args) {
    $test = validateToken();
    if (is_array($test) && isset($test["usuario"]) && $test["usuario"]["tipo"] === "admin") {
        $referencia = $args['referencia'];
        $portada    = $request->getParam("portada");
        $resultado  = actualizar_portada($referencia, $portada);
        $resultado["token"] = $test["token"];
        echo json_encode($resultado);
    } else {
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
    }
});

$app->get('/repetido/{tabla}/{columna}/{valor}', function ($request, $response, $args) {
    $test = validateToken();
    if (is_array($test) && isset($test["usuario"]) && $test["usuario"]["tipo"] === "admin") {
        $tabla    = $args['tabla'];
        $columna  = $args['columna'];
        $valor    = $args['valor'];
        $resultado = repetido_insertando($tabla, $columna, $valor);
        $resultado["token"] = $test["token"];
        echo json_encode($resultado);
    } else {
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
    }
});

$app->get('/repetido/{tabla}/{columna}/{valor}/{columna_key}/{valor_key}', function ($request, $response, $args) {
    $test = validateToken();
    if (is_array($test) && isset($test["usuario"]) && $test["usuario"]["tipo"] === "admin") {
        $tabla       = $args['tabla'];
        $columna     = $args['columna'];
        $valor       = $args['valor'];
        $columna_key = $args['columna_key'];
        $valor_key   = $args['valor_key'];
        $resultado   = repetido_editando($tabla, $columna, $valor, $columna_key, $valor_key);
        $resultado["token"] = $test["token"];
        echo json_encode($resultado);
    } else {
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
    }
});

$app->run();
