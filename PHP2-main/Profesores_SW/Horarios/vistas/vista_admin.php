<?php
var_dump($_SESSION)

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen SW 22_23</title>
    <style>
        .enlinea {
            display: inline
        }

        .enlace {
            border: none;
            background: none;
            text-decoration: underline;
            color: blue;
            cursor: pointer
        }

        table {
            width: 80%;
            margin: 0 auto;
            text-align: center;
            border-collapse: collapse
        }

        table,
        th,
        td {
            border: 1px solid black
        }

        th {
            background-color: #CCC
        }

        .mensaje {
            font-size: 1.25em;
            color: blue
        }

        label {
            width: 100px;
            float: left
        }

        .error {
            color: red
        }
    </style>
</head>

<body>
    <h1>Examen2 PHP</h1>
    <div>Bienvenido <strong><?php echo $datos_usuario_logueado->usuario; ?></strong> -
        <form class='enlinea' action="index.php" method="post">
            <button class='enlace' type="submit" name="btnSalir">Salir</button>
        </form>
    </div>
    <?php

    echo "<h2>Horario de los Profesores</h2>";

    $url = DIR_SERV . "/obtenerProfesores";
    $respuesta = consumir_servicios_REST($url, "GET", array("api_session" => $_SESSION["api_session"]));
    $obj = json_decode($respuesta);
    if (!$obj) {
        session_destroy();
        die("<p>Error consumiendo el servicio: " . $url . "</p></body></html>");
    }
    if (isset($obj->error)) {
        session_destroy();
        die("<p>" . $obj->error . "</p></body></html>");
    }

    echo "<form action='index.php' method='post'>";
    echo "<label for='profesores'>Horario del Profesor: </label>";
    echo "<select name='profesores' id='profesores'>";
    foreach ($obj->profesores as $tupla) {
        if ((isset($_POST["profesores"]) &&  $tupla->id_usuario == $_POST["profesores"]) || (isset($_SESSION["profesores"]) && $_SESSION["profesores"] == $tupla->id_usuario)) {
            echo "<option value='" . $tupla->id_usuario . "' selected>$tupla->nombre</option>";
            $nombre_seleccionado = $tupla->nombre;
        } else {
            echo "<option value='" . $tupla->id_usuario . "'>$tupla->nombre</option>";
        }
    }
    echo "</select> ";
    echo "<button type='submit' name='btnVerHorario'>Ver Horario</button>";
    echo "</form>";

    if (isset($_POST["profesores"]) || isset($_SESSION["profesores"])) {
        echo ' <h3>Horario del Profesor:' . $nombre_seleccionado . '</h3>';

        if (isset($_SESSION["profesores"])) {
            $profesores = $_SESSION["profesores"];
        } else
            $profesores = $_POST["profesores"];

        // Obtenemos el horario del profesor
        $url = DIR_SERV . "/obtenerHorario";
        $respuesta = consumir_servicios_REST($url, "POST", array("api_session" => $_SESSION["api_session"], "id_profesor" => $profesores));
        $obj = json_decode($respuesta);
        if (!$obj) {
            session_destroy();
            die("<p>Error consumiendo el servicio: " . $url . "</p></body></html>");
        }
        if (isset($obj->error)) {
            session_destroy();
            die("<p>" . $obj->error . "</p></body></html>");
        }

        // Guardamos los datos del horario en un array bidimensional
        foreach ($obj->horario as $tupla) {
            if (isset($horario[$tupla->hora][$tupla->dia])) { // Si hay más de un grupo
                $horario[$tupla->hora][$tupla->dia] .= " / " . $tupla->nombre;
            } else {
                $horario[$tupla->hora][$tupla->dia] = $tupla->nombre;
            }
        }

        // Tabla horarios
        echo "<table id='horarios'>";

        echo "<tr><th></th>";
        for ($i = 0; $i < count(DIAS); $i++) {
            echo "<th>" . DIAS[$i] . "</th>";
        }
        echo "</tr>";

        for ($i = 0; $i < count(HORAS); $i++) {
            echo "<tr><th>" . HORAS[$i] . "</th>";
            // Si no es el recreo
            if ($i != 3) {
                for ($j = 0; $j < count(DIAS); $j++) {
                    echo "<td>";
                    if (isset($horario[$i][$j])) {
                        echo "<p>" . $horario[$i][$j] . "</p>";
                    }
                    echo "<form action='index.php' method='post'>
            <input type='hidden' name='profesores' value='" . $profesores . "'>    
            <input type='hidden' name='hora' value='" . $i . "'>    
            <input type='hidden' name='dia' value='" . $j . "'>    
            <button type='submit' name='btnEditar' class='enlace'>Editar</button>    
            </form>";
                    echo "</td>";
                }
            } else {
                echo "<td colspan='5'>RECREO</td>";
            }
            echo "</tr>";
        }
        echo "</table>";

        if (isset($_POST["btnEditar"]) || isset($_SESSION["profesores"])) {
            require "vistas/vista_editar.php";
        }
    }

    ?>


</body>

</html>