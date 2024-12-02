<?php

if (isset($_SESSION["profesores"])) {
    $profesores = $_SESSION["profesores"];
} else { // Botón ver horario
    $profesores = $_POST["profesores"];
}

// Los grupos con las horas, dias y nombre del profesor seleccionado
try {
    $consulta = "select usuario, dia, hora, grupo, nombre from grupos, horario_lectivo where id_grupo=grupo and usuario='" . $profesores . "'";
    $resultado = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    session_destroy();
    mysqli_close($conexion);
    die("<p>Ha habido un error: " . $e->getMessage() . "</p></body></html>");
}

// Guardamos los grupos en un array bidimensional
while ($tupla = mysqli_fetch_assoc($resultado)) {
    if (isset($horario[$tupla["hora"]][$tupla["dia"]])) { // Si hay más de un grupo
        $horario[$tupla["hora"]][$tupla["dia"]] .= " / " . $tupla["nombre"];
    } else {
        $horario[$tupla["hora"]][$tupla["dia"]] = $tupla["nombre"];
    }
}

// Tabla horarios
echo "<table id='horarios'>";

echo "<tr><th></th>";
for ($i = 1; $i <= count(DIAS); $i++) {
    echo "<th>" . DIAS[$i] . "</th>";
}
echo "</tr>";

for ($i = 1; $i <= count(HORAS); $i++) {
    echo "<tr><th>" . HORAS[$i] . "</th>";
    // Si no es el recreo
    if ($i != 4) {
        for ($j = 1; $j <= count(DIAS); $j++) {
            echo "<td>";
            if (isset($horario[$i][$j])) {
                echo "<p>" . $horario[$i][$j] . "</p>";
            }
            echo "<form action='index.php' method='post'>
            <input type='hidden' name='profesores' value='" . $cod_prof . "'>    
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
