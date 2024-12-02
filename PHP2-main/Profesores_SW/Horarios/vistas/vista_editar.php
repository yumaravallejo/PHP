<?php

if (isset($_SESSION["profesores"])) {
    $profesores = $_SESSION["profesores"];
    $hora = $_SESSION["hora"];
    $dia = $_SESSION["dia"];
} else { // Botón editar
    $profesores = $_POST["profesores"];
    $hora = $_POST["hora"];
    $dia = $_POST["dia"];
}

// El recreo no cuenta
$numero_hora = $hora;
if ($numero_hora < 3) {
    $numero_hora++;
}

echo "<h2>Editando la " . $numero_hora . "º hora (" . HORAS[$hora] . ") del " . DIAS[$dia] . "</h2>";

if (isset($_SESSION["mensaje"])) {
    echo "<p>" . $_SESSION["mensaje"] . "</p>";
    unset($_SESSION["mensaje"]);
    unset($_SESSION["hora"]);
    unset($_SESSION["dia"]);
    unset($_SESSION["profesores"]);
}

// Grupos que tiene el profesor a esa hora en ese dia
$url = DIR_SERV . "/obtenerGrupos";
$datos = array("api_session" => $_SESSION["api_session"], "profesores" => $profesores, "dia" => $dia, "hora" => $hora);
$respuesta = consumir_servicios_REST($url, "POST", $datos);
$obj = json_decode($respuesta);
if (!$obj) {
    session_destroy();
    die("<p>Error consumiendo el servicio: " . $url . "</p></body></html>");
}
if (isset($obj->error)) {
    session_destroy();
    die("<p>" . $obj->error . "</p></body></html>");
}

// Tabla grupos
echo "<table>";
echo "<tr><th>Grupo</th><th>Acción</th></tr>";
foreach ($obj->grupos as $tupla) {
    echo "
    <tr>
        <td>" . $tupla->nombre . "</td>
        <td>
            <form action='index.php' method='post'>
                <input type='hidden' name='profesores' value='" . $profesores . "'>    
                <input type='hidden' name='hora' value='" . $hora . "'>    
                <input type='hidden' name='dia' value='" . $dia . "'>    
                <button type='submit' name='btnQuitar' class='enlace' value='" . $tupla->id_grupo . "'>Quitar</button>  
            </form>  
        </td>
    </tr>";
}
echo "</table>";

// Grupos que no tiene el profesor a esa hora en ese dia
$url = DIR_SERV . "/obtenerNoGrupos";
$datos = array("api_session" => $_SESSION["api_session"], "profesores" => $profesores, "dia" => $dia, "hora" => $hora);
$respuesta = consumir_servicios_REST($url, "POST", $datos);
$obj = json_decode($respuesta);
if (!$obj) {
    session_destroy();
    die("<p>Error consumiendo el servicio: " . $url . "</p></body></html>");
}

if (isset($obj->error)) {
    session_destroy();
    die("<p>" . $obj->error . "</p></body></html>");
}

// Select con los grupos
if (count($obj->grupos) > 0) {
    echo "<form action='index.php' method='post'>";
    echo '<select name="grupos" >';
    foreach ($obj->grupos as $tupla) {
        echo "<option value='" . $tupla->id_grupo . "'>" . $tupla->nombre . "</option>";
    }
    echo "</select>";
    echo "<input type='hidden' name='profesores' value='" . $profesores . "'>    
    <input type='hidden' name='hora' value='" . $hora . "'>    
    <input type='hidden' name='dia' value='" . $dia . "'>    
    <button type='submit' name='btnAñadir'>Añadir</button>    ";
    echo "</form>";
} else {
    echo "<p>No hay clases disponibles a esa hora.</p>";
}
