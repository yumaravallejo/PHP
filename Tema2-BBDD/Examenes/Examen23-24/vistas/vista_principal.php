<?php
if (mysqli_num_rows($usuarios) > 0) {
    echo "
        <form action='index.php' method='post'>
            <p>
                <label for='horario'>Horario del profesor: </label>
                <select name='horario' id='horario'>";

    while ($tupla = mysqli_fetch_assoc($usuarios)) {
        if (isset($_POST['horario']) && $_POST['horario'] == $tupla['id_usuario']) {
            echo "<option value='" . $tupla['id_usuario'] . "' selected>" . $tupla['nombre'] . "</option>";
            $nombre_profesor = $tupla['nombre'];
            $id = $tupla['id_usuario'];
        } else {
            echo "<option value='" . $tupla['id_usuario'] . "'>" . $tupla['nombre'] . "</option>";
        }
        
    }
    

    echo "</select> <button type='submit' name='verHorario' value='" . $tupla['id_usuario'] . "'>Ver Horario</button>
               
            </p>
        </form>";

} else {
    echo "<p>No existen usuarios registrados</p>";
}
