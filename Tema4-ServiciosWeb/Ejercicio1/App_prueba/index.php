<?php
require "../servicios_rest/src/funciones_ctes.php";

function consumir_servicios_REST($url, $metodo, $datos = null)
{
    $llamada = curl_init();
    curl_setopt($llamada, CURLOPT_URL, $url);
    curl_setopt($llamada, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($llamada, CURLOPT_CUSTOMREQUEST, $metodo);
    if (isset($datos))
        curl_setopt($llamada, CURLOPT_POSTFIELDS, http_build_query($datos));
    $respuesta = curl_exec($llamada);
    curl_close($llamada);
    return $respuesta;
}

CONST DIR_SERV = "http://localhost/PHP/Tema4-ServiciosWeb/Ejercicio1/servicios_rest";



if (isset($_POST['btnInsertar'])) {
    $error_cod = $_POST["cod"] == "";
    if (!$error_cod) {
        $error_cod = repetido($_POST["cod"]);
    }
    $error_nomcort = $_POST['nombre_corto'] == "";
    $error_pvp = $_POST['pvp'] == "" || $_POST['pvp'] < 0;
    $error_familia = $_POST['familia'] == "";
    if (!$error_familia){
        $error_familia = !existe($_POST['familia']);
    }

    $errores_form = $error_cod || $error_nomcort || $error_pvp || $error_familia;
}
    
if (isset($_POST['btnInsertar']) && !$errores_form){
    $url = DIR_SERV."/producto/insertar";
    $respuesta = consumir_servicios_REST($url, "POST");
    $obj = json_decode($respuesta);
    //$obj = json_decode($respuesta,true); --> con esto creará en array asociativo en vez de un objeto
    //$obj->productos, se convertiría en $obj["productos"]
    if (!$obj)
        die ("<p>Error consumiendo el servicio web <strong>".$url."</strong></p></body></html>");

    if (isset($obj->error))
        die("<p>".$obj->error."</p></body></html>"); 
    
    if (isset($obj->mensaje))
        echo "<p>".$obj->mensaje."</p>"; 
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba de los Servicios Actividad 1</title>
    <style>
        table {border: 1px solid black; border-collapse: collapse;}
        table, th, td {border: 1px solid black; padding: 1rem; text-align: center;}
        th {font-size: 1.4rem;}
        .error {color:red}
    </style>
</head>

<body>
    <h1>Productos de la tienda</h1>
    <?php
    $url = DIR_SERV."/productos";
    $respuesta = consumir_servicios_REST($url, "GET");
    $obj = json_decode($respuesta);
    //$obj = json_decode($respuesta,true); --> con esto creará en array asociativo en vez de un objeto
    //$obj->productos, se convertiría en $obj["productos"]
    if (!$obj)
        die ("<p>Error consumiendo el servicio web <strong>".$url."</strong></p></body></html>");

    if (isset($obj->error))
        die("<p>".$obj->error."</p></body></html>");

    echo "<table>";
    echo "<tr><th>Código</th><th>Nombre corto</th><th>PVP</th></tr>";
    
    foreach($obj->productos as $tupla){
        echo "<tr>";
        echo "<td>".$tupla->cod."</td>
              <td style='text-align:left'>".$tupla->nombre_corto."</td>
              <td>".$tupla->PVP."</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    
    ?>

    <h2>Insertar un nuevo producto</h2>
    
    <form action="index.php" method="post">
        <p>
            <label for="cod">Código:</label><br>
            <input type="text" name="cod" id="cod" value="<?php if(isset($_POST['cod'])) echo $_POST['cod'] ?>">
            <?php
            if (isset($errores_form) && $error_cod) {
                if ($_POST['cod'] == "")
                    echo "<span class='error'>* Este campo es obligatorio *</span>";
                else
                    echo "<span class='error'>* Este código ya existe *</span>";
            }
            ?>
        </p>
        <p>
            <label for="nombre">Nombre:</label><br>
            <input type="text" name="nombre" id="nombre" value="<?php if(isset($_POST['nombre'])) echo $_POST['nombre'] ?>">
        </p>
        <p>
            <label for="nombre_corto">Nombre corto:</label><br>
            <input type="text" name="nombre_corto" id="nombre_corto" value="<?php if(isset($_POST['nombre_corto'])) echo $_POST['nombre_corto'] ?>">
            <?php
            if (isset($errores_form) && $error_nomcort) {
                echo "<span class='error'>* Este campo es obligatorio *</span>";
            }
            ?>
        </p>
        <p>
            <label for="nombre">Descripción:</label><br>
            <textarea col=15 row=50 name="descripcion" id="descripcion"><?php if(isset($_POST['descripcion'])) echo $_POST['descripcion'] ?></textarea>
        </p>
        <p>
            <label for="pvp">PVP:</label><br>
            <input type="number" name="pvp" id="pvp" value="<?php if(isset($_POST['pvp'])) echo $_POST['pvp'] ?>">
            <?php
            if (isset($errores_form) && $error_pvp) {
                if ($_POST['pvp'] == "")
                    echo "<span class='error'>* Este campo es obligatorio *</span>";
                else
                    echo "<span class='error'>* El número debe ser mayor de 0 *</span>";
            }
            ?>
        </p>
        <p>
            <label for="familia">Familia:</label><br>
            <input type="text" name="familia" id="familia" value="<?php if(isset($_POST['familia'])) echo $_POST['familia'] ?>">
            <?php
            if (isset($errores_form) && $error_familia) {
                if ($_POST['pvp'] == "")
                echo "<span class='error'>* Este campo es obligatorio *</span>";
            else
                echo "<span class='error'>* La familia no existe *</span>";            }
            ?>
        </p>
        <p>
            <button type="submit" name="btnInsertar">Insertar</button>
        </p>
    </form>    

</body>

</html>