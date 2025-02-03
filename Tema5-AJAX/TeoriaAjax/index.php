<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría AJAX</title>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/index.js"></script>
    <style>
        table {
            border: 1px solid black;
            border-collapse: collapse;
        }

        td, th {
            border: 1px solid black; 
            padding: .5rem;
        }

        .enlace {
            color: blue;
            text-decoration: underline;
            border: none;
            background: none;
            cursor: pointer;
        }

    </style>
</head>

<body>
    <h1>Teoría JavaScript</h1>
    <p>
        <button onclick="llamada_get1()">GET1</button>
        <button onclick="llamada_get2()">GET2</button>
        <button onclick="llamada_post()">POST</button>
        <button onclick="llamada_delete()">DELETE</button>
        <button onclick="llamada_put()">PUT</button>

    </p>
    <div id="respuesta"></div>
    <div id="tabla"></div>
</body>

</html>