<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rellena tu CV</title>
    <style>
        .error {
            color: red
        }
    </style>
</head>

<body>
    <h1>Rellena tu CV</h1>
    <form name="f1" action="index.php" enctype="multipart/form-data" method="post">
        <p>
            <label for="nombre">Nombre:</label> <br />
            <input type="text" id="nombre" name="nombre" placeholder="Nombre..." value="<?php if (isset($_POST["nombre"])) {
                                                                                            echo $_POST["nombre"];
                                                                                        } ?>" />
            <?php
            if (isset($_POST["enviar"]) && $error_nombre) {
                echo "<span class='error'> Campo vacío</span>";
            }
            ?>
        </p>

        <p>
            <label for="usuario">Usuario:</label> <br />
            <input type="text" id="usuario" name="usuario" placeholder="Usuario..." value="<?php if (isset($_POST["usuario"])) {
                                                                                                echo $_POST["usuario"];
                                                                                            } ?>" />
            <?php
            if (isset($_POST["enviar"]) && $error_usuario) {
                echo "<span class='error'> Campo vacío</span>";
            }
            ?>
        </p>

        <p>
            <label for="clave">Contraseña:</label><br />
            <input type="password" id="clave" name="clave" placeholder="Contraseña..." />
            <?php
            if (isset($_POST["enviar"]) && $error_clave) {
                echo "<span class='error'> Campo vacío</span>";
            }
            ?>
        </p>

        <p>
            <label for="dni">DNI:</label><br />
            <input type="text" id="dni" name="dni" placeholder="DNI: 11223344ZZ" value="<?php if (isset($_POST['dni'])) echo $_POST['dni'] ?>" />
            <?php
            if (isset($_POST['enviar']) && $error_dni) {
                if ($_POST['dni'] == '') {
                    echo "<span class='error'> Campo vacío </span>";
                } else if (!dni_bien_escrito(strtoupper($_POST['dni']))) {
                    echo "<span class='error'> DNI no está bien escrito </span>";
                } else {
                    echo "<span class='error'> DNI no válido </span>";
                }
            }
            ?>
        </p>

        <p>
            <label>Sexo:</label>
            <?php
            if (isset($_POST["enviar"]) && $error_sexo) {
                echo "<span class='error'> Debes seleccionar un sexo</span>";
            }
            ?>
            <br />
            <input type="radio" id="hombre" name="sexo" value="hombre" <?php if (isset($_POST["sexo"]) && $_POST["sexo"] == "hombre") {
                                                                            echo " checked";
                                                                        } ?> />
            <label for="hombre"> Hombre</label> <br />

            <input type="radio" id="mujer" name="sexo" value="mujer" <?php if (isset($_POST["sexo"]) && $_POST["sexo"] == "mujer") {
                                                                            echo " checked";
                                                                        } ?> />
            <label for="mujer"> Mujer</label>
        </p>

        <p>
            <label for="archivo">Incluir mi archivo (Archivo de timpo imagen. Máx. 500KB): </label>
            <input type="file" name="archivo" id="archivo" accept="image/*" />
            <?php
            if (isset($_POST['enviar']) && $error_archivo) {
                if ($_FILES['archivo']['name'] != '') {
                    if ($_FILES['archivo']['error']) {
                        echo "<span class = 'error'> No se ha podido subir el archivo al servidor </span>";
                    } else if (!getimagesize($_FILES['archivo']['tmp_name'])) {
                        echo "<span class = 'error'> El archivo seleccionado no es una imagen </span>";
                    } else {
                        echo "<span class = 'error'> El archivo seleccionado supera los 500KB </span>";
                    }
                }
            }
            ?>
        </p>

        <p>
            <label for="nacido">Nacido en: </label>
            <select id="nacido" name="nacido">
                <option value="Málaga" <?php if (isset($_POST["nacido"]) && $_POST["nacido"] == "Málaga") {
                                            echo " selected";
                                        } ?>> Málaga </option>
                <option value="Sevilla" <?php if (isset($_POST["nacido"]) && $_POST["nacido"] == "Sevilla") {
                                            echo " selected";
                                        } ?>> Sevilla </option>
                <option value="Jaén" <?php if ((isset($_POST["nacido"]) && $_POST["nacido"] == "Jaén") || !isset($_POST["nacido"])) {
                                            echo " selected";
                                        } ?>> Jaén </option>
            </select>
        </p>

        <p>
            <label for="comentario">Comentarios: </label>
            <textarea rows="5" colums="7" name="comentario" id="comentario" placeholder="Comentarios..."><?php if (isset($_POST["comentario"])) {
                                                                                                                echo $_POST["comentario"];
                                                                                                            } ?></textarea>
        </p>

        <p>
            <input type="checkbox" id="novedades" value="novedades" name="novedades" <?php if (isset($_POST['novedades'])) echo 'checked'; ?> />
            <label for="novedades">Suscribirse al boletín de Novedades</label>
        </p>

        <p>
            <input type="submit" name="enviar" value="Guardar Cambios" />
            <input type="submit" name="borrar" value="Borrar los datos introducidos" />
        </p>
    </form>

</body>

</html>