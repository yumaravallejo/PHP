<h2>Horario de los Profesores</h2>

<form action="Ej4.php" method="post">
    <label for="horario">Horario del Profesor: </label>
    <select name="horario" id="horario">
        <?php 
            @$horario = fopen("Horario/horarios.txt", "r") or die("No ha podido encontrarse el archivo");
            
            while (!feof($horario)) {
                $linea = fgets($horario);
                $arr_linea = explode("\t", $linea);
                echo "<option value='".$arr_linea[0]."'>".$arr_linea[0]."</option>";
            } 
        ?>
    </select>
    <p>
        <button type="submit" name="enviar">Ver horario</button>
    </p>
</form>

<?php
    const HORAS = array("8:15 - 9:15", "9:15 - 10:15", "10:15 - 11:15", "11:15 - 11:45", "11:45 - 12:45", "12:45 - 13:45", "13:45 - 14:45");
    const DIAS_SEMANA = array("", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes");

    if (isset($_POST['enviar'])) {        
        $profe = $_POST['horario'];
        echo "<p><strong>Horario del Profesor : </strong> <i></i></p>";
        $horario_profe = "";

        while ($horario_profe != "" ) {
            $linea = fgets($horario);
            $arr_linea = explode("\t", $linea);
            if ($profe == $arr_linea[0]){
                $horario_profe = $arr_linea;
            }
        }



    }
    fclose($horario);
?>