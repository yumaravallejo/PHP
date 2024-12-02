<?php

// FILTRO
if (!isset($_SESSION["filtro_reg"])) {
    $_SESSION["busqueda"] = "";
    $_SESSION["filtro_reg"] = 3;
}

if (!isset($conexion)) {
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        session_destroy();
        die("<p>No ha podido conectarse a la base de batos: " . $e->getMessage() . "</p></body></html>");
    }
}


if (isset($_POST["filtro_reg"])) {
    $_SESSION["pagina"] = 1;
    $_SESSION["filtro_reg"] = $_POST["filtro_reg"];
}

// FIN FILTRO

// PAGINACIÓN

if (!isset($_SESSION["pagina"])) {
    $_SESSION["pagina"] = 1;
}

if (isset($_POST["btnPagina"])) {
    $_SESSION["pagina"] = $_POST["btnPagina"];
}

// FIN PAGINACIÓN

// BÚSQUEDA

if (isset($_POST["busqueda"])) {
    $_SESSION["pagina"] = 1;
    $_SESSION["busqueda"] = $_POST["busqueda"];
}

try {
    $inicio_limit = ($_SESSION["pagina"] - 1) * $_SESSION["filtro_reg"];
    if ($_SESSION["filtro_reg"] == "all")
        $consulta = "select * from usuarios where nombre like '%" . $_SESSION["busqueda"] . "%'";
    else
        $consulta = "select * from usuarios where nombre like '%" . $_SESSION["busqueda"] . "%' limit " . $inicio_limit . ", " . $_SESSION["filtro_reg"];
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute();
} catch (Exception $e) {
    $sentencia = null;
    $conexion = null;
    session_destroy();
    die("<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p></body></html>");
}

$resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
$sentencia = null;

?>
<form action='index.php' method='post' id="form_reg">
    <label>Número de registros por página: </label>
    <select name='filtro_reg' id='filtro_reg' onchange='document.getElementById("form_reg").submit()'>
        <option value='3' <?php if ($_SESSION["filtro_reg"] == 3) echo "selected" ?>>3</option>
        <option value='6' <?php if ($_SESSION["filtro_reg"] == 6) echo "selected" ?>>6</option>
        <option value='all' <?php if ($_SESSION["filtro_reg"] == "all") echo "selected" ?>>Todos</option>
    </select>
    <input type="text" name="busqueda" id="busqueda" placeholder="Búsqueda..." value="<?php echo $_SESSION["busqueda"] ?>">
    <button type='submit' name='btnBuscar'>Buscar</button>
    <!-- Si quisieramos que hiciese submit cada vez que cambie sin tener un botón de filtrar ponemos:
    <select name='filtro_reg' id='filtro_reg' onchange='document.getElementByID("form_reg").submit()'> -->
</form><br>
<?php

echo "<table>";
echo "<tr><th>Nombre de Usuario</th><th>Borrar</th><th>Editar</th></tr>";
foreach ($resultado as $tupla) {
    echo "<tr>";
    echo "<td><form action='index.php' method='post'><button class='enlace' type='submit' value='" . $tupla["id_usuario"] . "' name='btnDetalle' title='Detalles del Usuario'>" . $tupla["nombre"] . "</button></form></td>";
    echo "<td><form action='index.php' method='post'><input type='hidden' name='nombre_usuario' value='" . $tupla["nombre"] . "'><button class='enlace' type='submit' value='" . $tupla["id_usuario"] . "' name='btnBorrar'><img src='images/borrar.png' alt='Imagen de Borrar' title='Borrar Usuario'></button></form></td>";
    echo "<td><form action='index.php' method='post'><button class='enlace' type='submit' value='" . $tupla["id_usuario"] . "' name='btnEditar'><img src='images/editar.png' alt='Imagen de Editar' title='Editar Usuario'></button></form></td>";
    echo "</tr>";
}
echo "</table>";


try {
    $consulta = "select * from usuarios where nombre like '%" . $_SESSION["busqueda"] . "%'";
    $sentenciaUsers = $conexion->prepare($consulta);
    $sentenciaUsers->execute();
} catch (Exception $e) {
    $sentenciaUsers = null;
    $conexion = null;
    session_destroy();
    die("<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p></body></html>");
}

$num_pags = ceil($sentenciaUsers->rowCount() / $_SESSION["filtro_reg"]);
$sentenciaUsers = null;

if ($num_pags > 1) {
    echo "<br><form action='index.php' method='post' id='botones'>";
    if ($_SESSION["pagina"] != 1) {
        echo "<button type='submit' name='btnPagina' value='1'> << </button>";
        echo "<button type='submit' name='btnPagina' value='" . ($_SESSION["pagina"] - 1) . "'> < </button>";
    }

    for ($i = 1; $i <= $num_pags; $i++) {
        if ($i == $_SESSION["pagina"])
            echo "<button type='submit' name='btnPagina' value='" . $i . "' class='disabled' disabled>" . $i . "</button>";
        else
            echo "<button type='submit' name='btnPagina' value='" . $i . "'>" . $i . "</button>";
    }

    if ($_SESSION["pagina"] != $num_pags) {
        echo "<button type='submit' name='btnPagina' value='" . ($_SESSION["pagina"] + 1) . "'> > </button>";
        echo "<button type='submit' name='btnPagina' value='" . $num_pags . "'> >> </button>";
    }
    echo "</form>";
}

if (isset($_SESSION["mensaje"])) {
    echo "<p>" . $_SESSION["mensaje"] . "</p>";
    // unset($_SESSION["mensaje"])
    session_destroy();
}

?>