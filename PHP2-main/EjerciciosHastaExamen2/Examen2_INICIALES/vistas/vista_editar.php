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
if ($numero_hora > 3) {
    $numero_hora--;
}

echo "<h2>Editando la " . $numero_hora . "º hora (" . HORAS[$hora] . ") del " . DIAS[$dia] . "</h2>";

if (isset($_SESSION["mensaje"])) {
    echo "<p>".$_SESSION["mensaje"]."</p>";
    session_destroy();
}

// Grupos que tiene el profesor a esa hora en ese dia
try {
    $consulta = "select id_grupo, nombre from grupos, horario_lectivo where id_grupo=grupo and usuario='" . $profesores . "' and dia='" . $dia . "' and hora='" . $hora . "'";
    $resultado = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
session_destroy();
    mysqli_close($conexion);
    die("<p>Ha habido un error: " . $e->getMessage() . "</p></body></html>");
}

// Tabla grupos
echo "<table>";
echo "<tr><th>Grupo</th><th>Acción</th></tr>";
while ($tupla = mysqli_fetch_assoc($resultado)) {
    echo "
    <tr>
        <td>" . $tupla["nombre"] . "</td>
        <td>
            <form action='index.php' method='post'>
                <input type='hidden' name='profesores' value='" . $profesores . "'>    
                <input type='hidden' name='hora' value='" . $hora . "'>    
                <input type='hidden' name='dia' value='" . $dia . "'>    
                <button type='submit' name='btnQuitar' class='enlace' value='".$tupla["id_grupo"]."'>Quitar</button>  
            </form>  
        </td>
    </tr>";
}
echo "</table>";

// Grupos que no tiene el profesor a esa hora en ese dia
try {
    $consulta = "select id_grupo, nombre from grupos where id_grupo not in (select id_grupo from grupos, horario_lectivo where id_grupo=grupo and usuario='" . $profesores . "' and dia='" . $dia . "' and hora='" . $hora . "')";
    $resultado = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
session_destroy();
    mysqli_close($conexion);
    die("<p>Ha habido un error: " . $e->getMessage() . "</p></body></html>");
}

// Select con los grupos
if (mysqli_num_rows($resultado) > 0) {
    echo "<form action='index.php' method='post'>";
    echo '<select name="grupos" >';
    while ($tupla = mysqli_fetch_assoc($resultado)) {
        echo "<option value='" . $tupla["id_grupo"] . "'>" . $tupla["nombre"] . "</option>";
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
?>