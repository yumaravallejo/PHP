<h2>Creando un Producto</h2>
<form action="index.php" method="post">
    <p>
        <label for="cod">Código: </label>
        <input type="text" name="cod" id="cod" maxlength="12" value="<?php if (isset($_POST["cod"])) echo $_POST["cod"] ?>">
        <?php
        if (isset($_POST["cod"]) && $error_cod)
            if ($_POST["cod"] == "")
                echo "<span class='error'> Campo vacío</span>";
            else
                echo "<span class='error'> Código repetido</span>";

        ?>
    </p>
    <p>
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre" maxlength="200" value="<?php if (isset($_POST["nombre"])) echo $_POST["nombre"] ?>">
    </p>
    <p>
        <label for="nombre_corto">Nombre corto: </label>
        <input type="text" name="nombre_corto" id="nombre_corto" maxlength="50" value="<?php if (isset($_POST["nombre_corto"])) echo $_POST["nombre_corto"] ?>">
        <?php
        if (isset($_POST["nombre_corto"]) && $error_nombre_corto)
            echo "<span class='error'> Campo vacío</span>";
        ?>
    </p>
    <p>
        <label for="descripcion">Descripción: </label>
        <textarea name="descripcion" id="descripcion"><?php if (isset($_POST["descripcion"])) echo $_POST["descripcion"] ?></textarea>
    </p>
    <p>
        <label for="pvp">PVP: </label>
        <input type="text" name="pvp" id="pvp" maxlength="11" value="<?php if (isset($_POST["pvp"])) echo $_POST["pvp"] ?>">
        <?php
        if (isset($_POST["pvp"]) && $error_pvp) {
            if ($_POST["pvp"] == "")
                echo "<span class='error'> Campo vacío</span>";
            else if (!is_numeric($_POST["pvp"]))
                echo "<span class='error'> No es un número</span>";
            else
                echo "<span class='error'> Tiene que ser un valor positivo</span>";
        }
        ?>
    </p>
    <p>
        <label for="familia">Seleccione una familia: </label>
        <select name="familia" id="familia">
            <?php
            // Obtenemos las familias
            $url = DIR_SERV . "/familias";
            $respuesta = consumir_servicios_REST($url, "GET");
            $obj = json_decode($respuesta);
            if (!$obj) {
                session_destroy();
                die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
            }

            if (isset($obj->error)) {
                session_destroy();
                die("<p>" . $obj->error . "</select></p></body></html>");
            }

            foreach ($obj->familias as $tupla) {
                if (isset($_POST["familia"]) && $tupla->cod == $_POST["familia"])
                    echo "<option selected value='" . $tupla->cod . "'>$tupla->nombre</option>";
                else
                    echo "<option value='" . $tupla->cod . "'>$tupla->nombre</option>";
            }
            ?>
        </select>
    </p>
    <p>
        <button type="submit" name="btnVolver">Volver</button>
        <button type="submit" name="btnContInsertar">Continuar</button>
    </p>
</form>