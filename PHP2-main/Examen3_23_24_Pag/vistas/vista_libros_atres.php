<?php
echo "<h3>Listado de los libros</h3>";
// FILTRO
if (isset($_POST["filtro_reg"])) {
    $_SESSION["pagina"] = 1;
    $_SESSION["filtro_reg"] = $_POST["filtro_reg"];
}

if (!isset($_SESSION["filtro_reg"])) {
    $_SESSION["filtro_reg"] = 3;
}

// PAGINACIÓN

if (!isset($_SESSION["pagina"])) {
    $_SESSION["pagina"] = 1;
}

if (isset($_POST["btnPagina"])) {
    $_SESSION["pagina"] = $_POST["btnPagina"];
}

try {
    if ($_SESSION["filtro_reg"] == "all")
        $consulta = "select * from libros";
    else {
        $inicio_limit = ($_SESSION["pagina"] - 1) * $_SESSION["filtro_reg"];
        $consulta = "select * from libros limit " . $inicio_limit . ", " . $_SESSION["filtro_reg"];
    }
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute();
} catch (Exception $e) {
    session_destroy();
    $sentencia = null;
    $conexion = null;
    die("<p>No he podido realizar la consulta: " . $e->getMessage() . "</p></body></html>");
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
</form>
<?php

foreach ($resultado as $tupla) {
    echo "<p class='libros'>";
    echo "<img src='img/" . $tupla["portada"] . "' alt='imagen libro' title='imagen libro'><br>";
    echo $tupla["titulo"] . " - " . $tupla["precio"] . "€";
    echo "</p>";
}


try {
    $consulta = "select * from libros";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute();
} catch (Exception $e) {
    session_destroy();
    $sentencia = null;
    $conexion = null;
    die("<p>No he podido realizar la consulta: " . $e->getMessage() . "</p></body></html>");
}

if ($_SESSION["filtro_reg"] == "all")
    $num_pags = 1;
else
    $num_pags = ceil($sentencia->rowCount() / $_SESSION["filtro_reg"]);
$sentencia = null;

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
