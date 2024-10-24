<h2>No se encuentra el archivo Horario/horarios.txt</h2>

<form action="Ej4.php" enctype="multipart/form-data" method="post">
    <p>
        <label for="fichero">Seleccione un archivo txt no superior a 1 MB</label>
        <input type="file" name="fichero" id="fichero">
        <?php
            if (isset($_POST['enviar']) && $errores_form) {
                if ($_FILES['fichero']['name'] =="") {
                    echo "<span class='error'>* Campo Vacío *</span>";
                } else if ($_FILES['fichero']['size'] > 1000*1024) {
                    echo "<span class='error'>* Debes seleccionar un fichero menor de 1MB *</span>";
                } else if ($_FILES['fichero']['type'] != "text/plain") {
                    echo "<span class='error'>* Debes seleccionar un fichero de texto *</span>";
                } else {
                    echo "<span class='error'>* Error en el fichero *</span>";
                }
            }
        ?>
    </p>
    <p>
        <button type="submit" name="enviar">Subir</button>
    </p>
</form>