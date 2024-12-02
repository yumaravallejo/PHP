<?php
// Control de errores
if (isset($_POST["btnCodificar"])) {
    $error_texto = $_POST["texto"] == "";
    $error_des = $_POST["des"] == "" || !is_numeric($_POST["des"]) || $_POST["des"] < 1 || $_POST["des"] > 26;
    $error_archivo = $_FILES["archivo"]["name"] == "" || $_FILES["archivo"]["type"] != "text/plain" || $_FILES["archivo"]["size"] >= 125000000;
    $error_form = $error_texto || $error_des || $error_archivo;
}
// Funciones
function mi_explode($separador, $texto)
{
    $array = [];
    $palabra = "";
    for ($i = 0; $i < strlen($texto); $i++) {
        if ($texto[$i] != $separador) {
            $palabra .= $texto[$i];
        } else {
            $array[] = $palabra;
            $palabra = "";
            $i + 2;
        }
    }
    return $array;
}
function codifica($texto, $des)
{
    $resultado = "";
    for ($i = 0; $i < strlen($texto); $i++) {
        if (ord($texto[$i]) >= ord("A") && ord($texto[$i]) <= ord("Z")) {
            @$fd = fopen($_FILES["archivo"]["tmp_name"], "r");
            if (!$fd) {
                echo "<p>No se ha podido abrir el fichero.</p>";
            }
            while ($linea = fgets($fd)) {
                $aux = explode(";", $linea);
                if ($texto[$i]==$aux[0]) {
                    $resultado.=$aux[$des];
                    break;
                }
            }
            fclose($fd);
        } else {
            $resultado.=$texto[$i];
        }
    }
    return $resultado;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Ejercicio 3. Codifica una frase</h1>
    <form action="ejercicio3.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="texto">Introduzca un Texto: </label>
            <input type="text" name="texto" id="texto" value="<?php if (isset($_POST["texto"])) echo $_POST["texto"] ?>">
            <?php
            if (isset($_POST["btnCodificar"]) && $error_texto) {
                echo "<span class = 'error'> Campo vacío</span>";
            }
            ?>
        </p>
        <p>
            <label for="des">Desplazamiento: </label>
            <input type="text" name="des" id="des" value="<?php if (isset($_POST["des"])) echo $_POST["des"] ?>">
            <?php
            if (isset($_POST["btnCodificar"]) && $error_des) {
                if ($_POST["des"] == "") {
                    echo "<span class = 'error'> Campo vacío</span>";
                } else {
                    echo "<span class = 'error'> No es un número entre 1 y 26</span>";
                }
            }
            ?>
        </p>
        <p>
            <label for="archivo">Selecciones el archivo de claves (.txt y menos de 1'25MB): </label>
            <input type="file" name="archivo" id="archivo" accept=".txt">
            <?php
            if (isset($_POST["btnCodificar"]) && $error_archivo) {
                if ($_FILES["archivo"]["name"] == "") {
                    echo "<span class = 'error'> *</span>";
                } else if ($_FILES["archivo"]["type"] != "text/plain") {
                    echo "<span class = 'error'> El archivo seleccionado no es un texto plano</span>";
                } else {
                    echo "<span class = 'error'> El archivo seleccionado es mayor o igual que 1'25MB</span>";
                }
            }
            ?>
        </p>
        <p>
            <button type="submit" name="btnCodificar">Codificar</button>
        </p>
    </form>
    <?php
    if (isset($_POST["btnCodificar"]) && !$error_form) {
        echo "<h2>Respuesta</h2>";
        echo "<p>El texto introducido codificado sería: </p>";
        echo "<p>" . codifica($_POST["texto"], $_POST["des"]) . "</p>";
    }
    ?>
</body>

</html>