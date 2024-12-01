<h1>Librería</h1>
<?php
echo "<form action='gest_libros.php' method='post'><p>Bienvenido <strong>" . $datos_usuario_logueado['lector'] . "</strong> - ";
echo "<button class='enlace' type='submit' name='btnCerrarSesion'>Salir</button></p></form>";

if (isset($_POST['btnBorrar'])) {
    echo "¿Estás seguro de querer borrar el libro <strong>" . $_POST['btnBorrar'] . "</strong>?";
    echo "<form action='gest_libros.php' method='post'><p>
            <button type='submit' name='btnContBorrar' value='".$_POST['btnBorrar']."'>Eliminar</button>
            <button type='submit'>Volver</button>
          </p></form>";
}
?>
<h2>Listado de los libros</h2>
<table>
    <tr>
        <th>Ref</th>
        <th>Título</th>
        <th>Acción</th>
    </tr>
    <?php
    while ($tupla_l = mysqli_fetch_assoc($libros)) {
        echo "<tr>";
        echo "<td>" . $tupla_l['referencia'] . "</td>";
        echo "<td>" . $tupla_l['titulo'] . "</td>";
        echo "<td><form action='gest_libros.php' method='post'><button class='enlace' type='submit' name='btnEditar' value='" . $tupla_l['referencia'] . "'>Editar</button> - <button class='enlace' type='submit' name='btnBorrar' value='" . $tupla_l['referencia'] . "'>Borrar</button></form></td>";
        echo "</tr>";
    }
    ?>
</table>
<h2>Agregar un nuevo libro</h2>
<form action="gest_libros.php" method="post" enctype="multipart/form-data">
    <p>
        <label for="ref">Referencia:</label>
        <input type="text" id="ref" name="referencia" value="<?php if (isset($_POST['referencia'])) echo $_POST['referencia'] ?>">
        <?php
        if (isset($_POST['btnAgregar']) && $error_form && $error_referencia) {
            if ($_POST['referencia'] == "") echo "<span class='error'>* CAMPO VACÍO *</span>";
            else if (!is_numeric($_POST['referencia'])) echo "<span class='error'>* LA REFERENCIA DEBE SER UN NÚMERO *</span>";
            else echo "<span class='error'>* REFERENCIA REPETIDA *</span>";
        }
        ?>
    </p>
    <p>
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?php if (isset($_POST['titulo'])) echo $_POST['titulo'] ?>">
        <?php
        if (isset($_POST['btnAgregar']) && $error_form) {
            if ($_POST['titulo'] == "") echo "<span class='error'>* CAMPO VACÍO *</span>";
        }
        ?>
    </p>
    <p>
        <label for="autor">Autor:</label>
        <input type="text" id="autor" name="autor" value="<?php if (isset($_POST['autor'])) echo $_POST['autor'] ?>">
        <?php
        if (isset($_POST['btnAgregar']) && $error_form) {
            if ($_POST['autor'] == "") echo "<span class='error'>* CAMPO VACÍO *</span>";
        }
        ?>
    </p>
    <p>
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion"><?php if (isset($_POST['descripcion'])) echo $_POST['descripcion'] ?></textarea>
        <?php
        if (isset($_POST['btnAgregar']) && $error_form) {
            if ($_POST['descripcion'] == "") echo "<span class='error'>* CAMPO VACÍO *</span>";
        }
        ?>
    </p>
    <p>
        <label for="precio">Precio:</label>
        <input type="text" id="precio" name="precio" value="<?php if (isset($_POST['precio'])) echo $_POST['precio'] ?>">
        <?php
        if (isset($_POST['btnAgregar']) && $error_form) {
            if ($_POST['precio'] == "") echo "<span class='error'>* CAMPO VACÍO *</span>";
        }
        ?>
    </p>
    <p>
        <label for="portada">Portada:</label>
        <input type="file" id="portada" name="portada">
        <?php
        if (isset($_POST['btnAgregar']) && $error_form) {
            if (isset($errores_file)) {
                if (!getimagesize($_FILES['portada'])) echo "<span class='error'>* EL ARCHIVO DEBE SER UNA IMAGEN *</span>";
                else echo "<span class='error'>* EL ARCHIVO DEBE SER MENOR DE 750KB *</span>";
            }
        }
        ?>
    </p>
    <p>
        <button type="submit" name="btnAgregar">Agregar</button>
        <button type="reset">Quitar</button>
    </p>

</form>