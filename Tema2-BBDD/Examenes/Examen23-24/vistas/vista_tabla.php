<?php
if ($n_tuplas > 0 )
{
    echo "<h3>Horario de profesor: <i>". $user['nombre'] . "</i></h3>";
    echo "<table>";
    echo "<tr>
            <td></td>
            <td>Lunes</td>
            <td>Martes</td>
            <td>Miércoles</td>
            <td>Jueves</td>
            <td>Viernes</td>
          </tr>";
    for ($fila = 1; $fila < 7; $fila++){
        echo "<tr>";
        $horarios_dia = array_fill(1, 5, "");

        mysqli_data_seek($detalle_horario, 0);
        while ($tupla = mysqli_fetch_assoc($detalle_horario)) {
            $hora = $tupla['hora'];  
            $dia = $tupla['dia'];    
            $grupo = $tupla['nombre']; 

            if ($hora == $fila) { 
                if ($horarios_dia[$dia] != "") { //Si ese día ya tiene algo
                    $horarios_dia[$dia] .= ", " . $grupo;
                } else {
                    $horarios_dia[$dia] = $grupo;
                }
            }
        }

        for ($col = 0; $col < 6 ; $col++){
            if ($col == 0){
                echo "<td>". $HORAS_SEMANA[$fila]."</td>";
            }  else if ($col==1 && $fila==3) {
                    echo "<td colspan='5'>Recreo</td>";
            } else if($fila!=3) {
                echo "<td>";
                if ($horarios_dia[$col] != "") {
                    echo $horarios_dia[$col];
                } 
                echo "<form action='index.php' method='post'><button class='enlace' type='submit' name='btnEditar' value='".$col.$dia."'>Editar</button></form>";
                echo "</td>";

            } 
        }            
        echo "</tr>";
    }
   
    echo "<table>";
} else {
    echo "<p>Este usuario ya no está registrado en la BD</p>";
}
?>
