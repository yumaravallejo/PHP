<?php

<?php
if ($n_tuplas > 0 )
{
    echo "<h3>Horario de profesor: <i>". $_POST['nomProfesor'] . "</i></h3>";
    echo "<table>";
    for ($fila = 0; $fila < 7; $fila++){
        echo "<tr>";
        echo "<th>".$DIAS_SEMANA[$fila]."</th>";
        // $horarios_dia = array_fill(1, 5, "");

        // mysqli_data_seek($detalle_horario, 0);
        // while ($tupla = mysqli_fetch_assoc($detalle_horario)) {
        //     $hora = $tupla['hora'];  
        //     $dia = $tupla['dia'];    
        //     $grupo = $tupla['nombre']; 

        //     if ($hora == $fila) { 
        //         if ($horarios_dia[$dia] != "") { //Si ese día ya tiene algo
        //             $horarios_dia[$dia] .= ", " . $grupo;
        //         } else {
        //             $horarios_dia[$dia] = $grupo;
        //         }
        //     }
        // }

        for ($col = 0; $col < 6 ; $col++){
            if ($col == 0){
                echo "<td>". $HORAS_SEMANA[$fila]."</td>";
            }  else if ($col==1 && $fila==3) {
                    echo "<td colspan='5'>Recreo</td>";
            } else if($fila!=3) {
                echo "<td>";
                // if ($horarios_dia[$col] != "") {
                //     echo $horarios_dia[$col];
                // }
                
                echo "<form action='index.php' method='post'><input type='hidden' value='".$nombre_profesor."' name='nomProfesor'><input type='hidden' value='".$hora."' name='hora'><input type='hidden' value='".$dia."' name='dia'><button class='enlace' type='submit' name='btnEditar'>Editar</button></form>";
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

?>